<?php

namespace Modules\PMS\Console;

use App\Entities\Attribute;
use App\Services\RoleService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Services\EmployeeService;
use Modules\PMS\Entities\ProjectRequestReceiver;
use Modules\PMS\Services\ProjectDetailProposalService;
use Modules\PMS\Services\ProjectProposalService;
use Modules\PMS\Services\ProjectRequestDetailService;
use Modules\PMS\Services\ProjectRequestService;
use Modules\PMS\Services\ProjectService;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class ImportProject extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'pms:import-project';

    protected $signature = "pms:import-project";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Import projects from xls/xlsx file.";

    private $reader;
    private $file;
    private $data;
    private $headers;
    private $host;
    private $userName;
    private $locale;
    private $userService;
    private $employeeService;
    private $briefProjectRequestService;
    private $briefProjectProposalService;
    private $detailProjectRequestService;
    private $detailProjectProposalService;
    private $projectService;
    private $roleService;
    private $employeeNames;
    private $roles;

    /**
     * ImportProject constructor.
     * @param UserService $userService
     * @param EmployeeService $employeeService
     * @param ProjectRequestService $projectRequestService
     * @param ProjectProposalService $projectProposalService
     * @param ProjectRequestDetailService $projectRequestDetailService
     * @param ProjectDetailProposalService $projectDetailProposalService
     * @param ProjectService $projectService
     * @param RoleService $roleService
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function __construct(
        UserService $userService,
        EmployeeService $employeeService,
        ProjectRequestService $projectRequestService,
        ProjectProposalService $projectProposalService,
        ProjectRequestDetailService $projectRequestDetailService,
        ProjectDetailProposalService $projectDetailProposalService,
        ProjectService $projectService,
        RoleService $roleService
    ) {
        parent::__construct();

        $this->locale = "bn";

        $this->setLocale();

        $this->userName = "jdp";

        $this->userService = $userService;
        $this->employeeService = $employeeService;
        $this->briefProjectRequestService = $projectRequestService;
        $this->briefProjectProposalService = $projectProposalService;
        $this->detailProjectRequestService = $projectRequestDetailService;
        $this->detailProjectProposalService = $projectDetailProposalService;
        $this->projectService = $projectService;
        $this->roleService = $roleService;

        $this->employeeNames = [];

        $this->reader = new Xlsx();
        $this->file = $this->reader->load(public_path('files/import_projects.xlsx'));
        $this->data = $this->file->getActiveSheet()
            ->removeColumn('A');

        $data = $this->data
            ->toArray(
                null,
                true,
                true,
                true
            );

        $headers = $data[1];

        $this->setHeaders($headers);

        $this->setData();

        $this->setRoles();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->setHost();

        $this->setEmployeeNames();

        foreach ($this->data as $key => $datum) {
            $employee = $this->getInvitee($datum['B']);

            if ($employee) {
                $project = DB::transaction(function () use ($employee, $datum) {

                    $briefProjectRequest = $this->createBriefRequest($datum);

                    $receiver = $this->createBriefRequestReceiver($employee, $briefProjectRequest);

                    $briefProjectRequest->projectRequestReceivers()->save($receiver);

                    if (optional($employee)->user) {
                        $briefProjectProposal = $this->createBriefProposal($employee, $datum, $briefProjectRequest);

                        $detailProjectRequest = $this->createDetailRequest($datum, $briefProjectProposal);

                        $detailProjectProposal = $this->createDetailProposal($employee, $datum, $detailProjectRequest);

                        $project = $this->createProject($employee, $datum, $detailProjectProposal);

                        if ($project) {
                            $detailProjectProposal->update([
                                'project_id' => $project->id,
                            ]);

                            $this->setUserRoles($employee);

                            $this->setAttributes($project);
                        }

                        return $project;
                    }
                });
            }
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }

    private function setHeaders($headers = [])
    {
        if (!empty($headers)) {
            foreach ($headers as $key => $header) {
                $this->headers[$key] = $header;
            }
        }
    }

    private function setData()
    {
        $this->data = $this->data
            ->removeRow(1)
            ->toArray(
                null,
                true,
                true,
                true
            );
    }

    private function setHost()
    {
        $host = $this->userService->findBy([
            'username' => $this->userName
        ])->first();

        $this->host = optional($host)->employee;
    }

    private function getInvitee($name)
    {
        $inviteeId = array_search($name, $this->employeeNames);
        if ($inviteeId) {
            return $this->employeeService->findOne($inviteeId);
        } else {
            return false;
        }
    }

    private function setLocale()
    {
        Session::put('locale', $this->locale);
        Session::save();
    }

    private function createBriefRequest($datum)
    {
        return $this->briefProjectRequestService->save([
            'title' => $datum['A'],
            'end_date' => Carbon::today()
        ]);
    }

    private function createBriefRequestReceiver($employee, $briefProjectRequest)
    {
        return new ProjectRequestReceiver([
            'receiver' => $employee->id,
            'project_request_id' => $briefProjectRequest->id
        ]);
    }

    private function createBriefProposal($employee, $datum, $briefProjectRequest)
    {
        return $this->briefProjectProposalService->save([
            'project_request_id' => $briefProjectRequest->id,
            'auth_user_id' => optional($employee->user)->id,
            'title' => $datum['A'],
            'status' => 'APPROVED'
        ]);
    }

    private function createDetailRequest($datum, $briefProjectProposal)
    {
        return $this->detailProjectRequestService->save([
            'project_proposal_id' => $briefProjectProposal->id,
            'title' => $datum['A'],
            'end_date' => Carbon::today(),
        ]);
    }

    private function createDetailProposal($employee, $datum, $detailProjectRequest)
    {
        return $this->detailProjectProposalService->save([
            'project_request_id' => $detailProjectRequest->id,
            'auth_user_id' => optional($employee->user)->id,
            'title' => $datum['A'],
            'status' => 'APPROVED',
        ]);
    }

    private function createProject($employee, $datum, $detailProjectProposal)
    {
        return $this->projectService->save([
            'title' => $datum['A'],
            'submitted_by' => optional($employee->user)->id,
            'status' => 'pending',
            'duration' => '3',
            'budget' => '1000000',
            'project_detail_proposal_id' => $detailProjectProposal->id,
        ]);
    }

    private function setEmployeeNames()
    {
        $this->employeeService->findAll()
            ->each(function ($employee) {
                $this->employeeNames[$employee->id] = $employee->getName();
            });
    }

    private function setRoles()
    {
        $this->roles = ['ROLE_PROJECT_DIRECTOR'];
    }

    private function setUserRoles($employee)
    {
        $user = optional($employee)->user;

        if ($user) {
            $roles = [];

            foreach ($this->roles as $key => $role) {
                if (!$user->hasRole($role)) {
                    $roleToAttach = $this->roleService->findBy([
                        'name' => $role,
                    ])->first();

                    if ($roleToAttach) {
                        $roles[] = $roleToAttach->id;
                    }
                }
            }

            $userRoles = $user->roles()->attach($roles);
        }
    }

    private function setAttributes($project)
    {
        if ($project) {
            $project->attributes()->saveMany([
                new Attribute([
                    'name' => 'Deposit',
                    'unit' => 'tk',
                ]),
                new Attribute([
                    'name' => 'Loan',
                    'unit' => 'tk',
                ]),
                new Attribute([
                    'name' => 'Share',
                    'unit' => 'Share',
                ]),
            ]);
        }
    }
}

<?php

namespace Modules\TMS\Console;

use Illuminate\Console\Command;
use Modules\TMS\Services\TrainingCourseModuleSessionService;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UpdateSpeakerEvaluationDeadline extends Command
{
    private $trainingCourseModuleSessionService;

    private $default;

    private $previous;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'evaluation:speaker-default-deadline';

    protected $signature = 'evaluation:speaker-default-deadline {default} {previous?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all given values to the default one.';

    /**
     * UpdateSpeakerEvaluationDeadline constructor.
     * @param TrainingCourseModuleSessionService $trainingCourseModuleSessionService
     */
    public function __construct(
        TrainingCourseModuleSessionService $trainingCourseModuleSessionService
    )
    {
        parent::__construct();

        $this->trainingCourseModuleSessionService = $trainingCourseModuleSessionService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->previous = $this->argument('previous');
        $this->default = $this->argument('default');

        $sessions = $this->trainingCourseModuleSessionService->findBy([
            'speaker_expire_timeline' => $this->previous,
        ]);

        $sessions->each(function ($session){
            return $session->update([
                'speaker_expire_timeline' => $this->default,
            ]);
        });

    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            $this->argument('default'),
            $this->argument('previous'),
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
        ];
    }
}

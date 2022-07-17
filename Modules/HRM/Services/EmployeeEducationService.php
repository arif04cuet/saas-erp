<?php
    /**
     * Created by PhpStorm.
     * User: BS100
     * Date: 11/4/2018
     * Time: 7:02 PM
     */

    namespace Modules\HRM\Services;


    use App\Http\Responses\DataResponse;
    use App\Traits\CrudTrait;
    use http\Env\Request;
    use Modules\HRM\Entities\AcademicInstitute;
    use Modules\HRM\Repositories\EmployeeEducationRepository;

    class EmployeeEducationService
    {
        use CrudTrait;
        protected $employeeEducationRepository;
        protected $academicInstituteService;
        protected $academicDepartmentService;
        protected $academicDegreeService;
        private $dateFormat = 'j F, Y';

        public function __construct(
            EmployeeEducationRepository $employeeEducationRepository,
            AcademicInstituteService $academicInstituteService,
            AcademicDepartmentService $academicDepartmentService,
            AcademicDegreeService $academicDegreeService)
        {
            $this->employeeEducationRepository = $employeeEducationRepository;
            $this->academicInstituteService = $academicInstituteService;
            $this->academicDepartmentService = $academicDepartmentService;
            $this->academicDegreeService = $academicDegreeService;
            $this->setActionRepository($this->employeeEducationRepository);
        }

        public function storeEducationalInfo($data = null)
        {
            if(!is_null($data) && count($data)) {

                foreach ($data as $item) {
                    if (!is_null($item['other_institute_name'])) {
                        $newInstitute['name'] = $item['other_institute_name'];
                        $institute = $this->academicInstituteService->storeInstitute($newInstitute);
                        $item['academic_institute_id'] = $institute['id'];
                    }
                    if (!is_null($item['other_department_name'])) {
                        $newAcademicDepartment['name'] = $item['other_department_name'];
                        $academicDepartment = $this->academicDepartmentService->storeAcademicDepartment($newAcademicDepartment);
                        $item['academic_department_id'] = $academicDepartment['id'];
                    }
                    if (!is_null($item['other_degree_name'])) {
                        $newDegreeName['name'] = $item['other_degree_name'];
                        $academicDegree = $this->academicDegreeService->storeAcademicDegree($newDegreeName);
                        $item['academic_degree_id'] = $academicDegree['id'];
                    }

                    $education = $this->employeeEducationRepository->save($item);


                }

                return new DataResponse($education, $education['employee_id'], trans('labels.Education information added successfully'));
            }

            return new DataResponse($data, null, trans('labels.You have not added any education information'));

        }

        public function updateEducationInfo($data, $employeeId)
        {
//		sometime full section can be removed while edit. so deleting the section
            $existingEducationsIds = $this->getEmployeeEducationIds($employeeId);
            $newEducationIds = (!is_null($data) && count($data)) ? array_column($data, 'id') : [];
            $deletedIds = array_diff($existingEducationsIds, $newEducationIds);
            if (count($deletedIds) > 0) {
                foreach ($deletedIds as $deleted_id) {
                    $education = $this->findOrFail($deleted_id);
                    $status = $education->delete();
                }
            }
//		end deleting


            $status = false;

            if(!is_null($data) && count($data)) {
                foreach ($data as $item) {

                    if (isset($item['id'])) {
//				updating existing education
                        $education = $this->findOrFail($item['id']);
                        $result = array_merge($item, $this->checkForNewEducationValues($item));
                        $status = $education->update($result);
                    } else {
//				storing new education if added new education while edit
                        $result = array_merge($item, $this->checkForNewEducationValues($item));
                        $education = $this->employeeEducationRepository->save($result);
                        $status = true;
                    }
                }
            }

            if ($status) {
                return new DataResponse($education, $education['employee_id'], trans('labels.Education information updated successfully'));
            } else {
                return new DataResponse($data, null, trans('labels.You have not added any education information'), 500);
            }
        }

        public function getEmployeeEducationIds($employeeId)
        {

            $educations = $this->employeeEducationRepository->findBy(['employee_id' => $employeeId])->pluck('employee_id', 'id')->toArray();

            return array_keys($educations);
        }

        /**
         * Check if Request Has -
         * 1. New Academic Institute, 2.New Department 3. New Academic Degree
         * @param array $data
         * @return  array
         */

        public function checkForNewEducationValues(array $data): array
        {
            $academicInstituteId = $data['academic_institute_id'];
            $academicDeptId = $data['academic_department_id'];
            $academicDegreeId = $data['academic_degree_id'];
            $resultArray = [];
            if (!is_numeric($academicInstituteId) && isset($data['other_institute_name'])) {
                $academicInstitute['name'] = $data['other_institute_name'];
                $lastInstituteId = $this->academicInstituteService->save($academicInstitute)->id;
                $resultArray['academic_institute_id'] = $lastInstituteId;
            }

            if (!is_numeric($academicDeptId) && isset($data['other_department_name'])) {
                $academicDept['name'] = $data['other_department_name'];
                $lastDeptId = $this->academicDepartmentService->save($academicDept)->id;
                $resultArray['academic_department_id'] = $lastDeptId;
            }
            if (!is_numeric($academicDegreeId) && isset($data['other_degree_name'])) {
                $academicDegree['name'] = $data['other_degree_name'];
                $lastDegreeId = $this->academicDegreeService->save($academicDegree)->id;
                $resultArray['academic_degree_id'] = $lastDegreeId;
            }
            return $resultArray;
        }
    }
<?php

use App\Entities\User;
use Modules\HRM\Entities\Section;
use Illuminate\Support\Facades\DB;
use Modules\IMS\Entities\Inventory;
use Illuminate\Support\Facades\Auth;
use Modules\HRM\Entities\Department;
use Modules\HRM\Entities\Designation;
use Illuminate\Support\Facades\Request;
use Modules\PMS\Entities\ProjectRequest;
use Modules\TMS\Entities\TrainingCourse;
use Modules\RMS\Entities\ResearchRequest;
use Modules\IMS\Entities\InventoryRequest;
use Modules\TMS\Entities\AssessmentQuestion;
use Modules\PMS\Entities\ProjectRequestDetail;
use Modules\RMS\Entities\ResearchDetailInvitation;
use Illuminate\Support\Facades\Route;

if (!function_exists('doptor')) {
    /**
     * get Doptor Object
     *
     * @param $user User|null
     * @return Doptor
     */
    function doptor($key = null)
    {
        $doptor = session('user_doptor', []);

        if (!is_null($key) and isset($doptor[$key]))
            return $doptor[$key];

        return $doptor;
    }
}

if (!function_exists('in_designation')) {
    /**
     * Check Is Designation Matched
     *
     * expecting the short codes of Designation in a comma separated manner
     * @return mixed
     *
     * @uses in_designation('DG', 'DA', 'PD')
     */
    function in_designation()
    {
        $haystack = func_get_args();
        $result = 0;

        if (Auth::user()->user_type == 'Employee') {
            $needle = Auth::user()->employee->designation->short_name;
            $result = in_array($needle, $haystack) ? 1 : 0;
        }

        return $result;
    }
}

if (!function_exists('get_user_designation')) {
    /**
     * get Users Designation Object
     *
     * @param $user User|null
     * @return Designation
     */
    function get_user_designation($user = null)
    {
        $user = $user ?: Auth::user();

        return $user->user_type == 'Employee'
            ? ($user->employee->designation
                ? $user->employee->designation
                : new Designation()
            )
            : new Designation();
    }
}

if (!function_exists('isActive')) {
    /**
     * get Users Designation Object
     *
     * @param $user User|null
     * @return Designation
     */
    function isActive($routes = [], $niddle = null)
    {
        if (is_array($routes)) foreach ($routes as $route) {
            if ((!$niddle || $niddle == 'url') && Request::is($route)) return "active";
            else if ($niddle == 'route' && Route::is($route)) return "active";
        }
    }
}

if (!function_exists('get_user_department')) {
    /**
     * get Users Department Object
     *
     * @param $user User|null
     * @return Department
     */
    function get_user_department($user = null)
    {
        $user = $user ?: Auth::user();

        return $user->user_type == 'Employee'
            ? ($user->employee->employeeDepartment
                ? $user->employee->employeeDepartment
                : new Department()
            )
            : new Department();
    }
}

if (!function_exists('can_submit_brief_project_proposal')) {
    /**
     * Checks whether current logged in user can submit a brief project proposal or not.
     * @param ProjectRequest $projectRequest
     * @return bool
     */
    function can_submit_brief_project_proposal(ProjectRequest $projectRequest)
    {
        return in_array(auth()->user()->id, $projectRequest->projectRequestReceivers->pluck('receiver')->toArray());
    }
}

if (!function_exists('can_submit_brief_research_proposal')) {
    /**
     * Checks whether current logged in user can submit a brief research proposal or not.
     * @param ResearchRequest $researchRequest
     * @return bool
     */
    function can_submit_brief_research_proposal(ResearchRequest $researchRequest)
    {
        return in_array(auth()->user()->id, $researchRequest->researchRequestReceivers->pluck('to')->toArray());
    }
}

if (!function_exists('can_submit_detail_project_proposal')) {
    /** Checks whether current logged in user can submit a detail project proposal or not.
     * @param ProjectRequestDetail $projectRequestDetail
     * @return bool
     */
    function can_submit_detail_project_proposal(ProjectRequestDetail $projectRequestDetail)
    {
        return (auth()->user()->id == $projectRequestDetail->projectApprovedProposal->auth_user_id);
    }
}

if (!function_exists('can_submit_detail_research_proposal')) {
    /**
     * Checks whether current logged in user can submit a detail project proposal or not.
     * @param ResearchDetailInvitation $researchDetailInvitation
     * @return bool
     */
    function can_submit_detail_research_proposal(ResearchDetailInvitation $researchDetailInvitation)
    {
        return (auth()->user()->id == $researchDetailInvitation->researchApprovedProposal->auth_user_id);
    }
}

if (!function_exists('state_actor')) {
    function state_actor($userId)
    {
        return User::findOrFail($userId);
    }
}

if (!function_exists('get_inventory_quantity')) {
    function get_inventory_quantity(
        $inventoryRequestId,
        $categoryId,
        $locationId,
        $requestModel = InventoryRequest::class
    ) {
        $inventory = Inventory::where('inventory_item_category_id', $categoryId)
            ->where('location_id', $locationId)
            ->first();

        if (is_null($inventory)) {
            return 0;
        }

        $approvedQuantity = $requestModel::where('status', 'approved')
            ->where('id', '!=', $inventoryRequestId);

        if ($requestModel == InventoryRequest::class) {

            $approvedQuantity = $approvedQuantity->where('from_location_id', $locationId);
        }

        $approvedQuantity = $approvedQuantity
            ->get()
            ->sum(function ($invReq) use ($categoryId) {
                return $invReq->details
                    ->where('category_id', $categoryId)
                    ->sum('quantity');
            });

        return ($inventory->quantity - $approvedQuantity);
    }
}

if (!function_exists('current_user_has_state')) {
    /**
     * @param $appraisal
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|null|object
     */
    function current_user_has_state($appraisal)
    {

        $lastStateHistory = $appraisal->stateHistory()->get()->last();

        return DB::table('state_recipients')
            ->where('state_history_id', $lastStateHistory->id)
            ->where('user_id', auth()->user()->id)
            ->first();
    }
}

if (!function_exists('get_user_section')) {
    function get_user_section($user = null)
    {
        $user = $user ?: Auth::user();

        return $user->user_type == 'Employee'
            ? ($user->employee->section
                ? $user->employee->section
                : new Section()
            )
            : new Section();
    }
}

if (!function_exists('assessment_value_in_percentage')) {
    function assessment_value_in_percentage($value)
    {
        $maxValue = 5;

        if ($value > $maxValue) {
            return null;
        }

        return (float)bcmul(bcdiv($value, $maxValue, 1), 100, 1);
    }
}

if (!function_exists('assessment_value_in_word')) {
    function assessment_value_in_word($value, $CONVERTED_IN_PERCENTAGE = false)
    {
        if (!$CONVERTED_IN_PERCENTAGE) {
            $value = assessment_value_in_percentage($value);
        }

        switch ($value) {
            case $value == 100:
                return trans('tms::training.verdict.Excellent');
            case $value >= 80 && $value <= 99:
                return trans('tms::training.verdict.Good');
            case $value >= 60 && $value <= 79:
                return trans('tms::training.verdict.Average');
            case $value >= 40 && $value <= 59:
                return trans('tms::training.verdict.Poor');
            default:
                return trans('tms::training.verdict.Very Poor');
        }
    }
}

if (!function_exists('convert_number')) {
    function convert_number($number)
    {

        $pattern = "/^([0-9]+)$/";

        $numbers = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];

        if (session()->get('locale') == 'en') {
            if (preg_match($pattern, $number)) {
                $convertedNumber = $number;
            } else {
                $convertedNumber = bn2enNumber($number);
            }
        } else {
            if (!preg_match($pattern, $number)) {
                $convertedNumber = $number;
            } else {
                $convertedNumber = '';
                $number = (string)$number;
                $numberChars = str_split($number);

                foreach ($numberChars as $key => $char) {
                    $convertedNumber .= $numbers[intval($char)];
                }
            }
        }

        return $convertedNumber;
    }
}

if (!function_exists('bn2enNumber')) {
    function bn2enNumber($number)
    {
        $searchArray = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        $replaceArray = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $enNumber = str_replace($searchArray, $replaceArray, $number);

        return $enNumber;
    }
}


if (!function_exists('safeArrayValue')) {
    /**
     * Use This Method To Access Array Index From Blade File
     * @return int
     */
    function safeArrayValue(array $array, $index)
    {
        return isset($array[$index]) ? $array[$index] : trans('labels.not_found');
    }
}
if (!function_exists('searchCourse')) {
    /**
     * Use This Method For Search Course
     * @return int
     */
    function searchCourse($queryString)
    {
        return $courses = TrainingCourse::where('name', 'LIKE', "%$queryString%")->orderBy('id', 'desc')->paginate(5);
    }
}
if (!function_exists('activeMenu')) {
    /**
     * Use This Method For active class
     * @return int
     */
    function activeMenu($uri = '')
    {
        $active = '';
        if (Request::is(Request::segment(1) . '/' . $uri . '/*') || Request::is(Request::segment(1) . '/' . $uri) || Request::is($uri)) {
            $active = 'active';
        }
        return $active;
    }
}

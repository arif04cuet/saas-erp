<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Arr;
use Modules\HRM\Entities\Employee;
use App\Models\Doptor;
use App\Traits\DoptorAbleTrait;
use Modules\TMS\Entities\AnnualTrainingNotificationResponse;
use Spatie\Permission\Traits\HasRoles;
use Lab404\Impersonate\Models\Impersonate;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use DoptorAbleTrait;
    use HasRoles;
    use Impersonate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'user_type',
        'employee_id',
        'doptor_id',
        'mobile',
        'reference_table_id',
        'last_password_change',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {

            $doptor_id = doptor('id');

            if ($model->user_type == 'register-user' || is_array($doptor_id))
                $doptor_id = NULL;

            $model->doptor_id = $doptor_id;
        });
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    //functions

    public function isSuperAdmin()
    {
        return $this->username == 'superadmin' || $this->hasRole('ROLE_SUPER_ADMIN');
    }

    public function canImpersonate()
    {
        return $this->can('impersonate_users');
    }

    // public function authorizeRoles($roles)
    // {
    //     if ($this->hasAnyRole($roles)) {
    //         return true;
    //     }
    //     abort(401, 'This action is unauthorized.');
    // }

    // public function hasAnyRole($roles)
    // {
    //     if (is_array($roles)) {
    //         foreach ($roles as $role) {
    //             if ($this->hasRole($role)) {
    //                 return true;
    //             }
    //         }
    //     } else {
    //         if ($this->hasRole($roles)) {
    //             return true;
    //         }
    //     }
    //     return false;
    // }

    // public function hasRole($role)
    // {
    //     if ($this->roles()->where('name', $role)->first()) {
    //         return true;
    //     }
    //     return false;
    // }

    // public function hasPermission($permissionName, $modelName)
    // {
    //     $roles = $this->roles()->get();
    //     foreach ($roles as $role) {
    //         if ($role->hasPermission($permissionName, $modelName)) {
    //             return true;
    //         }
    //     }
    //     return false;
    // }

    /*public function employeeInfo()
    {
        return Employee::where('employee_id', $this->username)->first();
    }*/

    public function employee()
    {
        // return $this->belongsTo(Employee::class);
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function doptor()
    {
        return $this->belongsTo(Doptor::class, 'doptor_id', 'id')->withDefault();
    }

    /*
     * Returns user's department department_code if user
     * is an employee
     * */
    public function getDepartmentCode()
    {
        return Arr::get($this, 'employee.employeeDepartment.department_code');
    }

    public function getNameAttribute($value)
    {
        return $this->getFilteredName($value);
    }

    private function getFilteredName($value)
    {
        $locale = $this->getLocale();

        $name = $locale == "bengali" ? $this->getBengaliName($value) : $this->getEnglishName($value);

        return !empty($name) ? $name : $value;
    }

    private function getLocale()
    {
        $locale = trans('user.name.locale');

        return $locale;
    }

    private function getPattern()
    {
        $locale = $this->getLocale();

        $pattern = $locale == "bengali" ? "/\((.*?)\)/s" : "/(\()(.*?)(\))/i";

        return $pattern;
    }

    private function getReplacement()
    {
        $replacement = "";

        return $replacement;
    }

    private function getBengaliName($value)
    {
        $pattern = $this->getPattern();

        preg_match_all($pattern, $value, $matches);

        if (!isset($matches[1]) && empty($matches[1])) {
            return "";
        }

        $name = implode(" ", $matches[1]);

        $name = trim($name);

        return $name;
    }

    private function getEnglishName($value)
    {
        $pattern = $this->getPattern();
        $replacement = $this->getReplacement();

        $name = preg_replace($pattern, $replacement, $value);

        $name = trim($name);

        return $name;
    }

    public function annualTrainingNotificationResponses()
    {
        return $this->hasMany(
            AnnualTrainingNotificationResponse::class,
            'user_id',
            'id'
        );
    }
}

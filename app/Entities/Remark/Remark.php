<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/30/19
 * Time: 5:37 PM
 */

namespace App\Entities\Remark;


use App\Entities\User;
use App\Entities\workflow\Feature;
use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    protected $table = 'remarks';

    protected $fillable = ['feature_id', 'ref_table_id', 'from_user_id', 'from_user_designation', 'remarks'];

    public function feature()
    {
        return $this->belongsTo(Feature::class, 'feature_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }
}

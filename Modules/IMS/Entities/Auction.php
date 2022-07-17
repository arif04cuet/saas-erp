<?php 
/**
 *  Created By - Imran Hossain - 25-05-2019
 */
namespace Modules\IMS\Entities;

use App\Entities\StateDetail;
use App\Entities\User;
use App\Traits\Workflowable;
use Iben\Statable\Models\StateHistory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{

    use Workflowable;

    protected $table = 'auction';
    protected $fillable = ['requester_id','title', 'status', 'date' ];

    
    public function details()
    {
        return $this->hasMany(AuctionDetail::class, 'auction_id', 'id');
    }

    protected function getGraph()
    {
        return 'auction-workflow';
    }

    public function stateDetails()
    {
        return $this->hasManyThrough(StateDetail::class, StateHistory::class, 'statable_id', 'state_history_id', 'id', 'id')
            ->where('statable_type', Auction::class);
    }

    public function requester()
    {
        return $this->hasOne( User::class, 'id', 'requester_id');
    }
   

}

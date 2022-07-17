<?php

namespace Modules\Publication\Entities;

use Illuminate\Database\Eloquent\Model;

class PublicationInventoryTransanction extends Model
{
    protected $table = "publication_inventory_transactions";
    protected $fillable = ['reference_table','reference_table_id','date','quantity','publication_inventory_id','status'];
}

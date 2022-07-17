<?php

    namespace Modules\HRM\Entities;

    use Illuminate\Database\Eloquent\Model;

    class Circular extends Model
    {
        public const PUBLIC_CIRCULAR = 999999;
        protected $fillable = [
            'title',
            'details',
            'expiry_date',
            'initiator_id'
        ];

        public function recipients()
        {
            return $this->hasMany(CircularRecipient::class, 'circular_id');
        }

        public function initiators()
        {
            return $this->belongsTo(Employee::class, 'initiator_id' , 'id');
        }

        public function attachment()
        {
            return $this->hasOne(CircularAttachment::class, 'circular_id');
        }

    }

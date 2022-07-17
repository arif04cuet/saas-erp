<?php

    namespace Modules\HRM\Entities;

    use Illuminate\Database\Eloquent\Model;

    class Note extends Model
    {
        protected $fillable = ['title', 'details', 'user_id', 'note_type_id'];
        //carbon instance fields
        protected $dates = ['created_at', 'updated_at'];

        public function noteType()
        {
            return $this->hasOne(NoteType::class, 'id', 'note_type_id');
        }

    }

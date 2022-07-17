<?php

    namespace Modules\HRM\Entities;

    use Illuminate\Database\Eloquent\Model;

    class NoteType extends Model
    {
        protected $fillable = ['name'];
        protected $table = 'notes_type';

        public function notes()
        {
            return $this->hasMany(Note::class,'note_type_id','id');
        }

    }

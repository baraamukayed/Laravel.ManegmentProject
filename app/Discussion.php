<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    //
    protected $fillable = ['project_id','teacher_id','student_id','date','time','place'];

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }


}

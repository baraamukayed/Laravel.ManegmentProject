<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    protected $fillable = ['project_id'];


    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function students(){
        return $this->hasMany(Student::class);
    }
}

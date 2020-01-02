<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $fillable = ['user_id','studentNumber','college','division','gender','level'];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function discussion(){
        return $this->hasOne(Discussion::class);
    }

    public function project(){
        return $this->hasOne(Project::class);
    }

    public function group(){
        return $this->belongsTo(Group::class);
    }

}

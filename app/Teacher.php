<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['user_id','teacherNumber','college','division','gender','phone','job','cv'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function discusstions(){
        return $this->hasMany(Discussion::class);
    }
}

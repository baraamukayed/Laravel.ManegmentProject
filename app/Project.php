<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = ['title','type','description','explanatory','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function discussion(){
        return $this->hasOne(Discussion::class);
    }

    public function students(){
        return $this->belongsTo(Student::class);
    }

    public function group(){
        return $this->hasOne(Group::class);
    }

}

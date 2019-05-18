<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name','thumbnail'
    ];

    //protected $guarded=[];

    public function user(){
        //$project->user
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    //取得関数
    public function  getThumbnailAttribute($value)
    {
        return $value ?? "taskdft.jpg";
    }

}

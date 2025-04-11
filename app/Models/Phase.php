<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    protected  $table  = 'phases';
    use HasFactory;

    public function developers(){
        return $this->hasMany(ProjectDevelopers::class,'phase_id');
    }
    
    public function tasks(){
        return $this->hasMany(Task::class,'phase_id');
    }

    
}

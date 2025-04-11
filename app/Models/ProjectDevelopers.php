<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDevelopers extends Model
{
    protected $fillable = ['user_id','phase_id','delivery_date','status'];

    public function users(){
        return $this->hasMany(User::class,'id','user_id');
    }
    use HasFactory;
}

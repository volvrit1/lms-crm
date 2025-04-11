<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['selectedphase_id','task_name','screenshot','completed_date','task_status' ,'pending_task_name','pending_task_date','project_status','description'];
    use HasFactory;

    public function users(){
        return $this->belongsTo(User::class,'user_id');

    }
}

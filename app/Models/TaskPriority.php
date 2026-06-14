<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskPriority extends Model
{
    protected $table = 'task_priority';
    protected $fillable = ['priority_name'];
    public $timestamps = false;
}

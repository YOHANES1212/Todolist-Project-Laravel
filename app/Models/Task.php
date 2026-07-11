<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $table = 'tasks';
    protected $fillable = ['user_id', 'title', 'description', 'task_status_id', 'task_priority_id', 'deadline'];
    protected $casts = ['deadline' => 'date'];

    /**
     * Get the user that owns the task.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the status of the task.
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(TaskStatus::class, 'task_status_id');
    }

    /**
     * Get the priority of the task.
     */
    public function priority(): BelongsTo
    {
        return $this->belongsTo(TaskPriority::class, 'task_priority_id');
    }
}

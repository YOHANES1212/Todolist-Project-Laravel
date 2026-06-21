<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\TaskPriority;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'task_status_id' => 'nullable|exists:task_status,id',
            'task_priority_id' => 'nullable|exists:task_priority,id',
        ]);

        $validated['user_id'] = Auth::id();

        Task::create($validated);

        return redirect()->back()->with('success', 'Task berhasil ditambahkan.');
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Check authorization
        if ($task->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'task_status_id' => 'nullable|exists:task_status,id',
            'task_priority_id' => 'nullable|exists:task_priority,id',
        ]);

        $task->update($validated);

        return redirect()->back()->with('success', 'Task berhasil diperbarui.');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task)
    {
        // Check authorization
        if ($task->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        $task->delete();

        return redirect()->back()->with('success', 'Task berhasil dihapus.');
    }

    /**
     * Update task status via AJAX.
     */
    public function updateStatus(Request $request, Task $task)
    {
        // Check authorization
        if ($task->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'task_status_id' => 'required|exists:task_status,id',
        ]);

        $task->update($validated);

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }

    /**
     * Update task priority via AJAX.
     */
    public function updatePriority(Request $request, Task $task)
    {
        // Check authorization
        if ($task->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'task_priority_id' => 'required|exists:task_priority,id',
        ]);

        $task->update($validated);

        return response()->json(['success' => true, 'message' => 'Priority updated successfully']);
    }
}

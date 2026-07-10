<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\TaskPriority;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the dashboard with task statistics.
     */
    public function index()
    {
        $user = Auth::user();

        $statuses = TaskStatus::all();
        $priorities = TaskPriority::all();

        $totalTasks = Task::where('user_id', $user->id)->count();

        $completedTasks = Task::where('user_id', $user->id)
            ->whereHas('status', function ($query) {
                $query->where('status_name', 'like', '%ompleted%');
            })
            ->count();

        $inProgressTasks = Task::where('user_id', $user->id)
            ->whereHas('status', function ($query) {
                $query->where('status_name', 'like', '%rogress%');
            })
            ->count();

        $notStartedTasks = Task::where('user_id', $user->id)
            ->whereHas('status', function ($query) {
                $query->where('status_name', 'like', '%Not%');
            })
            ->count();

        // Latest tasks (any status), most recent first
        $latestTasks = Task::where('user_id', $user->id)
            ->with('status', 'priority')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Most recently completed tasks, for the "Completed Task" panel
        $recentCompletedTasks = Task::where('user_id', $user->id)
            ->with('status', 'priority')
            ->whereHas('status', function ($query) {
                $query->where('status_name', 'like', '%ompleted%');
            })
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        $completedPercentage = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
        $inProgressPercentage = $totalTasks > 0 ? round(($inProgressTasks / $totalTasks) * 100) : 0;
        $notStartedPercentage = $totalTasks > 0 ? round(($notStartedTasks / $totalTasks) * 100) : 0;

        return view('dashboard', compact(
            'user',
            'statuses',
            'priorities',
            'totalTasks',
            'completedTasks',
            'inProgressTasks',
            'notStartedTasks',
            'latestTasks',
            'recentCompletedTasks',
            'completedPercentage',
            'inProgressPercentage',
            'notStartedPercentage'
        ));
    }
}

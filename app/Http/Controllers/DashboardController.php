<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        // Get current user
        $user = Auth::user();

        // Get all statuses and priorities for reference
        $statuses = TaskStatus::all();
        $priorities = TaskPriority::all();

        // Initialize default values
        $totalTasks = 0;
        $completedTasks = 0;
        $inProgressTasks = 0;
        $notStartedTasks = 0;
        $latestTasks = collect();
        $completedPercentage = 0;
        $inProgressPercentage = 0;
        $notStartedPercentage = 0;

        // If user is logged in, get user-specific data
        if ($user) {
            // Get task statistics
            $totalTasks = Task::where('user_id', $user->id)->count();
            
            // Count tasks by status
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

            // Get latest tasks (last 5)
            $latestTasks = Task::where('user_id', $user->id)
                ->with('status', 'priority')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        } else {
            // Get global statistics for demo/guest users
            $totalTasks = Task::count();
            
            $completedTasks = Task::whereHas('status', function ($query) {
                $query->where('status_name', 'like', '%ompleted%');
            })->count();
            
            $inProgressTasks = Task::whereHas('status', function ($query) {
                $query->where('status_name', 'like', '%rogress%');
            })->count();
            
            $notStartedTasks = Task::whereHas('status', function ($query) {
                $query->where('status_name', 'like', '%Not%');
            })->count();

            // Get latest tasks globally (last 5)
            $latestTasks = Task::with('status', 'priority')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        }

        // Calculate percentages
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
            'completedPercentage',
            'inProgressPercentage',
            'notStartedPercentage'
        ));
    }
}

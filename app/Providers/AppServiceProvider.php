<?php

namespace App\Providers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.main', function ($view) {
            $dueTasks = collect();
            $dueCount = 0;

            if (Auth::check()) {
                $query = Task::where('user_id', Auth::id())
                    ->whereNotNull('deadline')
                    ->whereDate('deadline', '<=', now()->toDateString())
                    ->whereHas('status', function ($q) {
                        $q->where('status_name', 'not like', '%ompleted%')
                            ->where('status_name', 'not like', '%Done%');
                    });

                $dueCount = (clone $query)->count();
                $dueTasks = $query->with('priority')->orderBy('deadline')->limit(8)->get();
            }

            $view->with('dueTasks', $dueTasks)->with('dueCount', $dueCount);
        });
    }
}

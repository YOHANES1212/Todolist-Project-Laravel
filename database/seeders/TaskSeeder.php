<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\TaskPriority;
use App\Models\User;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create a test user
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Bogin',
                'password' => bcrypt('password'),
            ]
        );

        // Get statuses and priorities
        $completedStatus = TaskStatus::firstOrCreate(['status_name' => 'Completed']);
        $inProgressStatus = TaskStatus::firstOrCreate(['status_name' => 'In Progress']);
        $notStartedStatus = TaskStatus::firstOrCreate(['status_name' => 'Not Started']);

        $highPriority = TaskPriority::firstOrCreate(['priority_name' => 'High']);
        $mediumPriority = TaskPriority::firstOrCreate(['priority_name' => 'Medium']);
        $lowPriority = TaskPriority::firstOrCreate(['priority_name' => 'Low']);

        // Sample tasks
        $tasksData = [
            [
                'title' => 'Pemweb - presentasi akhir',
                'description' => 'Persiapan presentasi akhir mata kuliah Pemrograman Web',
                'task_status_id' => $inProgressStatus->id,
                'task_priority_id' => $highPriority->id,
            ],
            [
                'title' => 'Presentation Final Project',
                'description' => 'Persiapan presentasi untuk final project',
                'task_status_id' => $inProgressStatus->id,
                'task_priority_id' => $highPriority->id,
            ],
            [
                'title' => 'Pemweb - Harus selesai',
                'description' => 'Tugas pemrograman web yang harus diselesaikan minggu ini',
                'task_status_id' => $inProgressStatus->id,
                'task_priority_id' => $mediumPriority->id,
            ],
            [
                'title' => 'Presentation Final Project - Prepare slides',
                'description' => 'Mempersiapkan slide presentasi untuk final project',
                'task_status_id' => $inProgressStatus->id,
                'task_priority_id' => $mediumPriority->id,
            ],
            [
                'title' => 'HTML + CSS Project',
                'description' => 'Membuat project dengan HTML dan CSS untuk tanggal 7 September',
                'task_status_id' => $inProgressStatus->id,
                'task_priority_id' => $highPriority->id,
            ],
            [
                'title' => 'Database Design',
                'description' => 'Mendesain database schema untuk aplikasi',
                'task_status_id' => $completedStatus->id,
                'task_priority_id' => $highPriority->id,
            ],
            [
                'title' => 'API Development',
                'description' => 'Mengembangkan REST API endpoints',
                'task_status_id' => $completedStatus->id,
                'task_priority_id' => $mediumPriority->id,
            ],
            [
                'title' => 'Unit Testing',
                'description' => 'Membuat unit tests untuk business logic',
                'task_status_id' => $notStartedStatus->id,
                'task_priority_id' => $mediumPriority->id,
            ],
            [
                'title' => 'Documentation',
                'description' => 'Menulis dokumentasi project',
                'task_status_id' => $notStartedStatus->id,
                'task_priority_id' => $lowPriority->id,
            ],
            [
                'title' => 'Deployment Setup',
                'description' => 'Mengatur deployment ke production server',
                'task_status_id' => $notStartedStatus->id,
                'task_priority_id' => $highPriority->id,
            ],
        ];

        // Create tasks
        foreach ($tasksData as $taskData) {
            Task::create(array_merge($taskData, ['user_id' => $user->id]));
        }
    }
}

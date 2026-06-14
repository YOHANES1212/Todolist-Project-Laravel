<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaskStatus;
use App\Models\TaskPriority;

class TaskKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['Todo', 'In Progress', 'Done', 'Cancelled'];
        foreach ($statuses as $s) {
            TaskStatus::firstOrCreate(['status_name' => $s]);
        }

        $priorities = ['Low', 'Medium', 'High', 'Critical'];
        foreach ($priorities as $p) {
            TaskPriority::firstOrCreate(['priority_name' => $p]);
        }
    }
}

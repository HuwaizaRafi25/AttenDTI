<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tasks; // Pastikan namespace model Tasks sesuai dengan struktur aplikasi kamu
use Carbon\Carbon;

class UpdateOverdueTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:update-overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update tasks with status "todo" that have passed the due date to "backlog"';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

    $tasks = Tasks::where('status', 'todo')
                        ->where('due_date', '<', $now)
                        ->get();

        if ($tasks->isEmpty()) {
            $this->info('Tidak ada task overdue.');
        } else {
            foreach ($tasks as $task) {
                $task->status = 'backlog';
                $task->save();
                $this->info("Task ID {$task->id} telah diupdate menjadi backlog.");
            }
        }

        return 0;
    }
}

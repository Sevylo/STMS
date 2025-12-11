<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Notifications\TaskDeadlineReminder;
use Carbon\Carbon;

class SendStartReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders for tasks due in 7, 3, or 1 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = Task::where('status', 'pending')->get();
        $count = 0;

        foreach ($tasks as $task) {
            $deadline = Carbon::parse($task->deadline);
            $now = Carbon::now();
            $diffInDays = $now->diffInDays($deadline, false);

            // Check for exact days (ignoring time slightly, checking if it falls within the day range)
            // Actually diffInDays returns integer difference. 
            // Better to check if deadline is between start of day + X and end of day + X? 
            // Simple check: 
            // If deadline is 2025-01-08 and today is 2025-01-01 (7 days).
            
            // Let's be precise: 
            // 7 days rem: deadline is in 7 days (diff 7)
            // 3 days rem: deadline is in 3 days (diff 3)
            // 1 day rem: deadline is in 1 day (diff 1)
            
            // We use simple integer cast comparison for day difference
            $days = (int) ceil($now->floatDiffInDays($deadline, false));

            if (in_array($days, [7, 3, 1])) {
                $task->user->notify(new TaskDeadlineReminder($task, $days));
                $this->info("Sent reminder for task: {$task->title} ({$days} days left)");
                $count++;
            }
        }

        $this->info("Sent {$count} reminders.");
    }
}

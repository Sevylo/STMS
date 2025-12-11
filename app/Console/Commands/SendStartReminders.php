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
            
            // Check custom reminder
            if ($task->reminder_at) {
                $reminderAt = Carbon::parse($task->reminder_at);
                if ($reminderAt->isToday() && $reminderAt->gte($now)) {
                     // Simple logic: If reminder is "today" and "future" (or just today if running daily).
                     // Since command runs daily, checking isToday is sufficient. 
                     // To avoid duplicates if run multiple times, ideally we'd track it. 
                     // For MVP, we'll just check isToday.
                     $task->user->notify(new TaskDeadlineReminder($task, 'Custom Reminder'));
                     $this->info("Sent custom reminder for task: {$task->title}");
                     $count++;
                     continue; // Skip default checks if custom reminder sent
                }
            }

            // Default deadline warnings (7, 3, 1 days) - Only if no custom reminder set or not today?
            // Let's keep them independent or prioritized? 
            // Independent is better.
            
            $days = (int) ceil($now->floatDiffInDays($deadline, false));

            if (in_array($days, [7, 3, 1])) {
                $task->user->notify(new TaskDeadlineReminder($task, $days));
                $this->info("Sent deadline reminder for task: {$task->title} ({$days} days left)");
                $count++;
            }
        }

        $this->info("Sent {$count} reminders.");
    }
}

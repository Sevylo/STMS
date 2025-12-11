<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Auth::user()->tasks()
            ->orderBy('deadline', 'asc')
            ->get();
            
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'reminder_at' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
        ]);

        Auth::user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'reminder_at' => $request->reminder_at,
            'priority' => $request->priority,
            'status' => 'pending',
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function startEdit(Task $task) {
        // ... (existing)
    }

    public function markNotificationsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'reminder_at' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }
    
    public function togglestatus(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }
        
        $task->update([
            'status' => $task->status === 'pending' ? 'completed' : 'pending'
        ]);
        
        return redirect()->back()->with('success', 'Task status updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}

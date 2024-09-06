<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('employee')->where('created_by', auth()->user()->id)->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $employees = User::where('role', 'employee')->get(); // Assuming role-based access
        return view('tasks.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'employee_id' => 'required|exists:users,id',
            'due_date' => 'required|date',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'pending',
            'due_date' => $request->due_date,
            'employee_id' => $request->employee_id,
            'created_by' => auth()->user()->id,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }
    public function edit(Task $task)
    {
        // Only allow managers (task creators) to edit
        if (auth()->user()->id !== $task->created_by) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized access.');
        }

        $employees = User::where('role', 'employee')->get(); // Assuming role-based access
        return view('tasks.edit', compact('task', 'employees'));
    }

    public function update(Request $request, Task $task)
    {
        // Only allow managers (task creators) to update
        if (auth()->user()->id !== $task->created_by) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'title' => 'required',
            'employee_id' => 'required|exists:users,id',
            'due_date' => 'required|date',
        ]);

        // Update task details
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'employee_id' => $request->employee_id,
            'status' => $request->status,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        // Only allow managers (task creators) to delete
        if (auth()->user()->id !== $task->created_by) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized access.');
        }

        // Delete the task
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
    public function completeTask(Task $task)
    {
        // Check if the logged-in user is the assigned employee
        if (auth()->user()->id !== $task->employee_id) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized access.');
        }

        // Mark the task as completed
        $task->status = 'completed';
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task marked as completed.');
    }
}
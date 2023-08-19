<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBY('priority','DESC')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(CreateTaskRequest $request)
    {
        Task::create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        $checked = $task->completed == 1 ? "checked" : "";

        return view('tasks.edit', compact('task','checked'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $data = $request->all();

        if($request->completed)
            $data ['completed'] = 1;

        if (strtotime($task->due_date) != strtotime($data['due_date']) && strtotime($data['due_date'])<strtotime(date('y-m-d'))) {
            return  $request->validate([
                'due_date'=>"date|after:yesterday"
            ]);
        }

        $task->update($data);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }


    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}

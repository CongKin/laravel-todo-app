<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::query()->orderBy("created_at","desc")->paginate();

        return view("task.index", ["tasks"=> $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("task.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'task' => ['required', 'string', 'max:255'],
            'description'=> ['nullable', 'string'],
            'status' => ['required', 'in:1,2,3'],
            'priority' => ['required', 'in:1,2,3'],
            'deadline' => ['nullable', 'date'],
        ]);

        $data['user_id'] = 1;
        $task = Task::create($data);

        return to_route('task.show', $task)->with('message', 'Note was created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view("task.show", ["task"=> $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return 'edit';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Tasks;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();

        $todoTasks = Tasks::where('status', 'todo')->where('user_id', $userId)->get();
        $inProgressTasks = Tasks::where('status', 'in_progress')->where('user_id', $userId)->get();
        $inReviewTasks = Tasks::where('status', 'in_review')->where('user_id', $userId)->get();
        $completedTasks = Tasks::where('status', 'completed')->where('user_id', $userId)->get();
        $backlogTasks = Tasks::where('status', 'backlog')->where('user_id', $userId)->get();

        return view('menus.task', compact(
            'todoTasks',
            'inProgressTasks',
            'inReviewTasks',
            'completedTasks',
            'backlogTasks'
        ));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'start_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
        ]);

        $validatedData['user_id'] = auth()->id();
        $validatedData['status'] = 'todo';

        $task = Tasks::create($validatedData);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'task' => $task
            ]);
        }

        return redirect()->back()->with('success', 'Task berhasil dibuat!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

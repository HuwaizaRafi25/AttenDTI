<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();

        // Mengambil hanya task yang aktif (is_active true) untuk user tertentu
        $allTasks = Tasks::where('user_id', $userId)
            ->where('is_active', true)
            ->get();

        $todoTasks = $allTasks->where('status', 'todo');
        $inProgressTasks = $allTasks->where('status', 'in_progress');
        $completedTasks = $allTasks->where('status', 'completed');
        $backlogTasks = $allTasks->where('status', 'backlog');

        $minStartDate = $allTasks->min('start_date');
        $maxDueDate = $allTasks->max('due_date');

        return view('menus.task', compact(
            'todoTasks',
            'inProgressTasks',
            'completedTasks',
            'backlogTasks',
            'minStartDate',
            'maxDueDate'
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
    public function update(Request $request, Tasks $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $task->update($request->all());

        return response()->json(['success' => true, 'task' => $task]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function deactivate(Tasks $task)
    {
        $task->update(['is_active' => false]);

        return response()->json([
            'success' => true,
            'message' => 'Task deactivated successfully'
        ]);
    }

    // Fungsi untuk mengubah status menjadi "in_progress" atau "completed"
    public function changeStatus(Request $request, $id, $status)
    {
        $request->validate(['status' => 'required|in:in_progress,completed']);
        $task = Tasks::findOrFail($id);
        $task->status = $request->input('status');
        $task->save();
        return response()->json(['success' => true, 'task' => $task]);
    }
}

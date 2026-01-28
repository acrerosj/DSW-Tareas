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
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
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
        $request->merge([
            'completed' => $request->has('completed'),
            'endtime' => $request->input('endtime') ?: now(),
            'user_id' => Auth::id(),
        ]);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean',
            'endtime' => 'date',
            'user_id' => 'required|exists:users,id',
        ]);

        Task::create($validated);
        return redirect()->route('tasks.index')->with('success', 'La tarea ha sido creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
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
        if (Auth::id() !== $task->user_id) {
            return redirect()->route('tasks.index')->with('error', 'No tienes permiso para eliminar esta tarea.');
        }
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'La tarea ha sido eliminada exitosamente.');
    }
}

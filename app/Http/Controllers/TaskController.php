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
        // Si todos los usuarios pueden ver todas las tareas
        // $tasks = Task::all();
        $tasks = Task::with('user')->paginate(10);
    
        // Si solo los usuarios autenticados pueden ver sus propias tareas
        // $tasks = [];
        // if (Auth::check()) {
        //     //$tasks = Task::where('user_id', Auth::id())->get();
        //     $tasks = Auth::user()->tasks;
        // } 
        return view('tasks.index', compact('tasks'));

    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // No lo usamos porque el formulario de creación está en la vista index
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
        // Verificar que el usuario autenticado es el propietario de la tarea
        if (Auth::id() !== $task->user_id) {
            return redirect()->route('tasks.index')->with('error', 'No tienes permiso para editar esta tarea.');
        }
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Verificar que el usuario autenticado es el propietario de la tarea
        if (Auth::id() !== $task->user_id) {
            return redirect()->route('tasks.index')->with('error', 'No tienes permiso para actualizar esta tarea.');
        }

        $request->merge([
            'completed' => $request->has('completed'),
        ]);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean',
            'endtime' => 'date|required',
        ]);

        $task->update($validated);
        return redirect()->route('tasks.index')->with('success', 'La tarea ha sido actualizada exitosamente.');
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

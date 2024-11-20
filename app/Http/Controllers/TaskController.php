<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['category', 'tags'])->get();
        return view('tasks.index', compact('tasks'));
    }

    public function show($id)
    {
        $task = Task::with(['category', 'tags'])->findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('tasks.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);
    
        $task = Task::create($validated);
        if (!empty($validated['tags'])) {
            $task->tags()->attach($validated['tags']);
        }
    
        return redirect()->route('tasks.index')->with('success', 'Задача успешно создана!');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
    $categories = Category::all();
    $tags = Tag::all();
    return view('tasks.edit', compact('task', 'categories', 'tags'));
    }

    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'category_id' => 'required|exists:categories,id',
        'tags' => 'nullable|array',
        'tags.*' => 'exists:tags,id',
    ]);

    $task = Task::findOrFail($id);
    $task->update($validated);

    if (!empty($validated['tags'])) {
        $task->tags()->sync($validated['tags']);
    } else {
        $task->tags()->detach();
    }

    return redirect()->route('tasks.index')->with('success', 'Задача успешно обновлена!');
}


public function destroy($id)
{
    $task = Task::findOrFail($id);
    $task->tags()->detach(); // Удаляем связь с тегами
    $task->delete();

    return redirect()->route('tasks.index')->with('success', 'Задача успешно удалена!');
}

}

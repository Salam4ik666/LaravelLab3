@extends('layouts.app')

@section('content')
    <h1>Редактировать задачу</h1>

    @include('tasks.form', [
        'action' => route('tasks.update', $task->id),
        'method' => 'PUT',
        'categories' => $categories,
        'tags' => $tags,
        'task' => $task,
        'buttonText' => 'Обновить'
    ])
@endsection

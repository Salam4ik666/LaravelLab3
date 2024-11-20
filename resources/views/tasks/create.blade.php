@extends('layouts.app')

@section('content')
    <h1>Создать новую задачу</h1>

    @include('tasks.form', [
        'action' => route('tasks.store'),
        'method' => 'POST',
        'categories' => $categories,
        'tags' => $tags,
        'buttonText' => 'Создать'
    ])
@endsection

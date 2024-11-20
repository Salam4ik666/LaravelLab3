@extends('layouts.app')

@section('content')
    <h1>{{ $task->title }}</h1>
    <p>{{ $task->description }}</p>
    <p>Категория: {{ $task->category->name }}</p>
    <p>Теги:
        @foreach($task->tags as $tag)
            <span>{{ $tag->name }}</span>
        @endforeach
    </p>

    <a href="{{ route('tasks.edit', $task->id) }}">Редактировать</a>
    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Удалить</button>
    </form>
    <a href="{{ route('tasks.index') }}">Назад к списку</a>
@endsection

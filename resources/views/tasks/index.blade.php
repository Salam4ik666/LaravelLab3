@extends('layouts.app')

@section('content')
    <h1>Список задач</h1>
    <a href="{{ route('tasks.create') }}">Создать задачу</a>

    @foreach($tasks as $task)
        <div>
            <h2>{{ $task->title }}</h2>
            <p>{{ $task->description }}</p>
            <p>Категория: {{ $task->category->name }}</p>
            <p>Теги:
                @foreach($task->tags as $tag)
                    <span>{{ $tag->name }}</span>
                @endforeach
            </p>
            <a href="{{ route('tasks.show', $task->id) }}">Подробнее</a>
            <a href="{{ route('tasks.edit', $task->id) }}">Редактировать</a>
            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Удалить</button>
            </form>
        </div>
    @endforeach
@endsection

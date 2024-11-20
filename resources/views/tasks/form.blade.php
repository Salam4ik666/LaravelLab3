<form action="{{ $action }}" method="POST">
    @csrf
    @if(isset($method) && $method !== 'POST')
        @method($method)
    @endif

    <div>
        <label for="title">Название задачи:</label>
        <input 
            type="text" 
            name="title" 
            id="title" 
            value="{{ old('title', $task->title ?? '') }}" 
            required>
    </div>

    <div>
        <label for="description">Описание задачи:</label>
        <textarea 
            name="description" 
            id="description" 
            required>{{ old('description', $task->description ?? '') }}</textarea>
    </div>

    <div>
        <label for="category_id">Категория:</label>
        <select name="category_id" id="category_id" required>
            <option value="">Выберите категорию</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" 
                    {{ old('category_id', $task->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Теги:</label>
        @foreach($tags as $tag)
            <div>
                <input 
                    type="checkbox" 
                    name="tags[]" 
                    value="{{ $tag->id }}" 
                    id="tag_{{ $tag->id }}" 
                    {{ isset($task) && $task->tags->contains($tag->id) ? 'checked' : '' }}>
                <label for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
            </div>
        @endforeach
    </div>

    <button type="submit">
        {{ $buttonText ?? 'Сохранить' }}
    </button>
</form>

@extends('layouts.main')

@section('content')
    <div class="container">
        <h1 class="my-4">{{ $category->name }}</h1>

        <div class="mb-3">
            <label for="name" class="form-label">Название категории:</label>
            <input type="text" class="form-control" id="name" value="{{ $category->name }}" readonly>
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Слаг категории:</label>
            <input type="text" class="form-control" id="slug" value="{{ $category->slug }}" readonly>
        </div>

        <div class="mb-3">
            <label for="created_at" class="form-label">Дата создания:</label>
            <input type="text" class="form-control" id="created_at" value="{{ $category->created_at->format('d.m.Y H:i') }}" readonly>
        </div>

        <div class="mb-3">
            <label for="updated_at" class="form-label">Дата обновления:</label>
            <input type="text" class="form-control" id="updated_at" value="{{ $category->updated_at->format('d.m.Y H:i') }}" readonly>
        </div>

        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Назад к списку категорий</a>
        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">Редактировать категорию</a>
    </div>
@endsection

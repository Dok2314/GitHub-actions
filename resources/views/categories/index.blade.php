@extends('layouts.main')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <h1 class="my-4">Список категорий</h1>

        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Создать</a>

        @if ($categories->isEmpty())
            <p>Категории отсутствуют.</p>
        @else
            <ul class="list-group">
                @foreach ($categories as $category)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ route('categories.show', $category->id) }}">
                            {{ $category->name }}
                        </a>
                        <form action="{{ route('categories.delete', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Вы уверены, что хотите удалить эту категорию?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection

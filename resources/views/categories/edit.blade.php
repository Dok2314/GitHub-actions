@extends('layouts.main')

@section('content')
    <div class="container">
        <h1 class="my-4">Редактирование категории</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Название категории</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required oninput="generateSlug()">
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Слаг категории</label>
                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $category->slug) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Обновить категорию</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Назад к списку категорий</a>
        </form>
    </div>

    <script>
        function generateSlug() {
            const nameInput = document.getElementById('name');
            const slugInput = document.getElementById('slug');

            const cyrillicToLatinMap = {
                'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'e',
                'ж': 'zh', 'з': 'z', 'и': 'i', 'й': 'y', 'к': 'k', 'л': 'l', 'м': 'm',
                'н': 'n', 'о': 'o', 'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u',
                'ф': 'f', 'х': 'kh', 'ц': 'ts', 'ч': 'ch', 'ш': 'sh', 'щ': 'shch',
                'ъ': '', 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu', 'я': 'ya',
                'А': 'A', 'Б': 'B', 'В': 'V', 'Г': 'G', 'Д': 'D', 'Е': 'E', 'Ё': 'E',
                'Ж': 'Zh', 'З': 'Z', 'И': 'I', 'Й': 'Y', 'К': 'K', 'Л': 'L', 'М': 'M',
                'Н': 'N', 'О': 'O', 'П': 'P', 'Р': 'R', 'С': 'S', 'Т': 'T', 'У': 'U',
                'Ф': 'F', 'Х': 'Kh', 'Ц': 'Ts', 'Ч': 'Ch', 'Ш': 'Sh', 'Щ': 'Shch',
                'Ъ': '', 'Ы': 'Y', 'Ь': '', 'Э': 'E', 'Ю': 'Yu', 'Я': 'Ya'
            };

            const slug = nameInput.value
                .split('')
                .map(char => cyrillicToLatinMap[char] || char)
                .join('')
                .toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-')
                .replace(/^-+|-+$/g, '');

            slugInput.value = slug;
        }
    </script>
@endsection

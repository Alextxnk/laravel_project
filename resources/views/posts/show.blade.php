@extends('layouts.layout', ['title' => "Пост #$posts->post_id. $posts->title"]) {{-- подключили файл --}}

@section('content')

    <div class="row">
            <div class="col-12"> {{-- карточка будет во весь экран --}}
                <div class="card">
                    <div class="card-header"><h2>{{ $posts->title }}</h2></div>
                    <div class="card-body">
                        <div class="card-img card-img__max" style="background-image: url({{{ $posts->img ?? asset('img/default.jpg') }}})"></div>
                        <div class="card-description">Описание: {{ $posts->description }}</div>
                        <div class="card-author">Автор: {{ $posts->name }}</div>
                        <div class="card-date">Пост создан: {{ $posts->created_at->diffForHumans() }}</div> {{-- метод diffForHumans выводит дату по-другому --}}
                        <div class="card-btn">
                            <a href="{{ route('post.index') }}" class="btn btn-outline-primary">На главную</a>
                            <a href="{{ route('post.edit', ['id' => $posts->post_id]) }}" class="btn btn-outline-success">Редактировать</a>
                            {{-- форма для удаления поста  --}}
                            <form action="{{ route('post.destroy', ['id' => $posts->post_id]) }}" method="post" onsubmit="if (confirm('Точно хотите удалить пост?')) { return true } else { return false } ">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-outline-danger" value="Удалить">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>

@endsection

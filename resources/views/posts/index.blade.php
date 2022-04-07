@extends('layouts.layout', ['title' => 'Главная страница']) {{-- подключили файл и передали title --}}

@section('content')
    {{-- добавить нормальные окночания, сделать еще ифов  --}}
    {{-- 1 пост; 2-4 поста; 5-20 постов--}}
    {{-- поиск  --}}
    @if(isset($_GET['search']))
        @if(count ($posts)===1)
            <h2>Результаты поиска по запросу <?= $_GET['search'] ?></h2>
            <p class="lead">Всего найден {{ count($posts) }} пост</p>
        @elseif(count ($posts)===2)
            <h2>Результаты поиска по запросу <?= $_GET['search'] ?></h2>
            <p class="lead">Всего найдено {{ count($posts) }} поста</p>
        @elseif(count ($posts)===3)
            <h2>Результаты поиска по запросу <?= $_GET['search'] ?></h2>
            <p class="lead">Всего найдено {{ count($posts) }} поста</p>
        @elseif(count ($posts)===4)
            <h2>Результаты поиска по запросу <?= $_GET['search'] ?></h2>
            <p class="lead">Всего найдено {{ count($posts) }} поста</p>
        @elseif(count ($posts)>4)
            <h2>Результаты поиска по запросу <?= $_GET['search'] ?></h2>
            <p class="lead">Всего найдено {{ count($posts) }} постов</p>
        @else
            <h2>По запросу <?= $_GET['search'] ?> ничего не найдено</h2>
            <a href="{{ route('post.index') }}" class="btn btn-outline-primary">Отобразить все посты</a>
        @endif
    @endif

    <div class="row">
        {{-- таким образом работает шаблонизатор blade --}}
        @foreach($posts as $post)
            <div class="col-6">
                <div class="card">
                    <div class="card-header"><h2>{{ $post->short_title }}</h2></div>
                    <div class="card-body">
                        <div class="card-img" style="background-image: url({{{ $post->img ?? asset('img/default.jpg') }}})"></div>
                        <div class="card-author">Автор: {{ $post->name }}</div>
                        <a href="{{ route('post.show', ['id' => $post->post_id]) }}" class="btn btn-outline-primary">Посмотреть пост</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if(!isset($_GET['search'])) {{-- если мы не производим поиск, то нам нужна пагинация --}}
    {{ $posts->links() }}  {{-- метод links отвечает за пагинацию --}}
    @endif
@endsection

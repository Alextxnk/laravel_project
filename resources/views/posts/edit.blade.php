@extends('layouts.layout', ['title' => "Редактировать пост #$posts->post_id"]) {{-- подключили файл --}}

@section('content')
    <form action="{{ route('post.update', ['id' => $posts->post_id]) }}" method="post" enctype="multipart/form-data">
        {{-- csrf(защита) - встроенная директива, с ее помощью ставится input с type="hidden", в который записывается токен, по этому токену бцдет проверяться, мы ли отправляем форму или нет --}}
        @csrf
        @method('PATCH') {{-- метод patch поскольку будем изменять уже существующую запись в БД --}}
        <h3>Редактировать пост</h3>
        @include('posts.parts.form')
        {{--<div class="form-group">
           <input name="title" type="text" class="form-control" required value="{{ $posts->title }}"> --}}{{-- required - обязательные поля --}}{{--
        </div>
        <div class="form-group">
           <textarea name="description" rows="10" class="form-control" required>{{ $posts->description }}</textarea>
        </div>
        <div class="form-group">
            <input type="file" name="img">
        </div>--}}

        <input type="submit" value="Редактировать пост" class="btn btn-outline-success">
    </form>
@endsection

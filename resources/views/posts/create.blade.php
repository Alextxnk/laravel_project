@extends('layouts.layout', ['title' => "Создать новый пост"]) {{-- подключили файл --}}

@section('content')
    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
        {{-- csrf(защита) - встроенная директива, с ее помощью ставится input с type="hidden", в который записывается токен, по этому токену бцдет проверяться, мы ли отправляем форму или нет --}}
        @csrf
        <h3>Создать пост</h3>
        @include('posts.parts.form')
        {{--<div class="form-group">
           <input name="title" type="text" class="form-control" required> --}}{{-- required - обязательные поля --}}{{--
        </div>
        <div class="form-group">
           <textarea name="description" rows="10" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <input type="file" name="img">
        </div>--}}

        <input type="submit" value="Создать пост" class="btn btn-outline-success">
    </form>
@endsection

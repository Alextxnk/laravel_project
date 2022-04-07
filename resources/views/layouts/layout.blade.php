{{-- DRY - don't repeat yourself --}}
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <div class="container collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="col-6 navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Главная</a>
                </li>
                <li class="nav-item offset-3">
                    <a class="nav-link active" aria-current="page" href="{{ route('post.create') }}">Создать пост</a>
                </li>

            </ul>
            <form class="d-flex" action="{{ route('post.index') }}"> {{-- прописан в файле web.php --}}
                <input class="form-control me-2" name="search" type="search" placeholder="Найти пост" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Поиск</button>
            </form>
        </div>
    </div>
</nav>

{{-- .container>.row>.col-6>.card>.card-header+.card-body --}}
<div class="container">

    {{-- делаем "флешку" для вывода сообщения об ошибке --}}
    @if($errors->any()) {{-- если есть какие-то ошибки --}}
        @foreach($errors->all() as $error) {{-- мы проходимся по всем ошибкам циклом --}}
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            {{ $error }} {{-- и выводим ошибку --}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endforeach
    @endif

    {{-- делаем "флешку" - alert сообщение вверху экрана --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @yield('content') {{-- означает, что в контейнере может быть динамический контент, а в наследуемых файлах вызываем section --}}
</div>

<script src="{{ asset('js/app.js') }}"></script> {{-- app.js нормально не хочет работать, а по ссылке все ок--}}
{{-- скрипт, чтоб закрывалось alert сообщение --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

</body>
</html>

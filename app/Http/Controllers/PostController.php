<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */

    public function index(Request $request)
    {
        // поиск
        if ($request->search) {
            $posts = DB::table('posts')
                ->join('users', 'posts.author_id', '=', 'users.id')
                ->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->orWhere('name', 'like', '%' . $request->search . '%')
                ->orderBy('posts.created_at', 'desc')
                ->get();
            return view('posts.index', compact('posts'));
        }

        // вывод постов
        $posts = DB::table('posts')
            ->join('users', 'posts.author_id', '=', 'users.id')
            ->orderBy('posts.created_at', 'desc')
            ->paginate(4);
        return view('posts.index', compact('posts'));

        // связали(объединили) таблицы с помощью join по полям posts.author_id и users.id
        // выводим посты в обратном порядке: от свежего к старым
        // Пагинация - будем выводить по 4 поста на странице
        // генерируем view и передаем в нее переменную под названием  posts
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */

    public function create()
    {
        return view('posts.create'); // просто выводим вьюху с созданием поста
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return RedirectResponse
     */

    public function store(PostRequest $request): RedirectResponse
    {
        $post = new Post(); // создали объект класса Post
        $post->title = $request->title; // добавление заголовка в БД
        $post->short_title = Str::length($request->title)>30 ? \Str::substr($request->title, 0,30) . '...' : $request->title; // добавление короткого заголовка в БД
        $post->description = $request->description; // добавление описание в БД
        $post->author_id = rand(1, 4); // пока у нас не реализована авторизация, мы рандомно заполняем это поле в таблице

        // если загрузили картинку, в ином случае у нас ставится дефолтная картинка в файле index.blade.php
        if($request->file('img')) {
            $path = Storage::putFile('public', $request->file('img')); // кладем файл с картинкой в папку public
            $url = Storage::url($path); // получаем ссылку, где будет храниться картинка
            $post->img = $url; // поместили нашу url в БД
        }

        $post->save(); // с помощью метода save сохранили все в БД

        return redirect()->route('post.index')->with('success', 'Пост успешно создан');  // после создания записи редиректимся на страницу index и появляется alert сообщение
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */

    public function show(int $id)
    {
        $posts = Post::join('users', 'posts.author_id', '=', 'users.id')
            ->find($id);
        return view('posts.show', compact('posts'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $posts = Post::find($id);
        return view('posts.edit', compact('posts'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param int $id
     * @return RedirectResponse
     */

    public function update(PostRequest $request, int $id)
    {
        $post = Post::find($id);
        $post->title = $request->title; // перезаписывается заголовок в БД
        $post->short_title = Str::length($request->title)>30 ? \Str::substr($request->title, 0,30) . '...' : $request->title; // перезаписывается короткий заголовок в БД
        $post->description = $request->description; // перезаписывается описание в БД

        if($request->file('img')) {
            $path = Storage::putFile('public', $request->file('img')); // кладем файл с картинкой в папку public
            $url = Storage::url($path); // получаем ссылку, где будет храниться картинка
            $post->img = $url; // поместили нашу url в БД
        }

        $post->update(); // с помощью метода update обновили запись в БД
        $id = $post->post_id;

        return redirect()->route('post.show', compact('id'))->with('success', 'Пост успешно отредактирован');  // после редактирования записи по id редиректимся на страницу show и появляется alert сообщение
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */

    public function destroy(int $id)
    {
        $post = Post::find($id); // находим пост по id
        $post->delete(); // удаляем его

        return redirect()->route('post.index')->with('success', 'Пост успешно удален');  // после удаления записи редиректимся на страницу index и появляется alert сообщение
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('post_id');
            $table->bigInteger('author_id')->unsigned(); // чтоб не было ошибки
            $table->string('title');
            $table->string('short_title');
            $table->string('img')->nullable(); // поскольку вместо картинки может быть какое-то дефолтное значение, при создании новой записи нам необязательно вставлять картинку
            $table->text('description');
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users'); // внешний ключ связан по id c таблицей users
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

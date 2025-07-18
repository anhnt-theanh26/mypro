<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) { // Mục đích: Quản lý bài hát yêu thích của người dùng.
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // ID người dùng
            $table->foreignId('song_id')->constrained('songs'); // ID bài hát
            $table->timestamps();  // Thời gian tạo và cập nhật
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) { // Mục đích: Quản lý đánh giá của người dùng về bài hát.
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // ID người dùng
            $table->foreignId('song_id')->constrained('songs'); // ID bài hát
            $table->integer('rating')->default(0);  // Đánh giá bài hát (1-5 sao)
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
        Schema::dropIfExists('ratings');
    }
}

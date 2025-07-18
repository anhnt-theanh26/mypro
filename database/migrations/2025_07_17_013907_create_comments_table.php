<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) { // Mục đích: Quản lý các bình luận của người dùng về bài hát.
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // ID người dùng
            $table->foreignId('song_id')->constrained('songs'); // ID bài hát
            $table->text('comment'); // Nội dung bình luận
            $table->foreignId('parent_comment_id')->nullable()->constrained('comments'); // ID bình luận cha (nếu có)
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
        Schema::dropIfExists('comments');
    }
}

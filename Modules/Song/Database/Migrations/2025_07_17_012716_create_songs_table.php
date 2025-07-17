<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) { // Mục đích: Quản lý thông tin bài hát.
            $table->id();
            $table->string('title')->nullable();  // Tiêu đề bài hát
            $table->string('artist')->nullable(); // Tên nghệ sĩ
            $table->unsignedBigInteger('album_id')->nullable(); // Tên album (nếu có)
            $table->string('file_path')->nullable(); // Đường dẫn tệp âm thanh
            $table->integer('play_count')->default(0);  // Số lần phát bài hát
            $table->enum('type', ['normal', 'premium'])->default('normal');  // Loại bài hát: bình thường hoặc premium
            $table->integer('duration')->nullable(); // Thời gian bài hát (seconds)
            $table->timestamp('release_date')->nullable(); // Ngày phát hành
            $table->unsignedBigInteger('album_id')->nullable(); 
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('songs');
    }
}

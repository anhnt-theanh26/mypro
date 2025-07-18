<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlists', function (Blueprint $table) { // Mục đích: Quản lý các playlist mà người dùng tạo ra.
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // ID người dùng
            $table->string('title')->nullable(); // Tiêu đề playlist
            $table->text('description')->nullable(); // Mô tả playlist
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
        Schema::dropIfExists('playlists');
    }
}

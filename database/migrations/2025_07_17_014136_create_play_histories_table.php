<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('play_histories', function (Blueprint $table) { // Mục đích: Quản lý lịch sử phát nhạc của người dùng.
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // ID người dùng
            $table->foreignId('song_id')->constrained('songs'); // ID bài hát
            $table->timestamp('played_at'); // Thời gian bài hát được phát
            $table->string('device')->nullable(); // Thiết bị phát nhạc (web, mobile, etc.)
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
        Schema::dropIfExists('play_histories');
    }
}

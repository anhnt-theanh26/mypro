<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) { // Mục đích: Quản lý các gói đăng ký của người dùng.
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // ID người dùng
            $table->string('plan_name'); // Tên gói đăng ký (ví dụ: Free, Premium, Family, etc.)
            $table->string('plan_type');  // Loại gói đăng ký (ví dụ: free, premium)
            $table->timestamp('start_date');  // Ngày bắt đầu gói đăng ký
            $table->timestamp('end_date');  // Ngày kết thúc gói đăng ký
            $table->boolean('auto_renew')->default(true);  // Tự động gia hạn
            $table->string('status')->default('active'); // Trạng thái gói đăng ký (active/inactive)
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
        Schema::dropIfExists('subscriptions');
    }
}

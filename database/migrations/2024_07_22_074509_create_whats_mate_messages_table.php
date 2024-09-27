<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhatsWingMessagesTable extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('api_key')->nullable();
            $table->string('phone_no');
            $table->longText('message');
            $table->string('status');
            $table->Integer('priority')->default(0);
            $table->string('type')->nullable();
            $table->string('data')->nullable();
            $table->timestamp('status_updated_at')->nullable();
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamps(); 

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
}

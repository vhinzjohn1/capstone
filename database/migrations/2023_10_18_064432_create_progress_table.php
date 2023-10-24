<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('progress', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('stage_id');
        $table->integer('completion_status');
        $table->integer('score');
        $table->timestamp('completed_at')->nullable();
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users');
        $table->foreign('stage_id')->references('id')->on('stages');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};

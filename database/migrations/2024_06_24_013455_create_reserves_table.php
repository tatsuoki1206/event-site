<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reserves', function (Blueprint $table) {
            $table->id();
            $table->string('event_name', 100);
            $table->integer('num')->unsigned();
            $table->string('last_name', 30);
            $table->string('first_name', 30);
            $table->string('last_name_kana', 30);
            $table->string('first_name_kana', 30);
            $table->string('tel', 20);
            $table->string('tel1', 10);
            $table->string('tel2', 10);
            $table->string('tel3', 10);
            $table->string('email', 255);
            $table->string('message', 300);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserves');
    }
};

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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('event_name', 100);
            $table->integer('num')->unsigned();
            $table->string('last_name', 50);
            $table->string('first_name', 50);
            $table->string('last_name_kana', 50);
            $table->string('first_name_kana', 50);
            $table->integer('tel')->unsigned();
            $table->string('email')->unique();
            $table->string('message', 300);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};

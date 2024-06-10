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
        Schema::create('permutations_answers', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('question_id')->unsigned()->references('id')->on('permutations')->nullable();
            $table->integer('user_id')->unsigned()->references('id')->on('candidates')->nullable();
            $table->string('word')->nullable();
            $table->string('balance_letters')->nullable();
            $table->integer('points')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permutations_answers');
    }
};

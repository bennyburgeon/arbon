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
        Schema::create('permutations', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('word')->nullable();
            $table->integer('status')->default(1);
            $table->integer('created_by')->unsigned()->references('id')->on('users')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permutations');
    }
};

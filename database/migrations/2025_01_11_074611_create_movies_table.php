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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('db_movie_id');
            $table->string('original_title');
            $table->longText('overview');
            $table->double('popularity');
            $table->string('poster_path');
            $table->string('release_date');
            $table->string('original_language');
            $table->string('type');
            $table->boolean('adult')->nullable();
            $table->string('backdrop_path')->default('');
            $table->timestamps();
        });



        // Schema::create('movie_type', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('movie_id')->constrained()->cascadeOnDelete();
        //     $table->foreignId('type_id')->constrained()->cascadeOnDelete();
        //     $table->timestamps();
        // });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category');
            $table->text('excerpt')->nullable();
            $table->longText('content');

            $table->string('image')->nullable();
            $table->string('author')->nullable();

            $table->boolean('status')->default(1);
            $table->unsignedInteger('views')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
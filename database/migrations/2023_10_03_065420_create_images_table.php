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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Original image file name
            $table->string('path'); // Path to the image file
            $table->string('alt_text')->nullable(); // Alt text for accessibility
            $table->unsignedBigInteger('content_id')->nullable(); // Foreign key to associate with content (posts)
            $table->timestamps();

           // Update the foreign key constraint to reference posts_id in posts table
        $table->foreign('content_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};

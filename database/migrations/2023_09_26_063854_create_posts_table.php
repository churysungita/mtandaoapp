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
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Auto-incremental primary key
            $table->string('title'); // Post title
            $table->text('content'); // Post content
            $table->enum('status', ['draft', 'published'])->default('draft'); // Post status
            $table->unsignedBigInteger('darasa_id'); // Class level (foreign key)
            $table->unsignedBigInteger('subject_id'); // Subject (foreign key)
            $table->unsignedBigInteger('topic_id'); // Topic (foreign key)
            $table->unsignedBigInteger('subtopic_id'); // Subtopic (foreign key)
            $table->timestamps(); // Created at and updated at timestamps

            // Define foreign key constraints
            $table->foreign('darasa_id')->references('id')->on('darasa')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
            $table->foreign('subtopic_id')->references('id')->on('subtopics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

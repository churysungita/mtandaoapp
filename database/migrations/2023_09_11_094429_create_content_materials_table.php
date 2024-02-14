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
        Schema::create('content_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('darasa_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('topic_id');
            $table->unsignedBigInteger('subtopic_id');
            $table->string('file_path'); // Store the path to the uploaded file
            $table->timestamps();

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
        Schema::dropIfExists('content_materials');
    }
};

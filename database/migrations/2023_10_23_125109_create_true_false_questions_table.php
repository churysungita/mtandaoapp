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
        Schema::create('true_false_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('subject_id');
            $table->unsignedInteger('topic_id');
            $table->unsignedInteger('subtopic_id');
            $table->string('question_text');
            $table->integer('marks');
            $table->enum('correct_answer', ['true', 'false']);
            $table->timestamps();


            
            // Define foreign key constraints
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
        Schema::dropIfExists('true_false_questions');
    }
};

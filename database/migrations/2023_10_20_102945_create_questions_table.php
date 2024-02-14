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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('topic_id');
            $table->unsignedBigInteger('subtopic_id');
            $table->string('type');
            $table->text('question_text');
            $table->json('answers');
            $table->integer('marks');
            $table->timestamps();

            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('topic_id')->references('id')->on('topics');
            $table->foreign('subtopic_id')->references('id')->on('subtopics');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};

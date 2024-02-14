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
        Schema::create('subtopics', function (Blueprint $table) {
            $table->id();
            $table->string('subtopic_name');
            $table->unsignedBigInteger('topic_id');
            $table->unsignedBigInteger('subject_id'); // Use subject_id as the foreign key
            $table->timestamps();
    
            // Define a foreign key constraint to link this subtopic to a topic
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
    
            // Define a foreign key constraint to reference the id column in the subjects table
            $table->foreign('subject_id')->references('id')->on('subjects');
        });
    }
    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subtopics');
    }
};

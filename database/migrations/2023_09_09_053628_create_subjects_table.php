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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('subject_name');
            $table->unsignedBigInteger('class_name_id'); // Add the foreign key column
            $table->timestamps();
    
            // Define a foreign key constraint to link this subject to a class
            $table->foreign('class_name_id')->references('id')->on('darasa');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
     
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropForeign(['class_name_id']);
        });
    
        Schema::dropIfExists('subjects');
    }
};

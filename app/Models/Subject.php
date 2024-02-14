<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['subject_name','class_name_id'];

    /**
     * Get the class level associated with this subject.
     */
    public function classLevel()
    {
        return $this->belongsTo(ClassLevel::class, 'class_name_id');// Assuming ClassLevel is the model for the 'darasa' schema
    }

    /**
     * Get the topics associated with this subject.
     */
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}

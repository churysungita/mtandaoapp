<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = ['topic_name', 'subject_id'];

    /**
     * Get the subject associated with this topic.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Get the subtopics associated with this topic.
     */
    public function subtopics()
    {
        return $this->hasMany(Subtopic::class);
    }
}

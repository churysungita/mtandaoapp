<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LongQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject_id',
        'topic_id',
        'subtopic_id',
        'question_text',
        'correct_answer',
        'marks',
    ];

  

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function subtopic()
    {
        return $this->belongsTo(Subtopic::class, 'subtopic_id');
    }
}

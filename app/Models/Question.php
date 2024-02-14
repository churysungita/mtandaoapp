<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject_id',
        'topic_id',
        'subtopic_id',
        'type',
        'question_text',
        'answers',
        'marks',
    ];

    public function subject()
    {
        return $this->belongTo(Subject::class,'subject_id');
    }

    public function topic()
    {
        return $this->belongTo(Topic::class,'topic_id');
    }

    public function subtopic()
    {
        return $this->belongTo(Subtopic::class,'subtopic_id');
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_questions')->withPivot('marks');
    }
}

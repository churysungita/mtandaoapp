<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultipleChoiceQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'topic_id',
        'subtopic_id',
        'question_text',
        'marks',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'option_e',
        'correct_answer',
    ];

    // Define relationships if needed, for example:
    
    // A multiple-choice question belongs to a subject
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    // A multiple-choice question belongs to a topic
    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    // A multiple-choice question belongs to a subtopic
    public function subtopic()
    {
        return $this->belongsTo(Subtopic::class, 'subtopic_id');
    }
    
    public function getTopics(Request $request)
    {
        $subjectId = $request->input('subject_id');
        $topics = Topic::where('subject_id', $subjectId)->pluck('topic_name', 'id');
        return response()->json($topics);
    }

    public function getSubtopics(Request $request)
{
    $topicId = $request->input('topic_id');
    $subtopics = Subtopic::where('topic_id', $topicId)->pluck('subtopic_name', 'id');
    return response()->json($subtopics);
}

}

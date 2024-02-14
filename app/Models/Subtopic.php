<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtopic extends Model
{
    use HasFactory;

    protected $fillable = ['subtopic_name', 'topic_id','subject_id'];

    /**
     * Get the topic associated with this subtopic.
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
    /**
    * Get the subject associated with this subtopic.
    */
    // added column to subtopics table from table subjects
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }


    /**
     * Get the content materials associated with this subtopic.
     */
    public function contentMaterials()
    {
        return $this->hasMany(ContentMaterial::class);
    }
}

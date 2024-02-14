<?php

// app/Models/ContentMaterial.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'darasa_id',
        'subject_id',
        'topic_id',
        'subtopic_id',
        'file_path',
    ];

    /**
     * Get the class associated with this content material.
     */
    public function darasa()
    {
        return $this->belongsTo(ClassLevel::class, 'darasa_id');
    }

    /**
     * Get the subject associated with this content material.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    /**
     * Get the topic associated with this content material.
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    /**
     * Get the subtopic associated with this content material.
     */
    public function subtopic()
    {
        return $this->belongsTo(Subtopic::class, 'subtopic_id');
    }
}

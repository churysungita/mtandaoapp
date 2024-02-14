<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'status', 'darasa_id', 'subject_id', 'topic_id', 'subtopic_id'];

    /**
     * Define the relationship between a post and the class level (darasa).
     */
    public function darasa()
    {
        return $this->belongsTo(ClassLevel::class, 'darasa_id');
    }

    /**
     * Define the relationship between a post and the subject.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    /**
     * Define the relationship between a post and the topic.
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    /**
     * Define the relationship between a post and the subtopic.
     */
    public function subtopic()
    {
        return $this->belongsTo(Subtopic::class, 'subtopic_id');
    }

       /**
     * Define the slug options for the post.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title') // Use the 'title' column to generate the slug
            ->saveSlugsTo('slug'); // Save the slug in the 'slug' column
    }
}

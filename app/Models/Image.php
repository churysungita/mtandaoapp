<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    
    protected $table = 'images';

    protected $fillable = ['name', 'path', 'alt_text', 'content_id']; // Add 'content_id' if it's necessary

    protected $uploadsDirectory = 'uploads/'; // Set the uploads directory

    public function post()
    {
        return $this->belongsTo(Post::class, 'content_id');
    }

    // Define a getter for the full image path
    public function getFullPathAttribute()
    {
        return asset('storage/' . $this->path);
    }

    // Define a getter for the public image URL
    public function getPublicImageUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }
}

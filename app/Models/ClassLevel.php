<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassLevel extends Model
{
    use HasFactory;
    protected $table = 'darasa'; // Specify the correct table name

    protected $fillable = ['class_name'];

    /**
     * Get the class associated with this class level.
     */
    // public function classes()
    // {
    //     return $this->belongsTo(ClassLevel::class);
    // }
}

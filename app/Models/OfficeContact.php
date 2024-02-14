<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeContact extends Model
{
    use HasFactory;
    protected $table = 'office_contacts';

    protected $fillable = [
        'address',
        'location',
        'email',
        'phone',
    ];
}

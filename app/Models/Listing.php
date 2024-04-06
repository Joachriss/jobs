<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'role',
        'job_type',
        'address',
        'salary',
        'application_close_date',
        'user_id',
        'feature_image',
        'slug',
    ];
}

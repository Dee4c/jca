<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemiFinalScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_number',
        'beauty_of_face',
        'poise_grace_projection',
        'composure',
        'total',
        'rank',
        'judge_name',
    ];
}

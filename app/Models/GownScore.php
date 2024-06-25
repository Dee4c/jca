<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GownScore extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_number', 'suitability', 'poise_grace_projection', 'total', 'rank', 'judge_name',
    ];
}

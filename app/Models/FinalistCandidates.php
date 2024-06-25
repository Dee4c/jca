<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalistCandidates extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_number',
        'candidate_name',
        'overall_rank',
    ];
}


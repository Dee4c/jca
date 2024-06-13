<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreInterviewScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_number', 'total', 'rank', 'judge_name',
    ];
}

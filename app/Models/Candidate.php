<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'candidateName',
        'candidateNumber',
        'age',
        'candidateAddress',
        'candidateStatistics',
        'preInterviewRank', // Add property for pre-interview rank
        'swimSuitRank', // Add property for swim suit rank
        'gownRank', // Add property for gown rank
        'semiFinalRank'
    ];

}

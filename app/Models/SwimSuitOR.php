<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwimSuitOR extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_number', 'overall_rank',
    ];
}

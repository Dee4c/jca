<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Set the table name dynamically based on category.
     *
     * @param string $category
     * @return void
     */
    public function setCategory($category)
    {
        switch ($category) {
            case 'pre_interview':
                $this->setTable('pre_interview_scores');
                break;
            case 'swim_suit':
                $this->setTable('swim_suit_scores');
                break;
            default:
                $this->setTable('default_scores');
                break;
        }
    }
}

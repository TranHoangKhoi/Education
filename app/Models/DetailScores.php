<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailScores extends Model
{
    use HasFactory;
    protected $table = 'detail_scores';

    protected $fillable = [
        'id_score', 'id_case_score', 'score', 'note', 'percent'
    ];

    public function caseScore()
    {
        return $this->hasOne(CaseScore::class, 'id', 'id_case_score');
    }
}

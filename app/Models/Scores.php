<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scores extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_subject', 'id_student', 'toltal'
    ];

    public function subject()
    {
        return $this->hasOne(Subject::class, 'id', 'id_subject');
    }

    public function detailsScore()
    {
        return $this->hasMany(DetailScores::class, 'id_score');
    }
    public function students()
    {
        return $this->hasOne(Students::class, 'id', 'id_student');
    }
}

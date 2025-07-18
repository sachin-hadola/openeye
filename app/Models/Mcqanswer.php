<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcqanswer extends Model
{
    use HasFactory;

    protected $table = 'mcq_answers';
    protected $fillable = ['question_id', 'answer'];


    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}

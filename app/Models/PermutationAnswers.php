<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermutationAnswers extends Model
{
    use HasFactory;
    protected $table = 'permutations_answers';
    protected $fillable = [
      'question_id',
      'user_id',
      'word',
      'balance_letters',
      'points'
    ];
}

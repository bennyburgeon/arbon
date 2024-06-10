<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permutation extends Model
{
    use HasFactory;
    protected $table = 'permutations';
    protected $fillable = [
      'word',
      'created_by',
    ];
    public function answers()
    {
        return $this->hasMany(PermutationAnswers::class,'question_id','id');
    }
    


}

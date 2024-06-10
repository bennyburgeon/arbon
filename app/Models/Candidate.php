<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Candidate extends Authenticatable
{
    use HasFactory;
    
    protected $table = 'candidates';
    protected $fillable = [
      'name',
      'email',
      'phone',
      'experience',
      'password',
      'notice_period',
      'resume',
      'photo',
      'created_by',
    ];
    
 

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    // Add the fields that are mass assignable
    protected $fillable = ['username', 'score'];
}


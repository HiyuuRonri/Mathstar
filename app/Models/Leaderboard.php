<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * By default, Laravel assumes the table name is the plural form of the model name. 
     * If you are using a non-standard table name like `leaderboard` instead of `leaderboards`, specify it here.
     */
    protected $table = 'leaderboard';

    /**
     * The attributes that are mass assignable.
     *
     * List the attributes that you want to allow for mass assignment.
     */
    protected $fillable = [
        'username',
        'score',
    ];
}

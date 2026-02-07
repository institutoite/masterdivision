<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLevelProgress extends Model
{
    protected $fillable = [
        'user_id',
        'unlocked_level_id',
    ];
}

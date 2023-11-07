<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $fillable = ['user_id', 'completion_status', 'score'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


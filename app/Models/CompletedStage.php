<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletedStage extends Model
{
    protected $fillable = ['user_id', 'stage_id', 'completed_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}


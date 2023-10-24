<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $fillable = ['name', 'unlock_condition'];

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

    public function projects()
    {
        return $this->belongsToMany(Project::class)->withTimestamps();
    }
}

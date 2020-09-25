<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('is_creator')->withTimestamps();
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class)->withPivot('is_creator')->withTimestamps();
    }
}

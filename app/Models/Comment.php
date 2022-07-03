<?php

namespace App\Models;

use App\Traits\ClassInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, ClassInfo;

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function blog()
    {
        return $this->morphOne(Blog::class, 'blogable');
    }
}

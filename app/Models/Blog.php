<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['*'];

    const CONTENT_BLOG = 'content';
    const VIDEO_BLOG = 'video';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function signedUsers()
    {
        return $this->belongsToMany(User::class);
    }

    public function comments() 
    {
        return $this->hasMany(Comment::class);
    }

    public function blogable() 
    {
        return $this->morphTo();
    }

    public function defaultImage()
    {
        return $this->morphOne(Media::class, 'mediable')
                    ->where('default_media', true);
    }

    public function video()
    {
        return $this->morphOne(Media::class, 'mediable')
                        ->where('default_media', false);
    }
}

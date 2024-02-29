<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'body',
        'user_id',
        'slug',
        'created_by',
        'files',
    ];

    public function attachments(): hasMany
    {
        return $this->hasMany(PostAttachment::class);
    }

    public function reactions(): hasMany
    {
        return $this->hasMany(PostReaction::class);
    }

    public function comments(): hasMany
    {
        return $this->hasMany(PostComment::class);
    }


}

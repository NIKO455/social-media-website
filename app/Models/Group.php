<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'group_cover', 'group_profile', 'auto_approval', 'created_by', 'updated_by'];

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

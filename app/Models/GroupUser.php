<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'role', 'token', 'token_expire_date', 'token_used', 'user_id', 'group_id', 'created_by'];

}

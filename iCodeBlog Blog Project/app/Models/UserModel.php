<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = "users";
    protected $primaryKey = "user_id";
    protected $fillable = [
        'google_id',
    ];
}

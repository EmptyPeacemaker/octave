<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['auth','text','spectacle_id'];

    public const CREATED_AT = 'create';
    public const UPDATED_AT = null;
}

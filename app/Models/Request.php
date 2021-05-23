<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $fillable = ['phone','type','fio'];

    public const CREATED_AT = 'create';
    public const UPDATED_AT = null;
}

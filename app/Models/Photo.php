<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = ['url','user_id'];

    public const CREATED_AT = 'create';
    public const UPDATED_AT = null;

    public function scopeTakeRandom($query, $size=1)
    {
        return $query->orderBy(DB::raw('RAND()'))->take($size);
    }
}

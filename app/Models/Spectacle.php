<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Spectacle extends Model
{
    use HasFactory;
    protected $fillable = ['url','title','description','text'];

    public function scopeTakeRandom($query, $size=1)
    {
        return $query->orderBy(DB::raw('RAND()'))->take($size);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'spectacle_id','id');
    }
}

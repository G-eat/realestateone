<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Photo;
use App\User;

class Article extends Model
{
    protected $guarded = ['id'];

    public function photo()
    {
        return $this->hasMany(Photo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

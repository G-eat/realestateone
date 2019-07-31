<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Photo;

class Article extends Model
{
    public function photo()
    {
        return $this->hasMany(Photo::class);
    }
}

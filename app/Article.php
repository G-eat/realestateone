<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Photo;

class Article extends Model
{
    protected $guarded = ['id'];

    public function photo()
    {
        return $this->hasMany(Photo::class);
    }
}

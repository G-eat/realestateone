<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Article;

class Photo extends Model
{
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}

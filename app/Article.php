<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Photo;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     *
     * protected $fillable = [
     *  'name', 'email', 'password',
     * ];
     */

    protected $guarded = ['id'];

    public function photo()
    {
        return $this->hasMany(Photo::class);
    }
}

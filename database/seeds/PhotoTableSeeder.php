<?php

use Illuminate\Database\Seeder;
use App\Photo;

class PhotoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Photo::class, 100)->create();
    }
}

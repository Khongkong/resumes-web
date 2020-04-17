<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\User::class, 10)->create();
        factory(App\Resume::class, 20)->create();
        
        $tags = App\Tag::all();
        App\Resume::all()->each(function ($resume) use ($tags) { 
            $resume->tags()->attach(
                $tags->random(rand(1, 10))->pluck('id')->toArray()
            ); 
        });
    }
}

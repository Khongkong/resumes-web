<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TagSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(AdminSeeder::class);
        // $this->call(SuperAdminSeeder::class);
        // $this->call(ResumeSeeder::class);
        $tags = App\Tag::all();
        App\Resume::all()->each(function ($resume) use ($tags) { 
            $resume->tags()->attach(
                $tags->random(rand(1, 10))->pluck('id')->toArray()
            ); 
        });
    }
}

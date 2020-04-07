<?php

use Illuminate\Database\Seeder;
use App\Resume;

class ResumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Resume::class, 10)->create();
        
    }
}

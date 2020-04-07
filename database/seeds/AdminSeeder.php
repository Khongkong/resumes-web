<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;
use App\Enums\UserType;
use Illuminate\Support\Str;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = new Faker;
        $user = new User;
        $user->name = $faker->name;
        $user->email = $faker->unique()->safeEmail;
        $user->email_verified_at = now();
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $user->remember_token = Str::random(10);
        $user->authority = UserType::Admin;
        $user->save();
    }
}

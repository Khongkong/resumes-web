<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            ['name' => '音樂', 'created_at' => now(), 'updated_at', now()],
            ['name' => '教育', 'created_at' => now(), 'updated_at', now()],
            ['name' => '金融', 'created_at' => now(), 'updated_at', now()],
            ['name' => '證券', 'created_at' => now(), 'updated_at', now()],
            ['name' => '前端', 'created_at' => now(), 'updated_at', now()],
            ['name' => '後端', 'created_at' => now(), 'updated_at', now()],
            ['name' => 'UI/UX', 'created_at' => now(), 'updated_at', now()],
            ['name' => '農林漁牧', 'created_at' => now(), 'updated_at', now()],
            ['name' => '建築', 'created_at' => now(), 'updated_at', now()],
            ['name' => '博弈', 'created_at' => now(), 'updated_at', now()]
        ];
        Tag::insert($records);
    }
}

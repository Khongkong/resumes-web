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
            ['name' => '音樂'],
            ['name' => '教育'],
            ['name' => '金融'],
            ['name' => '證券'],
            ['name' => '前端'],
            ['name' => '後端'],
            ['name' => 'UI/UX'],
            ['name' => '農林漁牧'],
            ['name' => '建築'],
            ['name' => '博弈']
        ];
        Tag::insert($records);
    }
}

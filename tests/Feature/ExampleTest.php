<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
    
    public function testStatus200TagIndex()
    {
        Artisan::call('migrate');
        Artisan::call('db:seed');
        $response = $this->get('/tag');
        $response->assertStatus(200);
    }
}

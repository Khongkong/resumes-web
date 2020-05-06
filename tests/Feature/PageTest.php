<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use App\User;
use App\Resume;
use App\Tag;
use Illuminate\Support\Facades\Auth;

class PageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLandingPage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSeeText('履歷們');
        $response->assertSeeText('所有履歷');
    }

    public function testLandingPageWithAFakeUserLoggedIn()
    {
        $user = new User([
            'id' => 1,
            'name' => 'Harbor'
        ]);
        $this->be($user);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSeeText('你的履歷');
    }

    public function testResumePageWhenNoResume()
    {
        $response = $this->get('/resume');
        $response->assertStatus(200);
        $response->assertSeeText('所有履歷');
        $response->assertSeeText('目前沒有任何履歷');
    }

    public function testResumePageWhen1Resume()
    {
        // Arrange
        factory(User::class, 1)->create();
        factory(Resume::class, 2)->create();
        // Act
        $response = $this->get('/resume');
        // Assert
        $response->assertStatus(200);
        $response->assertSeeText('所有履歷');
        $response->assertSeeText('新增時間');
    }
    public function testTagPageWorking()
    {
        // Act
        $response = $this->get('/alltag');
        // Assert
        $response->assertStatus(200);
        $response->assertSeeText('標籤');
    }

    public function testAccessHomePageWithAFakeUser()
    {
        factory(User::class)->create();

        Auth::login(User::first(), true);

        $response = $this->get('/home');
        $response->assertStatus(200);
        $response->assertSeeText('你的履歷');
    }
}

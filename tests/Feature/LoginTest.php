<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        $this->post('/api/register',['name'=>'test','email'=>'test@test.com','password'=>'testpassword']);

    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_login()
    {
        $response = $this->post('/api/login',['email'=>'test@test.com','password'=>'testpassword']);

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RefreshTokenTest extends TestCase
{
    use RefreshDatabase;
    private $authToken;
    protected function setUp(): void
    {
        parent::setUp();
        $response = $this->post('/api/register',['name'=>'test','email'=>'test@test.com','password'=>'testpassword']);
        $json = json_decode($response->getContent());
        $this->authToken = $json->data->authorisation->token;
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_refresh_aut_token()
    {
        $response = $this->post('/api/refresh',[],['Authorization'=>'Bearer '.$this->authToken]);

        $response->assertStatus(200);
    }
}

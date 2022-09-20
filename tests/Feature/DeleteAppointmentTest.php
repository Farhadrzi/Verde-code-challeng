<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteAppointmentTest extends TestCase
{
    use RefreshDatabase;
    private $authToken;
    protected function setUp(): void
    {
        parent::setUp();
        $response = $this->post('/api/register',['name'=>'test','email'=>'test@test.com','password'=>'testpassword']);
        $json = json_decode($response->getContent());
        $this->authToken = $json->data->authorisation->token;

        $this->post('/api/appointment/create',["address"=>"CM29XW","date"=>"2022-09-21 20:25:30",
                "contact"=>["name"=>"test3","surname"=>"test3","email"=>"test3@test.com","address"=>"CM29XQ","phone"=>"09037846449"]]
            ,['Authorization'=>'Bearer '.$this->authToken]);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_appointment()
    {
        $response = $this->delete('/api/appointment/delete?appointmentId=1',[],['Authorization'=>'Bearer '.$this->authToken]);

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_open_login_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_can_register()
    {
        //buka halaman register
        $response = $this->get('/');
        //post ke endpoint register
        $response = $this->followingRedirects()->post('/register', [
            'email' => 'putraprima@gmail.com',
            'name' => 'Prima Test',
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ]);
        //redirect to home
        $response->assertStatus(200);
    }

    public function test_user_must_fill_valid_email_address()
    {
        //buka halaman register
        $response = $this->get('/');
        //post ke endpoint register
        $response = $this->followingRedirects()->post('/register', [
            'email' => '',
            'name' => 'Prima Test',
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ]);
        //redirect to home
        $response->assertSeeText("The email field is required.");
    }
}

<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        //buka halaman awal
        $response = $this->get('/');
        //pastikan ada tulisan login
        $response->assertSeeText('Login');
        $response->assertSeeText('E-mail');
        $response->assertSeeText('Password');
        //pastikan halaman bisa dibuka
        $response->assertStatus(200);
    }
}

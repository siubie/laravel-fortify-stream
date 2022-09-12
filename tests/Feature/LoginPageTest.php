<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginPageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_page_shown_correctly()
    {
        //setup
        //do something
        $response = $this->get('/');
        //assert
        $response->assertStatus(200);
        $response->assertSeeText("E-mail");
        $response->assertSee('placeholder="Masukkan Alamat Email"', false);
    }
}

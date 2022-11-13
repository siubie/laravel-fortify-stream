<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginPageTest extends TestCase
{
    /** @test */
    public function login_page_shown_correctly()
    {
        //setup
        //do something
        $response = $this->get('/');
        //assert
        $response->assertStatus(200);
        $response->assertSeeText("E-mail");
        $response->assertSee('placeholder="Masukkan Alamat Email"', false);
    }

    /** @test */
    public function running_test()
    {
        $this->assertTrue(true);
    }
}

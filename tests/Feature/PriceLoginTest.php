<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PriceLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_unauthenticated_user_cannot_see_price_table()
    {
        //buka halaman price
        $response = $this->get('/price');
        $response->assertStatus(302);
    }

    public function test_authenticated_user_can_see_price_table()
    {
        //bikin user
        $user = User::factory()->create();
        //login dengan username dan password
        //buka halaman price
        $response = $this->actingAs($user)
            ->get('/price');
        //pastikan ada tulisan Tabel Harga Emas
        $response->assertSeeText("Tabel Harga Emas");
        $response->assertStatus(200);
    }
}

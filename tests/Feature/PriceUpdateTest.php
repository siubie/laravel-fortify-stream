<?php

namespace Tests\Feature;

use App\Models\Price;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PriceUpdateTest extends TestCase
{
    use RefreshDatabase;
    private $user;
    private $price;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser();
        $this->price = Price::create([
            'buy' => 900000,
            'sell' => 930000,
            'date' => date('Y-m-d'),
        ]);
    }

    private function createUser()
    {
        return User::factory()->create();
    }

    public function test_buy_is_required()
    {
        //buka halaman /price/create
        $response = $this->actingAs($this->user)->patch('/price/' . $this->price->id, [
            'sell' => '900000',
            'buy' => '',
            'date' => date('Y-m-d'),
        ]);
        //pastikan halamannya bisa dibuka
        $response->assertStatus(302);

        $response->assertInvalid([
            'buy' => 'The buy field is required.',
        ]);
    }

    public function test_sell_is_required()
    {
        //buka halaman /price/create
        $response = $this->actingAs($this->user)->patch('/price/' . $this->price->id, [
            'sell' => '',
            'buy' => '900000',
            'date' => date('Y-m-d'),
        ]);
        //pastikan halamannya bisa dibuka
        $response->assertStatus(302);

        $response->assertInvalid([
            'sell' => 'The sell field is required.',
        ]);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Price;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PriceUpdateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    //buy
    public function test_buy_is_required()
    {
        //buka halaman /price/create
        $price = Price::create([
            'buy' => 900000,
            'sell' => 930000,
            'date' => date('Y-m-d'),
        ]);
        $response = $this->patch('/price/' . $price->id, [
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

        $price = Price::create([
            'buy' => 900000,
            'sell' => 930000,
            'date' => date('Y-m-d'),
        ]);

        $response = $this->patch('/price/' . $price->id, [
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

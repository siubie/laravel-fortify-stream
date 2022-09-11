<?php

namespace Tests\Feature;

use App\Models\Price;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PriceDeleteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_price_by_id()
    {
        //setup
        $price = Price::create([
            'buy' => 900000,
            'sell' => 930000,
            'date' => date('Y-m-d'),
        ]);
        //do something
        $this->followingRedirects()->delete($price->id);
        //assert
        $this->assertDatabaseMissing('prices', $price->toArray());
    }
}

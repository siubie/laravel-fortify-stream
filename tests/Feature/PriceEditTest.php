<?php

namespace Tests\Feature;

use App\Models\Price;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PriceEditTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_edit_data_shown_correctly()
    {
        //setup
        //isi satu data
        $price = Price::create([
            'buy' => 900000,
            'sell' => 930000,
            'date' => date('Y-m-d'),
        ]);
        //action
        $response = $this->get('/price/' . $price->id . '/edit');
        //assert
        $response->assertStatus(200);
        $response->assertSee('900000');
        $response->assertSee('930000');
        $response->assertSee(date('d-m-Y'));
    }

    public function test_edit_data_not_found()
    {
        //action
        $response = $this->get('/price/1/edit');
        //assert
        $response->assertStatus(404);
    }
}

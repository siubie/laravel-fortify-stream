<?php

namespace Tests\Feature;

use App\Models\Price;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PriceTest extends TestCase
{
    use RefreshDatabase;
    public const PRICEURL = '/price';
    public const NOCONTENT = 'Belum Ada Isinya';
    public const BUY = '900000';
    public const SELL = '930000';
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_list_price_has_no_data()
    {
        //user buka halaman list price
        $response = $this->get(PriceTest::PRICEURL);
        //pastikan halamannya bisa dibuka
        $response->assertStatus(200);
        //cek header table
        $response->assertSeeText("Harga Jual");
        $response->assertSeeText("Harga Beli");
        $response->assertSeeText("Action");
        //cek tampil keterangan tabel masih kosong 
        $response->assertSeeText(PriceTest::NOCONTENT);
    }

    public function test_list_price_has_one_data()
    {
        //setup 
        // Isi dulu satu data
        Price::create([
            'buy' => PriceTest::BUY,
            'sell' => PriceTest::SELL,
            'date' => date('Y-m-d'),
        ]);
        //do something
        //user buka halaman list price
        $response = $this->get(PriceTest::PRICEURL);
        //pastikan halamannya bisa dibuka
        $response->assertStatus(200);
        //cek header table
        $response->assertSeeText("Harga Jual");
        $response->assertSeeText("Harga Beli");
        $response->assertSeeText("Tanggal");
        $response->assertSeeText("Action");
        //cek tampil keterangan tabel masih kosong 
        $response->assertSeeText("Rp 900.000,00");
        $response->assertSeeText("Rp 930.000,00");
        $response->assertSeeText("Delete");
    }

    public function test_create_price_test()
    {
        //buka halaman /price/create
        $response = $this->get('/price/create');
        //pastikan halamannya bisa dibuka
        $response->assertStatus(200);
        $response->assertSeeText("Manage Harga Emas");
        $response->assertSeeText("Create Harga Emas");
        //ada input buy tampil
        $response->assertSeeText("Masukkan Harga Beli");
        //ada input sell tampil
        $response->assertSeeText("Masukkan Harga Jual");
        //ada tombol submit
        $response->assertSeeText("Simpan");
    }

    public function test_buy_is_required()
    {
        //buka halaman /price/create
        $response = $this->post(PriceTest::PRICEURL, [
            'sell' => PriceTest::BUY,
            'buy' => '',
            'date' => date('Y-m-d'),
        ]);
        //pastikan halamannya bisa dibuka
        $response->assertStatus(302);
        $response->assertInvalid([
            'buy' => 'The buy field is required.',
        ]);
    }

    public function test_date_is_required()
    {
        //buka halaman /price/create
        $response = $this->post(PriceTest::PRICEURL, [
            'buy' => PriceTest::BUY,
            'sell' => PriceTest::SELL,
            'date' => '',
        ]);
        //pastikan halamannya bisa dibuka
        $response->assertStatus(302);
        $response->assertInvalid([
            'date' => 'The date field is required.',
        ]);
    }

    public function test_sell_is_required()
    {
        //buka halaman /price/create
        $response = $this->post(PriceTest::PRICEURL, [
            'buy' => PriceTest::BUY,
            'sell' => '',
            'date' => date('Y-m-d'),
        ]);
        //pastikan halamannya bisa dibuka
        $response->assertStatus(302);
        $response->assertInvalid([
            'sell' => 'The sell field is required.',
        ]);
    }

    public function test_date_is_valid()
    {
        //buka halaman /price/create
        $response = $this->post(PriceTest::PRICEURL, [
            'buy' => PriceTest::BUY,
            'sell' => PriceTest::SELL,
            'date' => 'asda',
        ]);
        //pastikan halamannya bisa dibuka
        $response->assertStatus(302);
        $response->assertInvalid([
            'date' => 'The date is not a valid date.',
        ]);
    }

    public function test_date_is_unique()
    {
        //buka halaman /price/create
        Price::create([
            'buy' => PriceTest::BUY,
            'sell' => PriceTest::SELL,
            'date' => date('Y-m-d'),
        ]);
        $response = $this->post(PriceTest::PRICEURL, [
            'buy' => PriceTest::BUY,
            'sell' => PriceTest::SELL,
            'date' => date('Y-m-d'),
        ]);
        //pastikan halamannya bisa dibuka
        $response->assertStatus(302);
        $response->assertInvalid([
            'date' => 'The date has already been taken.',
        ]);
    }

    public function test_sell_is_numeric()
    {
        //buka halaman /price/create
        $response = $this->post(PriceTest::PRICEURL, [
            'buy' => PriceTest::BUY,
            'sell' => 'abc',
            'date' => date('Y-m-d'),
        ]);
        //pastikan halamannya bisa dibuka
        $response->assertStatus(302);
        $response->assertInvalid([
            'sell' => 'The sell must be a number.',
        ]);
    }

    public function test_all_input_is_required()
    {
        //buka halaman /price/create
        $response = $this->post(PriceTest::PRICEURL, [
            'buy' => '',
            'sell' => '',
            'date' => '',
        ]);
        //pastikan halamannya bisa dibuka
        $response->assertStatus(302);
        $response->assertInvalid([
            'sell' => 'The sell field is required.',
            'buy' => 'The buy field is required.',
            'date' => 'The date field is required.',
        ]);
    }

    public function test_buy_numeric()
    {
        //buka halaman /price/create
        $response = $this->post(PriceTest::PRICEURL, [
            'buy' => 'abc',
            'sell' => PriceTest::SELL,
            'date' => date('Y-m-d'),
        ]);
        //pastikan halamannya bisa dibuka
        $response->assertStatus(302);
        $response->assertInvalid([
            'buy' => 'The buy must be a number.',
        ]);
    }

    public function test_buy_greater_zero()
    {
        //buka halaman /price/create
        $response = $this->post(PriceTest::PRICEURL, [
            'buy' => '0',
            'sell' => PriceTest::SELL,
            'date' => date('Y-m-d'),
        ]);
        //pastikan halamannya bisa dibuka
        $response->assertStatus(302);
        $response->assertInvalid([
            'buy' => 'The buy must be greater than 0.',
        ]);
    }

    public function test_sell_greater_zero()
    {
        //buka halaman /price/create
        $response = $this->post(PriceTest::PRICEURL, [
            'buy' => '90000',
            'sell' => '0',
            'date' => date('Y-m-d'),
        ]);
        //pastikan halamannya bisa dibuka
        $response->assertStatus(302);
        $response->assertInvalid([
            'sell' => 'The sell must be greater than 0.',
        ]);
    }
    public function test_pagination()
    {
        //setup
        $this->seed();

        //action
        $response = $this->get(PriceTest::PRICEURL);

        //assert
        $response->assertStatus(200);
        $response->assertDontSeeText(PriceTest::NOCONTENT);

        $response = $this->get('price?page=2');
        $response->assertStatus(200);
        $response->assertDontSeeText(PriceTest::NOCONTENT);

        $response = $this->get('price?page=3');
        $response->assertStatus(200);
        $response->assertSeeText(PriceTest::NOCONTENT);
    }
}

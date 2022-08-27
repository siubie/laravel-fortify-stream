<?php

namespace Tests\Feature;

use App\Models\Price;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PriceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_list_price_has_no_data()
    {
        //user buka halaman list price
        $response = $this->get('/price');
        //pastikan halamannya bisa dibuka
        $response->assertStatus(200);
        //cek header table
        $response->assertSeeText("Harga Jual");
        $response->assertSeeText("Harga Beli");
        $response->assertSeeText("Action");
        //cek tampil keterangan tabel masih kosong 
        $response->assertSeeText("Belum Ada Isinya");
    }

    public function test_list_price_has_one_data()
    {
        //setup 
        // Isi dulu satu data
        Price::create([
            'buy' => 900000,
            'sell' => 930000,
            'date' => date('Y-m-d'),
        ]);
        //do something
        //user buka halaman list price
        $response = $this->get('/price');
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
        $response = $this->post('/price', [
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

    public function test_date_is_required()
    {
        //buka halaman /price/create
        $response = $this->post('/price', [
            'buy' => '900000',
            'sell' => '80000',
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
        $response = $this->post('/price', [
            'buy' => '900000',
            'sell' => '',
            'date' => date('Y-m-d'),
        ]);
        //pastikan halamannya bisa dibuka
        $response->assertStatus(302);
        $response->assertInvalid([
            'sell' => 'The sell field is required.',
        ]);
    }

    public function test_buy_is_numeric()
    {
        //buka halaman /price/create
        $response = $this->post('/price', [
            'buy' => 'abc',
            'sell' => '90000',
            'date' => date('Y-m-d'),
        ]);
        //pastikan halamannya bisa dibuka
        $response->assertStatus(302);
        $response->assertInvalid([
            'buy' => 'The buy must be a number.',
        ]);
    }

    public function test_date_is_valid()
    {
        //buka halaman /price/create
        $response = $this->post('/price', [
            'buy' => '90000',
            'sell' => '90000',
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
            'buy' => '90000',
            'sell' => '90000',
            'date' => date('Y-m-d'),
        ]);
        $response = $this->post('/price', [
            'buy' => '90000',
            'sell' => '90000',
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
        $response = $this->post('/price', [
            'buy' => '90000',
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
        $response = $this->post('/price', [
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

    public function test_pagination()
    {
        //setup
        $this->seed();

        //action
        $response = $this->get('/price');

        //assert
        $response->assertStatus(200);
        $response->assertDontSeeText('Belum Ada Isinya');

        $response = $this->get('price?page=2');
        $response->assertStatus(200);
        $response->assertDontSeeText('Belum Ada Isinya');

        $response = $this->get('price?page=3');
        $response->assertStatus(200);
        $response->assertSeeText('Belum Ada Isinya');
    }
    // public function test_store_price_test()
    // {
    // }
}

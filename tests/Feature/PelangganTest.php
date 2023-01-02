<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Pelanggan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use DB;

class PelangganTest extends TestCase
{
    use DatabaseTransactions;

    public function test_create_data_masuk()
    {
        $countAwal = Pelanggan::count(); // Menghitung jumlah data awal
        $response = $this->postJson('/api/pelanggan', [
            "nama" => "Agung",
            "kelamin" => "L",
            "phone" => "087123456789",
            "alamat" => "Semarang"
        ]);
        $countAkhir = Pelanggan::count(); // Menghitung jumlah data akhir (setelah penambahan data)
        $this->assertTrue($countAkhir == $countAwal + 1);
    }

    public function test_create_valid_data()
    {
        $response = $this->postJson('/api/pelanggan', [
            "nama" => "Jono 567",
            "kelamin" => "L",
            "phone" => "087123456789",
            "alamat" => "Semarang"
        ]);

        $pelanggan = Pelanggan::find($response["id"]);
        $this->assertEquals("Jono 567", $pelanggan->nama);
    }
}

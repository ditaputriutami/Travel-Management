<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\KategoriTransport;
use App\Models\AkunAkuntansi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Kategori Transport
        KategoriTransport::create([
            'kode_kendaraan' => 'BUS001',
            'nomor_polisi' => 'B 1234 ABC',
            'jenis_kendaraan' => 'bus',
            'merk_tipe' => 'Mercedes Benz OH 1526',
            'tahun_kendaraan' => 2020,
            'kapasitas_penumpang' => 50,
            'status_kendaraan' => 'tersedia',
            'tarif_12_jam' => 1500000,
            'tarif_24_jam' => 2500000,
            'tarif_overtime_per_jam' => 150000,
            'deskripsi' => 'Bus besar untuk perjalanan jarak jauh dengan fasilitas lengkap',
        ]);

        KategoriTransport::create([
            'kode_kendaraan' => 'VAN001',
            'nomor_polisi' => 'B 5678 DEF',
            'jenis_kendaraan' => 'mobil',
            'merk_tipe' => 'Toyota Hiace',
            'tahun_kendaraan' => 2021,
            'kapasitas_penumpang' => 15,
            'status_kendaraan' => 'tersedia',
            'tarif_12_jam' => 700000,
            'tarif_24_jam' => 1200000,
            'tarif_overtime_per_jam' => 80000,
            'deskripsi' => 'Van medium untuk group kecil dan menengah',
        ]);

        KategoriTransport::create([
            'kode_kendaraan' => 'MPV001',
            'nomor_polisi' => 'B 9012 GHI',
            'jenis_kendaraan' => 'mobil',
            'merk_tipe' => 'Toyota Avanza',
            'tahun_kendaraan' => 2022,
            'kapasitas_penumpang' => 7,
            'status_kendaraan' => 'tersedia',
            'tarif_12_jam' => 300000,
            'tarif_24_jam' => 500000,
            'tarif_overtime_per_jam' => 50000,
            'deskripsi' => 'Mobil keluarga untuk rombongan kecil',
        ]);

        KategoriTransport::create([
            'kode_kendaraan' => 'ELF001',
            'nomor_polisi' => 'B 3456 JKL',
            'jenis_kendaraan' => 'bus',
            'merk_tipe' => 'Isuzu Elf',
            'tahun_kendaraan' => 2019,
            'kapasitas_penumpang' => 20,
            'status_kendaraan' => 'tersedia',
            'tarif_12_jam' => 900000,
            'tarif_24_jam' => 1500000,
            'tarif_overtime_per_jam' => 100000,
            'deskripsi' => 'Bus sedang untuk perjalanan menengah dan regional',
        ]);

        // Seed Akun Akuntansi
        $akunData = [
            // Aset
            ['kode' => '1001', 'nama' => 'Kas', 'jenis' => 'Aset', 'desc' => 'Uang tunai perusahaan'],
            ['kode' => '1002', 'nama' => 'Bank', 'jenis' => 'Aset', 'desc' => 'Saldo bank perusahaan'],
            ['kode' => '1010', 'nama' => 'Kendaraan', 'jenis' => 'Aset', 'desc' => 'Aset kendaraan transportasi'],

            // Utang
            ['kode' => '2001', 'nama' => 'Utang Bank', 'jenis' => 'Utang', 'desc' => 'Kewajiban kepada bank'],
            ['kode' => '2002', 'nama' => 'Utang Supplier', 'jenis' => 'Utang', 'desc' => 'Kewajiban kepada supplier'],

            // Modal
            ['kode' => '3001', 'nama' => 'Modal Disetor', 'jenis' => 'Modal', 'desc' => 'Modal yang disetor oleh pemilik'],
            ['kode' => '3002', 'nama' => 'Saldo Laba', 'jenis' => 'Modal', 'desc' => 'Akumulasi laba ditahan'],

            // Pendapatan
            ['kode' => '4001', 'nama' => 'Pendapatan Sewa Kendaraan', 'jenis' => 'Pendapatan', 'desc' => 'Pendapatan utama dari sewa kendaraan'],
            ['kode' => '4002', 'nama' => 'Pendapatan Lainnya', 'jenis' => 'Pendapatan', 'desc' => 'Pendapatan dari berbagai sumber lainnya'],

            // Beban
            ['kode' => '5001', 'nama' => 'Beban Gaji & Upah', 'jenis' => 'Beban', 'desc' => 'Gaji karyawan dan sopir'],
            ['kode' => '5002', 'nama' => 'Beban Bahan Bakar', 'jenis' => 'Beban', 'desc' => 'Biaya pembelian bahan bakar'],
            ['kode' => '5003', 'nama' => 'Beban Maintenance', 'jenis' => 'Beban', 'desc' => 'Biaya perawatan dan perbaikan kendaraan'],
            ['kode' => '5004', 'nama' => 'Beban Asuransi', 'jenis' => 'Beban', 'desc' => 'Premi asuransi kendaraan dan tanggung jawab'],
            ['kode' => '5005', 'nama' => 'Beban Pajak Kendaraan', 'jenis' => 'Beban', 'desc' => 'Pajak kendaraan bermotor'],
            ['kode' => '5006', 'nama' => 'Beban Sewa Kantor', 'jenis' => 'Beban', 'desc' => 'Biaya sewa tempat usaha'],
            ['kode' => '5007', 'nama' => 'Beban Listrik & Air', 'jenis' => 'Beban', 'desc' => 'Biaya utilitas kantor'],
            ['kode' => '5008', 'nama' => 'Beban Operasional Lainnya', 'jenis' => 'Beban', 'desc' => 'Beban operasional lainnya'],
        ];

        foreach ($akunData as $akun) {
            AkunAkuntansi::create([
                'kode_akun' => $akun['kode'],
                'nama_akun' => $akun['nama'],
                'jenis' => $akun['jenis'],
                'deskripsi' => $akun['desc'],
            ]);
        }

        // Create default users for testing
        User::create([
            'name' => 'Admin Kembang Lestari',
            'email' => 'admin@kembang-lestari.com',
            'password' => bcrypt('password123'),
        ]);

        User::create([
            'name' => 'Manager Travel',
            'email' => 'manager@kembang-lestari.com',
            'password' => bcrypt('password123'),
        ]);
    }
}

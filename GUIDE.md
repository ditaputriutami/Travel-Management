# 📚 Panduan Penggunaan Sistem Kembang Lestari Travel

## 🎯 Pengenalan Sistem

Sistem Informasi Akuntansi Kas untuk Kembang Lestari Travel adalah aplikasi web yang dirancang untuk mengelola operasional bisnis travel dan pelaporan keuangan secara terintegrasi.

## 🚀 Panduan Cepat Mulai

### 1️⃣ Pertama Kali Login

1. Buka `http://localhost:8000`
2. Klik **Register** atau gunakan akun default:
    - Email: `admin@kembang-lestari.com`
    - Password: `password123`

### 2️⃣ Setup Master Data (Langkah Pertama)

#### A. Buat Kategori Transport

1. Go to **Master Data → Kategori Transport**
2. Klik **Tambah Kategori**
3. Isi form:
    - Nama Kategori: _misal "Bus Pariwisata 50 seat"_
    - Kapasitas: _50_
    - Deskripsi: _Penjelasan singkat_

**Contoh Data:**

```
✓ Bus Pariwisata 50 seat (50 orang)
✓ Hiace 15 seat (15 orang)
✓ Avanza 7 seat (7 orang)
✓ Mobil Elf 20 seat (20 orang)
```

#### B. Setup Akun Akuntansi

1. Go to **Master Data → Akun Akuntansi**
2. Klik **Tambah Akun**
3. Sistem sudah memiliki template default. Tambahkan akun custom jika perlu.

**Struktur Akun yang Ada:**

```
ASET (Debet):
  1001 - Kas
  1002 - Bank
  1010 - Kendaraan

UTANG (Kredit):
  2001 - Utang Bank
  2002 - Utang Supplier

MODAL (Kredit):
  3001 - Modal Disetor
  3002 - Saldo Laba

PENDAPATAN (Kredit):
  4001 - Pendapatan Sewa Kendaraan
  4002 - Pendapatan Lainnya

BEBAN (Debet):
  5001 - Beban Gaji & Upah
  5002 - Beban Bahan Bakar
  5003 - Beban Maintenance
  5004 - Beban Asuransi
  5005 - Beban Pajak Kendaraan
  5006 - Beban Sewa Kantor
  5007 - Beban Listrik & Air
  5008 - Beban Operasional Lainnya
```

---

## 📋 Menggunakan Sistem

### 📊 Dashboard

-   **Statistik Ringkas**: Melihat overview bisnis
-   **Chart Pendapatan**: Trend pendapatan 6 bulan
-   **Chart Laba Rugi**: Perbandingan profit vs cost
-   **Tabel Latest Orders**: 5 order terbaru
-   **Tabel Latest Biaya**: 5 biaya operasional terbaru

**Tips**: Dashboard di-refresh setiap kali halaman dibuka. Update data akan langsung terlihat.

---

### 🚗 Menu Orders/Penyewaan

#### Membuat Order Baru

1. Go to **Transaksi → Orders/Penyewaan**
2. Klik **Buat Order**
3. Isi form:
    ```
    Nama Pelanggan: PT ABC Indonesia
    No Telepon: 081xxxxxxxxx
    Kategori Transport: Bus Pariwisata 50 seat
    Tanggal Sewa: 2025-12-20
    Tanggal Selesai: 2025-12-25
    Total Biaya: 5.000.000
    Uang Muka: 2.500.000
    Denda: 0 (opsional)
    Akun Pendapatan: 4001 - Pendapatan Sewa Kendaraan
    File Jaminan: [upload KTP atau STNK]
    Keterangan: Perjalanan Jakarta ke Bandung, 3 hari
    ```
4. Klik **Simpan**

**Automasi Sistem:**

-   ✅ Sistem akan membuat jurnal di **Transaksi Akuntansi** otomatis
-   ✅ Akun Pendapatan akan di-kredit dengan nilai Total Biaya
-   ✅ Status order default: **pending**

#### Mengubah Status Order

1. Edit order → ubah **Status** menjadi:

    - **pending**: Menunggu verifikasi
    - **aktif**: Order sedang berjalan
    - **selesai**: Order sudah selesai
    - **dibatalkan**: Order dibatalkan

2. Tambahkan **Denda** jika ada keterlambatan pengembalian

#### Menghitung Sisa Pembayaran

```
Sisa = (Total Biaya + Denda) - Uang Muka
```

Contoh:

```
Total Biaya: Rp 5.000.000
Denda: Rp 500.000
Uang Muka: Rp 2.500.000

Sisa Pembayaran = (5.000.000 + 500.000) - 2.500.000 = Rp 3.000.000
```

---

### 💰 Menu Biaya Operasional

#### Mencatat Biaya Operasional

1. Go to **Transaksi → Biaya Operasional**
2. Klik **Tambah Biaya**
3. Isi form:
    ```
    Nama Biaya: Biaya Gaji Sopir Bulan Desember
    Tanggal: 2025-12-05
    Nominal: 2.000.000
    Akun Beban: 5001 - Beban Gaji & Upah
    Keterangan: Gaji 2 sopir @ 1juta
    ```
4. Klik **Simpan**

**Tipe-Tipe Biaya Umum:**

```
✓ Gaji Karyawan → Akun 5001
✓ Pembelian Bahan Bakar → Akun 5002
✓ Service & Maintenance Kendaraan → Akun 5003
✓ Premi Asuransi → Akun 5004
✓ Pajak Kendaraan → Akun 5005
✓ Sewa Kantor/Garasi → Akun 5006
✓ Tagihan Listrik & Air → Akun 5007
✓ Pengeluaran Lain → Akun 5008
```

**Automasi Sistem:**

-   ✅ Sistem akan membuat jurnal di **Transaksi Akuntansi** otomatis
-   ✅ Akun Beban akan di-debet dengan nominal biaya

---

## 📊 Laporan Keuangan

### 1. Laporan Pendapatan

**Tujuan**: Melihat detail pendapatan dari setiap kategori penyewaan.

**Langkah:**

1. Go to **Laporan → Laporan Pendapatan**
2. Pilih **Bulan** dan **Tahun**
3. Klik **Filter**
4. Lihat detail pendapatan per akun

**Contoh Output:**

```
┌─ LAPORAN PENDAPATAN - Desember 2025 ─┐
│                                       │
│ Pendapatan Sewa Kendaraan  │ Rp 15M  │
│ Pendapatan Lainnya         │ Rp 2M   │
├───────────────────────────────────────┤
│ TOTAL PENDAPATAN           │ Rp 17M  │
└───────────────────────────────────────┘
```

### 2. Laporan Laba Rugi

**Tujuan**: Mengetahui profit/loss bisnis dalam periode tertentu.

**Langkah:**

1. Go to **Laporan → Laporan Laba Rugi**
2. Pilih **Bulan** dan **Tahun**
3. Lihat struktur:

**Format:**

```
PENDAPATAN
  ├ Pendapatan Sewa Kendaraan    Rp 15.000.000
  └ Pendapatan Lainnya           Rp 2.000.000
  = TOTAL PENDAPATAN             Rp 17.000.000

BEBAN
  ├ Beban Gaji & Upah            Rp 3.000.000
  ├ Beban Bahan Bakar            Rp 2.000.000
  ├ Beban Maintenance            Rp 1.500.000
  ├ Beban Asuransi               Rp 800.000
  └ Beban Lainnya                Rp 1.700.000
  = TOTAL BEBAN                  Rp 9.000.000

LABA/(RUGI) BERSIH               Rp 8.000.000 ✓
```

**Interpretasi:**

-   ✓ Positif = Keuntungan
-   ✗ Negatif = Kerugian

### 3. Neraca

**Tujuan**: Melihat posisi keuangan perusahaan (Aset, Utang, Modal).

**Langkah:**

1. Go to **Laporan → Neraca**
2. Lihat struktur:

**Format:**

```
AKTIVA (Kiri)           │  PASIVA (Kanan)
                        │
Aset Lancar:            │  Utang:
├ Kas         Rp 5M     │  ├ Utang Bank      Rp 2M
├ Bank        Rp 10M    │  └ Utang Supplier  Rp 1M
└ Kendaraan   Rp 20M    │  = Total Utang     Rp 3M
                        │
= Total Aset  Rp 35M    │  Modal:
                        │  ├ Modal Disetor   Rp 20M
                        │  ├ Saldo Laba      Rp 8M
                        │  └ Laba Tahun Ini  Rp 4M
                        │  = Total Modal     Rp 32M
                        │
                        │  = Total Pasiva    Rp 35M
```

**Prinsip:** Total Aset HARUS = Total Pasiva (Aktiva = Pasiva)

### 4. Laporan Perubahan Modal

**Tujuan**: Melihat bagaimana modal berubah sepanjang tahun.

**Format:**

```
Modal Awal Tahun                      Rp 20.000.000
+ Laba/(Rugi) Tahun 2025             Rp 8.000.000
─────────────────────────────────────
= Modal Akhir Tahun                   Rp 28.000.000
```

---

## 🔍 Tips & Trik

### Tips untuk Akuntansi Akurat

1. **Catatan Transaksi Tepat Waktu**

    - Catat order & biaya sama hari terjadinya
    - Jangan menumpuk pencatatan

2. **Gunakan Akun yang Tepat**

    - Pastikan memilih akun pendapatan untuk order
    - Pastikan memilih akun beban untuk biaya

3. **Validasi Reguler**

    - Setiap akhir bulan, cross-check order dengan pembayaran
    - Bandingkan saldo kas di sistem dengan kas fisik

4. **Backup Data**

    - Lakukan backup database secara rutin
    - Simpan di storage cloud atau eksternal

5. **Gunakan Fitur Cetak**
    - Laporan dapat dicetak langsung dari browser
    - Gunakan untuk dokumentasi & audit

---

## ⚠️ Troubleshooting

### Masalah: Laporan tidak sesuai

**Solusi:**

1. Verifikasi data Order & Biaya sudah tersimpan
2. Check filter Bulan/Tahun sudah benar
3. Pastikan akun sudah terpilih dengan benar

### Masalah: Tidak bisa upload file jaminan

**Solusi:**

1. Pastikan file size < 10MB
2. Format file: PDF, JPG, PNG
3. Folder storage harus writable (cek permission)

### Masalah: Neraca tidak balance

**Solusi:**

1. Cek semua order sudah di-input
2. Cek semua biaya sudah di-input
3. Verifikasi saldo awal akun di modal/aset

---

## 📞 Kontak & Support

Untuk pertanyaan teknis atau saran perbaikan, silakan hubungi admin sistem.

---

**Last Updated**: Desember 2025
**Version**: 1.0.0

# 🚌 Kembang Lestari Travel - Sistem Informasi Akuntansi Kas

Sistem Informasi Akuntansi Kas berbasis Laravel dengan Tailwind CSS untuk usaha jasa travel **Kembang Lestari Travel**.

## ✨ Fitur Utama

### 1. **Dashboard Modern**

-   📊 Statistik singkat (Total Kategori, Order, Pendapatan, Biaya)
-   📈 Chart.js untuk visualisasi data
-   📉 Grafik Laba Rugi 6 bulan terakhir
-   🥧 Pie chart Pendapatan vs Biaya
-   📋 Tabel ringkas Latest Orders & Biaya Operasional

### 2. **Master Data**

-   **Kategori Transport**: Kelola jenis transportasi (Bus, Hiace, Avanza, dll)
-   **Akun Akuntansi**: Setup akun untuk laporan keuangan (Aset, Utang, Modal, Pendapatan, Beban)

### 3. **Transaksi**

-   **Orders/Penyewaan**:

    -   CRUD transaksi penyewaan kendaraan
    -   Upload file jaminan (KTP, STNK, dll)
    -   Tracking status order
    -   Validasi form lengkap

-   **Biaya Operasional**:
    -   Pencatatan pengeluaran operasional
    -   Link ke akun beban
    -   Riwayat biaya lengkap

### 4. **Laporan Keuangan**

-   📄 **Laporan Pendapatan**: Detail pendapatan per akun
-   📊 **Laporan Laba Rugi**: Format standar akuntansi
-   📋 **Neraca**: Posisi keuangan (Aset, Utang, Modal)
-   📈 **Laporan Perubahan Modal**: Perubahan ekuitas tahunan
-   🖨️ Semua laporan dapat difilter dan dicetak

### 5. **Autentikasi & Keamanan**

-   Login/Register dengan Laravel Breeze
-   Middleware autentikasi
-   Session management

## 🛠️ Tech Stack

-   **Backend**: Laravel 11
-   **Frontend**: Tailwind CSS 4.x
-   **Database**: SQLite / MySQL
-   **Charts**: Chart.js
-   **Icons**: Heroicons (SVG)
-   **Package Manager**: Composer, NPM

## 📦 Installation

### Prerequisites

-   PHP 8.1+
-   Composer
-   Node.js & NPM
-   SQLite atau MySQL

### Setup Instructions

1. **Clone Repository dan Install Dependencies**

```bash
cd d:\TugasAkhir\TravelManajemen
composer install
npm install
```

2. **Setup Environment**

```bash
cp .env.example .env
php artisan key:generate
```

3. **Konfigurasi Database (di .env)**

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

# Atau untuk MySQL:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kembang_lestari_travel
DB_USERNAME=root
DB_PASSWORD=
```

4. **Jalankan Migrations**

```bash
php artisan migrate
```

5. **Build CSS & JS**

```bash
npm run build
# atau untuk development dengan watch:
npm run dev
```

6. **Seed Database (Optional - Initial Data)**

```bash
php artisan db:seed
```

7. **Jalankan Development Server**

```bash
php artisan serve
```

Buka browser: `http://localhost:8000`

## 📁 Struktur Folder

```
resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php          # Layout master
│   ├── components/
│   │   ├── sidebar.blade.php
│   │   └── navbar.blade.php
│   ├── dashboard.blade.php
│   ├── kategori-transport/        # CRUD Kategori
│   ├── akun-akuntansi/           # CRUD Akun Akuntansi
│   ├── orders/                    # CRUD Orders
│   ├── biaya-operasional/        # CRUD Biaya
│   └── laporan/                   # Laporan Keuangan
│
├── css/
│   └── app.css                    # Tailwind + Custom Classes
│
└── js/
    └── app.js

app/
├── Http/
│   └── Controllers/
│       ├── DashboardController.php
│       ├── KategoriTransportController.php
│       ├── AkunAkuntansiController.php
│       ├── OrderController.php
│       ├── BiayaOperasionalController.php
│       └── LaporanController.php
│
└── Models/
    ├── User.php
    ├── KategoriTransport.php
    ├── AkunAkuntansi.php
    ├── Order.php
    ├── BiayaOperasional.php
    └── TransaksiAkuntansi.php

database/
├── migrations/
│   ├── *_create_users_table.php
│   ├── *_create_kategori_transports_table.php
│   ├── *_create_akun_akuntansis_table.php
│   ├── *_create_orders_table.php
│   ├── *_create_biaya_operasionals_table.php
│   └── *_create_transaksi_akuntansis_table.php
│
└── seeders/
    └── DatabaseSeeder.php

routes/
├── web.php                        # Main routes
└── auth.php                       # Auth routes (Breeze)
```

## 🔄 Alur Sistem

### Alur Pendapatan

1. Admin membuat **Order** (Penyewaan) di menu Orders
2. System otomatis membuat entry di Transaksi Akuntansi dengan:
    - Akun Pendapatan (dari Order)
    - Tipe: Kredit
    - Nominal: Total Biaya Order
    - Referensi: Order ID

### Alur Biaya Operasional

1. Admin membuat **Biaya Operasional**
2. System otomatis membuat entry di Transaksi Akuntansi dengan:
    - Akun Beban (dari Biaya)
    - Tipe: Debet
    - Nominal: Nominal Biaya
    - Referensi: Biaya ID

### Laporan Otomatis

-   **Laporan Pendapatan**: Aggregasi dari Transaksi dengan Akun Pendapatan
-   **Laporan Laba Rugi**: Pendapatan - Beban
-   **Neraca**: Kalkulasi saldo per Akun berdasarkan Debet/Kredit
-   **Perubahan Modal**: Modal Awal + Laba/Rugi Tahun

## 🎨 Design & Styling

### Color Palette

-   **Primary**: Blue (#3b82f6)
-   **Success**: Green (#22c55e)
-   **Warning**: Orange (#f59e0b)
-   **Danger**: Red (#ef4444)
-   **Secondary**: Gray (various shades)

### Components

-   ✅ Tailwind CSS untuk semua styling
-   🎯 Responsive design (Mobile, Tablet, Desktop)
-   🎨 Modern, clean, dengan whitespace optimal
-   📦 Reusable components

## 📊 Dashboard Highlights

```
┌─────────────────────────────────────────────────┐
│  Total Kategori  │  Total Order  │  Pendapatan  │ Biaya
├─────────────────────────────────────────────────┤

│  [Pendapatan 6 Bulan Chart]  │  [Pie Chart]  │

│  [Laba Rugi 6 Bulan Chart - Bar]              │

│  [Latest Orders Table] │ [Latest Biaya Table] │
└─────────────────────────────────────────────────┘
```

## 🔐 User Roles & Permissions

-   **Admin/Manager**: Full access ke semua fitur
-   Future: Dapat diperluas dengan role-based access control (RBAC)

## 📝 Database Schema

### kategori_transports

```sql
id, nama_kategori (unique), kapasitas, deskripsi, timestamps
```

### akun_akuntansis

```sql
id, kode_akun (unique), nama_akun, jenis (Aset/Utang/Modal/Pendapatan/Beban), deskripsi, timestamps
```

### orders

```sql
id, kategori_id (FK), akun_pendapatan_id (FK), nama_pelanggan, no_telp,
tanggal_sewa, tanggal_selesai, total_biaya, uang_muka, denda,
jaminan (file), status (pending/aktif/selesai/dibatalkan),
keterangan, timestamps
```

### biaya_operasionals

```sql
id, nama_biaya, nominal, tanggal, akun_beban_id (FK), keterangan, timestamps
```

### transaksi_akuntansis

```sql
id, akun_id (FK), tipe_transaksi (debet/kredit), nominal, tanggal_transaksi,
referensi, referensi_type, referensi_id, keterangan, timestamps
```

## 🚀 Deployment

### Production Build

```bash
npm run build
php artisan config:cache
php artisan route:cache
php artisan optimize
```

### Environment Variables untuk Production

```env
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:...
DB_CONNECTION=mysql
DB_HOST=prod-database-host
DB_DATABASE=kembang_lestari
DB_USERNAME=prod_user
DB_PASSWORD=secure_password
```

## 📞 Support & Maintenance

-   Regular database backups
-   Monitor application logs: `storage/logs/`
-   Clear cache regularly: `php artisan cache:clear`

## 📄 License

Private Project untuk Kembang Lestari Travel

---

**Dibuat dengan ❤️ untuk Kembang Lestari Travel**

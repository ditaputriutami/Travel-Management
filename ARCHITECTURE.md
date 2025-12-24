# 🏗️ Arsitektur Sistem Kembang Lestari Travel

## 📊 Diagram Alur Sistem

```
┌─────────────────────────────────────────────────────────────┐
│                   KEMBANG LESTARI TRAVEL                    │
│                  Web-Based Accounting System                │
└─────────────────────────────────────────────────────────────┘

┌─────────────────┐
│   FRONT-END     │
├─────────────────┤
│ Tailwind CSS    │
│ Blade Template  │
│ Chart.js        │
│ Responsive UI   │
└────────┬────────┘
         │
         ↓
┌─────────────────┐     ┌──────────────────┐
│  ROUTING        │────→│  CONTROLLERS     │
│  (web.php)      │     │  (7 Controllers) │
└─────────────────┘     └────────┬─────────┘
                                 │
        ┌────────────────────────┼────────────────────────┐
        ↓                        ↓                        ↓
   ┌─────────────┐      ┌──────────────┐      ┌──────────────┐
   │  MODELS     │      │  MIGRATIONS  │      │   VIEWS      │
   │  (6 Models) │      │  (7 Tables)  │      │  (30+ Files) │
   └─────────────┘      └──────────────┘      └──────────────┘
        │                     │                       │
        └─────────────────────┼───────────────────────┘
                              ↓
                      ┌──────────────┐
                      │  DATABASE    │
                      │  (SQLite)    │
                      └──────────────┘
```

---

## 📁 File Structure & Components

### 🎨 **Frontend Layer**

```
resources/
├── css/
│   └── app.css                          # Tailwind CSS + Custom Components
│       ├── @tailwind base
│       ├── @tailwind components
│       └── @tailwind utilities
│       └── @layer components (badges, buttons, cards, etc.)
│
├── js/
│   └── app.js                           # Entry point JS
│
└── views/
    ├── layouts/
    │   └── app.blade.php                # Master Layout
    │       ├── Sidebar Navigation
    │       ├── Top Navbar
    │       └── Content Slot
    │
    ├── components/
    │   ├── sidebar.blade.php            # Blue gradient sidebar dengan menu
    │   └── navbar.blade.php             # Top header dengan user info
    │
    ├── dashboard.blade.php              # Main Dashboard
    │   ├── Stat Cards (4 cards)
    │   ├── Line Chart (Revenue 6 months)
    │   ├── Pie Chart (Revenue vs Cost)
    │   ├── Bar Chart (Profit & Loss)
    │   └── Latest Orders & Biaya Tables
    │
    ├── kategori-transport/
    │   ├── index.blade.php              # List all categories
    │   ├── create.blade.php             # Add new category
    │   └── edit.blade.php               # Edit category
    │
    ├── akun-akuntansi/
    │   ├── index.blade.php              # List all accounts
    │   ├── create.blade.php             # Add new account
    │   ├── edit.blade.php               # Edit account
    │   └── show.blade.php               # Account details + transactions
    │
    ├── orders/
    │   ├── index.blade.php              # List all orders
    │   ├── create.blade.php             # Add new order + file upload
    │   └── edit.blade.php               # Edit order + file management
    │
    ├── biaya-operasional/
    │   ├── index.blade.php              # List all costs
    │   ├── create.blade.php             # Add new cost
    │   └── edit.blade.php               # Edit cost
    │
    └── laporan/
        ├── index.blade.php              # Report dashboard
        ├── pendapatan.blade.php         # Revenue report
        ├── laba-rugi.blade.php          # Income statement
        ├── neraca.blade.php             # Balance sheet
        └── perubahan-modal.blade.php    # Statement of equity
```

### 🔧 **Backend Layer**

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── DashboardController.php
│   │   │   └── Methods:
│   │   │       ├── index()             # Get dashboard data
│   │   │       ├── getRevenueByMonth()
│   │   │       ├── getProfitLossByMonth()
│   │   │       └── getRevenueVsCostData()
│   │   │
│   │   ├── KategoriTransportController.php
│   │   │   └── RESTful Methods:
│   │   │       ├── index()            # List all
│   │   │       ├── create()           # Show create form
│   │   │       ├── store()            # Save to DB
│   │   │       ├── edit()             # Show edit form
│   │   │       ├── update()           # Update in DB
│   │   │       └── destroy()          # Delete from DB
│   │   │
│   │   ├── AkunAkuntansiController.php (CRUD + show balances)
│   │   ├── OrderController.php        (CRUD + file upload)
│   │   ├── BiayaOperasionalController.php (CRUD)
│   │   └── LaporanController.php
│   │       └── Methods:
│   │           ├── index()                 # Report dashboard
│   │           ├── laporanPendapatan()     # Revenue report
│   │           ├── laporanLabaRugi()       # Income statement
│   │           ├── laporanNeraca()         # Balance sheet
│   │           └── laporanPerubahanModal() # Equity statement
│   │
│   └── Middleware/
│       └── Authenticate.php           # Auth guard
│
└── Models/
    ├── User.php                       # User authentication
    │   └── Relations:
    │       └── (Future: hasMany orders, logs)
    │
    ├── KategoriTransport.php
    │   └── Relations:
    │       └── hasMany('Order')
    │
    ├── AkunAkuntansi.php
    │   └── Relations:
    │       ├── hasMany('TransaksiAkuntansi')
    │       ├── hasMany('Order', 'akun_pendapatan_id')
    │       └── hasMany('BiayaOperasional', 'akun_beban_id')
    │   └── Methods:
    │       └── getSaldo() # Calculate debet-kredit balance
    │
    ├── Order.php
    │   └── Relations:
    │       ├── belongsTo('KategoriTransport')
    │       └── belongsTo('AkunAkuntansi', 'akun_pendapatan_id')
    │   └── Methods:
    │       ├── getSisaPembayaran()     # Calculate remaining balance
    │       └── getStatusBadge()         # Get CSS class for status
    │
    ├── BiayaOperasional.php
    │   └── Relations:
    │       └── belongsTo('AkunAkuntansi', 'akun_beban_id')
    │
    └── TransaksiAkuntansi.php
        └── Relations:
            └── belongsTo('AkunAkuntansi', 'akun_id')
```

### 📊 **Database Layer**

```
┌──────────────────────────────────────────────────────────┐
│                    DATABASE SCHEMA                       │
└──────────────────────────────────────────────────────────┘

┌─ users ─────────────────────────┐
│ id (PK)                         │
│ name, email, password           │
│ email_verified_at               │
│ remember_token                  │
│ created_at, updated_at          │
└─────────────────────────────────┘

┌─ kategori_transports ───────────┐
│ id (PK)                         │
│ nama_kategori (UNIQUE)          │
│ kapasitas (int)                 │
│ deskripsi (text)                │
│ created_at, updated_at          │
└─────────────────────────────────┘

┌─ akun_akuntansis ───────────────┐
│ id (PK)                         │
│ kode_akun (UNIQUE)              │
│ nama_akun                       │
│ jenis (Aset|Utang|Modal|...)    │
│ deskripsi                       │
│ created_at, updated_at          │
└─────────────────────────────────┘

┌─ orders ────────────────────────┐
│ id (PK)                         │
│ kategori_id (FK)                │
│ akun_pendapatan_id (FK)         │
│ nama_pelanggan                  │
│ no_telp                         │
│ tanggal_sewa (date)             │
│ tanggal_selesai (date)          │
│ total_biaya (decimal)           │
│ uang_muka (decimal)             │
│ denda (decimal)                 │
│ jaminan (path)                  │
│ status (pending|aktif|...)      │
│ keterangan (text)               │
│ created_at, updated_at          │
└─────────────────────────────────┘

┌─ biaya_operasionals ────────────┐
│ id (PK)                         │
│ nama_biaya                      │
│ nominal (decimal)               │
│ tanggal (date)                  │
│ akun_beban_id (FK)              │
│ keterangan                      │
│ created_at, updated_at          │
└─────────────────────────────────┘

┌─ transaksi_akuntansis ──────────┐
│ id (PK)                         │
│ akun_id (FK)                    │
│ tipe_transaksi (debet|kredit)   │
│ nominal (decimal)               │
│ tanggal_transaksi (date)        │
│ referensi (string)              │
│ referensi_type (string)         │
│ referensi_id (bigint)           │
│ keterangan                      │
│ created_at, updated_at          │
└─────────────────────────────────┘
```

### 🛣️ **Routing**

```
routes/web.php
├── GET  /                           → Redirect to login
├── /auth/* (Breeze authentication)
│   ├── POST /register               → Create user
│   ├── POST /login                  → Login
│   └── POST /logout                 → Logout
│
└── Middleware 'auth' Group:
    │
    ├── GET  /dashboard              → DashboardController@index
    │
    ├── /kategori-transport (Resource Route)
    │   ├── GET    /                 → index
    │   ├── GET    /create           → create
    │   ├── POST   /                 → store
    │   ├── GET    /{id}             → show
    │   ├── GET    /{id}/edit        → edit
    │   ├── PUT    /{id}             → update
    │   └── DELETE /{id}             → destroy
    │
    ├── /akun-akuntansi (Resource Route) [similar]
    ├── /orders (Resource Route) [similar]
    ├── /biaya-operasional (Resource Route) [similar]
    │
    └── /laporan
        ├── GET    /                 → index
        ├── GET    /pendapatan       → laporanPendapatan
        ├── GET    /laba-rugi        → laporanLabaRugi
        ├── GET    /neraca           → laporanNeraca
        └── GET    /perubahan-modal  → laporanPerubahanModal
```

---

## 🔄 Alur Data & Transaksi

### Alur 1: Membuat Order (Pendapatan)

```
1. Admin input Order di form
   ↓
2. OrderController@store() validate input
   ↓
3. Order model created in database
   ↓
4. AUTO JOURNAL ENTRY:
   Debit Aset (Kas/Bank)
   Credit Pendapatan (Akun yang dipilih)
   ↓
5. TransaksiAkuntansi record created
   ↓
6. Dashboard & Laporan otomatis update
```

### Alur 2: Mencatat Biaya Operasional (Beban)

```
1. Admin input Biaya di form
   ↓
2. BiayaOperasionalController@store() validate
   ↓
3. BiayaOperasional model created
   ↓
4. AUTO JOURNAL ENTRY:
   Debit Beban (Akun yang dipilih)
   Credit Aset (Kas/Bank)
   ↓
5. TransaksiAkuntansi record created
   ↓
6. Dashboard & Laporan otomatis update
```

### Alur 3: Laporan Laba Rugi

```
1. Admin request laporan bulan X
   ↓
2. LaporanController calculate:
   - SUM(Pendapatan dari Orders)
   - SUM(Beban dari BiayaOperasional)
   ↓
3. Laba/Rugi = Pendapatan - Beban
   ↓
4. Format & display ke view
```

---

## 🔐 Security Features

```
✓ Laravel Breeze Authentication
  ├── Password hashing (bcrypt)
  ├── Session management
  └── CSRF protection

✓ Authorization & Access Control
  ├── Middleware 'auth' protection
  └── Route-level protection

✓ Data Validation
  ├── Server-side validation di setiap controller
  ├── File upload validation (type, size)
  └── Business logic validation

✓ File Upload Security
  ├── Type checking (PDF, JPG, PNG)
  ├── Size limit (10MB)
  ├── Stored in storage/public/jaminan
  └── Secure file access via URL

✓ Database Protection
  ├── Foreign key constraints
  ├── Data integrity checks
  └── Soft delete ready (Future)
```

---

## 📈 Performance Considerations

```
✓ Database Queries
  ├── Eager loading dengan .with()
  ├── Pagination untuk large datasets
  └── Indexed foreign keys

✓ Frontend
  ├── Tailwind CSS compiled to production
  ├── Chart.js CDN for charts
  └── Responsive design (mobile-first)

✓ Caching
  ├── Session cache untuk user auth
  ├── Database transactions untuk consistency
  └── Future: Redis caching untuk reports

✓ Scalability
  ├── Modular controller design
  ├── Reusable blade components
  ├── Easy to add new report types
  └── Easy to extend with new modules
```

---

## 🔌 Integration Points

### Chart.js Integration

```javascript
// Dashboard uses Chart.js for:
- Line chart (revenue trends)
- Pie chart (revenue vs cost)
- Bar chart (profit & loss)
// CDN: https://cdn.jsdelivr.net/npm/chart.js
```

### File Storage

```
Files stored in:
├── storage/app/public/jaminan/  (Order attachment)
└── Accessible via: storage_url('jaminan/filename')
```

### Logging

```
Logs in:
├── storage/logs/laravel.log
└── Tracks: queries, errors, auth events
```

---

## 🚀 Future Enhancements

```
Phase 2:
├── Role-Based Access Control (RBAC)
├── Multi-user permission system
├── Audit trail & activity logging
├── Bank reconciliation module
└── Tax reporting features

Phase 3:
├── API for mobile app
├── Real-time notifications
├── Advanced analytics dashboard
├── Automated invoice generation
└── Integration dengan payment gateway

Phase 4:
├── Multi-branch support
├── Inventory management
├── Customer CRM module
├── Advanced forecasting
└── Mobile app (Flutter/React Native)
```

---

**Architecture Version**: 1.0  
**Last Updated**: Desember 2025  
**Tech Stack**: Laravel 11 + Tailwind CSS 4 + Chart.js + SQLite

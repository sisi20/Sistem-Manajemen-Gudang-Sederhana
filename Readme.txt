# 🗃️ Inventory Management System

Sistem Inventory berbasis **CodeIgniter 4** & **AdminLTE 3** untuk memudahkan pengelolaan stok barang, transaksi masuk/keluar, laporan, dan dashboard interaktif dengan chart.

---

## ✨ Fitur Utama

### 1. Manajemen Barang
- CRUD barang.
- Stok tidak boleh minus.
- Data barang: nama, kode, kategori, satuan, jumlah stok.

### 2. Manajemen Kategori
- CRUD kategori.
- Contoh: IT EQUIPMENTS, OFFICE EQUIPMENTS, SPARE PART, KENDARAAN & ALAT BERAT.

### 3. Pembelian Barang
- CRUD pembelian.
- Data: vendor, alamat, tanggal, pembeli, detail barang.

### 4. Barang Masuk
- Sesuai pembelian.
- Stok otomatis bertambah.

### 5. Barang Keluar
- Transaksi mengurangi stok sesuai jumlah barang.

### 6. Laporan
- Barang masuk/keluar berdasarkan tanggal.
- Stok terkini.

### 7. Dashboard
- Ringkasan stok, transaksi hari ini, total pembelian.
- Visualisasi dengan **Chart.js** (Pie & Bar Chart).

---

## 🏗 Struktur Proyek

---
app/
├── Controllers/
│ ├── AuthController.php
│ ├── DashboardController.php
│ └── ...
├── Models/
│ ├── UserModel.php
│ ├── ProductModel.php
│ ├── IncomingItemModel.php
│ └── OutgoingItemModel.php
├── Views/
│ ├── auth/
│ ├── dashboard.php
│ ├── layout/
│ └── report/
public/
├── assets/ (CSS, JS, AdminLTE, plugin)

## ⚙️ Instalasi & Setup

1. **Clone repository**  
```bash
git clone <repository_url>

2. Masuk kefolder Proyek
cd inventory-system

3. instal dependensi
composer install

4.Konfigurasi Database
Buat database MySQL (contoh: db_inventory).
Import file database.sql.
Sesuaikan app/Config/Database.php.

5.Jalankan server
php spark serve
Akses: http://localhost:8080

6.Login Default
Username: admin
Password: admin123 (gunakan hash jika tersimpan di database)

Teknologi yang digunakan
PHP 8.1 & CodeIgniter 4
MySQL
Bootstrap 4 & AdminLTE 3
Chart.js
Font Awesome

Tantangan

Tampilan kurang menarik	Tambahkan gradient, shadow, card interaktif dan waktu pengerjaan yang sangat singkat

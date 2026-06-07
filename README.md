# POSKO — Sistem Informasi Pendataan dan Penyaluran Bantuan Bencana

POSKO adalah aplikasi website berbasis Laravel yang digunakan untuk membantu proses pendataan, pengelolaan, dan penyaluran bantuan bencana. Sistem ini dapat mencatat bantuan yang masuk dari donatur, mengelola stok barang bantuan, mencatat bantuan yang keluar atau didistribusikan, serta menampilkan laporan stok dan riwayat bantuan.

Project ini dibuat untuk mempermudah petugas posko dalam mengelola data bantuan seperti sembako, pakaian, obat-obatan, perlengkapan bayi, alat kebersihan, dan kebutuhan lainnya agar proses distribusi lebih tertata, transparan, dan mudah dilaporkan.

---

## Fitur Utama

* Dashboard ringkasan data bantuan
* CRUD kategori bantuan
* CRUD barang bantuan
* CRUD donatur
* CRUD penerima / lokasi tujuan
* Input bantuan masuk
* Input bantuan keluar / distribusi
* Stok barang otomatis bertambah saat bantuan masuk
* Stok barang otomatis berkurang saat bantuan keluar
* Validasi stok agar tidak minus
* Detail transaksi bantuan masuk dan keluar
* Laporan stok dan riwayat bantuan
* Cetak laporan
* Tampilan menggunakan layout utama agar lebih rapi

---

## Teknologi yang Digunakan

* Laravel
* PHP
* PostgreSQL
* Supabase Database
* Blade Template
* HTML & CSS
* Git & GitHub

---

## Struktur Fitur

### 1. Dashboard

Menampilkan ringkasan data seperti:

* Total kategori
* Total barang bantuan
* Total stok tersedia
* Total bantuan masuk
* Total bantuan keluar
* Daftar stok barang bantuan

### 2. Kategori Bantuan

Digunakan untuk mengelompokkan barang bantuan, misalnya:

* Sembako
* Pakaian
* Obat-obatan
* Perlengkapan bayi
* Alat kebersihan
* Lainnya

### 3. Barang Bantuan

Digunakan untuk mencatat data barang bantuan, seperti nama barang, kategori, satuan, stok, dan keterangan.

### 4. Donatur

Digunakan untuk mencatat data pemberi bantuan, baik perorangan, komunitas, lembaga, maupun instansi.

### 5. Penerima / Lokasi Tujuan

Digunakan untuk mencatat pihak atau lokasi yang menerima bantuan.

### 6. Bantuan Masuk

Digunakan untuk mencatat barang bantuan yang diterima dari donatur. Saat data bantuan masuk disimpan, stok barang akan otomatis bertambah.

### 7. Bantuan Keluar / Distribusi

Digunakan untuk mencatat barang bantuan yang disalurkan kepada penerima atau lokasi tujuan. Saat data distribusi disimpan, stok barang akan otomatis berkurang.

### 8. Laporan

Digunakan untuk melihat laporan stok barang, riwayat bantuan masuk, dan riwayat bantuan keluar. Laporan juga dapat dicetak melalui tombol cetak laporan.

---

## Cara Menjalankan Project

### 1. Clone Repository

```bash
git clone https://github.com/Baymaxxxu/kelompok-6.git
cd kelompok-6
```

Jika sudah pernah clone repository, cukup jalankan:

```bash
git pull origin main
```

---

### 2. Install Dependency Laravel

```bash
composer install
```

Jika dibutuhkan, install juga dependency frontend:

```bash
npm install
```

---

### 3. Buat File `.env`

File `.env` tidak ikut tersimpan di GitHub, jadi harus dibuat manual.

```bash
cp .env.example .env
```

Lalu generate application key:

```bash
php artisan key:generate
```

---

### 4. Setting Database Supabase

Buka file `.env`, lalu sesuaikan bagian database dengan koneksi Supabase.

Contoh konfigurasi:

```env
APP_NAME=POSKO
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=pgsql
DB_HOST=HOST_SUPABASE_POOLER
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=USERNAME_SUPABASE
DB_PASSWORD=PASSWORD_SUPABASE

SESSION_DRIVER=file
```

Catatan:

* Gunakan koneksi Supabase Session Pooler agar lebih stabil.
* Jangan membagikan password database secara publik.
* Jangan upload file `.env` ke GitHub.
* Pastikan `SESSION_DRIVER=file`, bukan `database`.

---

### 5. Clear Cache Laravel

Setelah mengatur file `.env`, jalankan:

```bash
php artisan optimize:clear
```

Atau bisa juga menjalankan perintah berikut:

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

---

### 6. Jalankan Server Laravel

Pastikan terminal berada di folder project yang memiliki file `artisan`.

```bash
php artisan serve
```

Buka aplikasi melalui browser:

```text
http://127.0.0.1:8000
```

---

## Daftar Route / Menu

| Menu                     | URL              |
| ------------------------ | ---------------- |
| Dashboard                | `/`              |
| Kategori Bantuan         | `/kategori`      |
| Barang Bantuan           | `/barang`        |
| Donatur                  | `/donatur`       |
| Penerima / Lokasi Tujuan | `/penerima`      |
| Bantuan Masuk            | `/bantuan-masuk` |
| Distribusi Bantuan       | `/distribusi`    |
| Laporan                  | `/laporan`       |

---

## Alur Sistem

```text
Donatur memberi bantuan
        ↓
Petugas input Bantuan Masuk
        ↓
Stok barang otomatis bertambah
        ↓
Petugas menyalurkan bantuan
        ↓
Petugas input Distribusi
        ↓
Stok barang otomatis berkurang
        ↓
Laporan stok dan riwayat bantuan dapat dilihat
```

---

## Cara Cek Koneksi Database

Jalankan:

```bash
php artisan tinker
```

Lalu ketik:

```php
App\Models\Category::count();
```

Jika muncul angka, berarti Laravel berhasil terhubung ke database Supabase.

Untuk keluar dari tinker:

```php
exit
```

---

## Troubleshooting

### 1. Error 404 Not Found

Pastikan menjalankan server dari folder project Laravel yang benar.

Cek isi folder:

```bash
ls
```

Pastikan ada file:

```text
artisan
composer.json
routes
resources
app
```

Lalu jalankan:

```bash
php artisan serve
```

Buka:

```text
http://127.0.0.1:8000
```

---

### 2. Route Tidak Muncul

Jalankan:

```bash
php artisan route:list
```

Jika route belum muncul, jalankan:

```bash
php artisan route:clear
php artisan optimize:clear
```

---

### 3. Error Database Supabase

Pastikan konfigurasi `.env` sudah benar:

```env
DB_CONNECTION=pgsql
DB_HOST=HOST_SUPABASE_POOLER
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=USERNAME_SUPABASE
DB_PASSWORD=PASSWORD_SUPABASE
```

Setelah mengubah `.env`, jalankan:

```bash
php artisan optimize:clear
php artisan serve
```

---

### 4. Error Table `sessions` Tidak Ditemukan

Pastikan di `.env` menggunakan:

```env
SESSION_DRIVER=file
```

Bukan:

```env
SESSION_DRIVER=database
```

Lalu jalankan:

```bash
php artisan optimize:clear
```

---

### 5. Loading Agak Lama

Loading bisa sedikit lebih lama karena database menggunakan Supabase online. Setiap aksi tambah, edit, hapus, dan lihat data membutuhkan koneksi internet ke database Supabase.

---

## Catatan untuk Anggota Kelompok

Jika ingin ikut mengembangkan project:

1. Clone repository
2. Jalankan `composer install`
3. Buat file `.env`
4. Isi konfigurasi database Supabase
5. Jalankan `php artisan key:generate`
6. Jalankan `php artisan optimize:clear`
7. Jalankan `php artisan serve`
8. Buka `http://127.0.0.1:8000`

Sebelum mulai mengerjakan fitur baru, pastikan selalu update kode terbaru:

```bash
git pull origin main
```

Setelah selesai mengerjakan fitur:

```bash
git status
git add .
git commit -m "pesan commit"
git push origin main
```

---

## Pengembangan Selanjutnya

Beberapa fitur yang dapat dikembangkan:

* Login admin dan petugas
* Role akses admin dan petugas
* Filter laporan berdasarkan tanggal
* Export laporan ke PDF
* Export laporan ke Excel
* Upload foto bukti bantuan masuk
* Upload foto bukti distribusi
* Input banyak barang dalam satu transaksi
* Peringatan stok menipis
* Dashboard dengan grafik bantuan masuk dan keluar

---

## Nama Project

**POSKO — Sistem Informasi Pendataan dan Penyaluran Bantuan Bencana**

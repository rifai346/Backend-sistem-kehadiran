# Backend Sistem Kehadiran – CodeIgniter 4

## 📋 Apa Itu CodeIgniter?

CodeIgniter adalah framework PHP full-stack yang ringan, cepat, fleksibel, dan aman. Proyek ini menggunakan CodeIgniter 4 untuk membangun RESTful API untuk sistem kehadiran dengan autentikasi JWT.

📖 Panduan resmi CodeIgniter dapat ditemukan di [situs resmi](https://codeigniter.com) atau [user guide](https://codeigniter.com/user_guide/).

---

## 🚀 Instalasi

### 1. Clone Proyek

```bash
git clone https://github.com/rifai346/Backend-sistem-kehadiran.git
cd Backend-sistem-kehadiran
```

### 2. Instalasi Dependensi

```bash
composer install
```

### 3. Konfigurasi Lingkungan

Salin file `env` menjadi `.env`:

```bash
cp env .env
```

Sesuaikan konfigurasi di file `.env`:

```ini
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'
database.default.hostname = localhost
database.default.database = nama_database_anda
database.default.username = nama_pengguna_database
database.default.password = kata_sandi_database
database.default.DBDriver = MySQLi
```

### 4. Migrasi Database

Pastikan database sudah dibuat, lalu jalankan migrasi:

```bash
php spark migrate
```

### 5. Jalankan Server

```bash
php spark serve
```

Aplikasi akan berjalan di `http://localhost:8080`.

---

## 🔐 Autentikasi JWT

Aplikasi ini menggunakan JWT untuk autentikasi. Setelah login berhasil, Anda akan menerima token yang harus disertakan dalam header `Authorization` untuk mengakses endpoint yang dilindungi.

### 1. **Register**

* **Endpoint**: `POST /auth/register`
* **Body JSON**:

```json
{
    "email": "user@example.com",
    "password": "password123",
    "role": "user"
}
```

### 2. **Login**

* **Endpoint**: `POST /auth/login`
* **Body JSON**:

```json
{
    "email": "user@example.com",
    "password": "password123"
}
```

### 3. **Logout**

* **Endpoint**: `POST /auth/logout`
* **Header**:

```
Authorization: Bearer <jwt_token_here>
```

---

## 📁 Struktur Direktori

* `app/Controllers/AuthController.php`: Mengelola autentikasi (login, register, logout).
* `app/Models/UserModel.php`: Model untuk tabel pengguna.
* `app/Libraries/JWTLib.php`: Library untuk mengelola JWT.

---

## 📦 Server Requirements

* PHP 8.1 atau lebih baru.
* Ekstensi PHP yang diperlukan:

  * intl
  * mbstring
  * json (default)
  * mysqlnd (untuk MySQL)
  * libcurl (untuk CURLRequest)

---

## 💬 Catatan Tambahan

* Pastikan database sudah terhubung sebelum melakukan migrasi.
* Perbarui `app.baseURL` di `.env` sesuai dengan URL server Anda.
* Pastikan JWT secret key sudah dikonfigurasi dengan aman.

Happy coding! 🚀

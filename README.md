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

Aplikasi akan berjalan di `http://localhost:8080/`.

---

## 🔐 Autentikasi JWT

Aplikasi ini menggunakan JWT untuk autentikasi. Setelah login berhasil, Anda akan menerima token yang harus disertakan dalam header `Authorization` untuk mengakses endpoint yang dilindungi.

### 1. **Register**

* **Endpoint**: `POST http://localhost:8080/auth/register`
* **Body JSON**:

```json
{
    "email": "user@example.com",
    "password": "password123",
    "role": "user"
}
```

* **Respons Sukses**:

```json
{
    "status": 201,
    "message": "Registration successful",
    "user": {
        "id": 1,
        "email": "user@example.com"
    }
}
```

### 2. **Login**

* **Endpoint**: `POST http://localhost:8080/auth/login`
* **Body JSON**:

```json
{
    "email": "user@example.com",
    "password": "password123"
}
```

* **Respons Sukses**:

```json
{
    "status": 200,
    "token": "jwt_token_here",
    "user_id": 1,
    "email": "user@example.com",
    "role": "user"
}
```

### 3. **Logout**

* **Endpoint**: `POST http://localhost:8080/auth/logout`
* **Header**:

```
Authorization: Bearer <jwt_token_here>
```

* **Respons Sukses**:

```json
{
    "status": 200,
    "message": "Logout berhasil"
}
```

---

## 📚 Endpoint untuk Mahasiswa, Dosen, Mata Kuliah, dan Absensi

### Mahasiswa

* **Daftar Mahasiswa**

  * **Endpoint**: `GET http://localhost:8080/mahasiswa`
  * **Header**:

```
Authorization: Bearer <jwt_token_here>
```

* **Tambah Mahasiswa**

  * **Endpoint**: `POST http://localhost:8080/mahasiswa`
  * **Body JSON**:

```json
{
    "nama": "Nama Mahasiswa",
    "nim": "12345678",
    "jurusan": "Teknik Informatika"
}
```

### Dosen

* **Daftar Dosen**

  * **Endpoint**: `GET http://localhost:8080/dosen`
  * **Header**:

```
Authorization: Bearer <jwt_token_here>
```

* **Tambah Dosen**

  * **Endpoint**: `POST http://localhost:8080/dosen`
  * **Body JSON**:

```json
{
    "nama": "Nama Dosen",
    "nidn": "12345678",
    "matakuliah": "Pemrograman Web"
}
```

### Mata Kuliah

* **Daftar Mata Kuliah**

  * **Endpoint**: `GET http://localhost:8080/matkul`
  * **Header**:

```
Authorization: Bearer <jwt_token_here>
```

* **Tambah Mata Kuliah**

  * **Endpoint**: `POST http://localhost:8080/matkul`
  * **Body JSON**:

```json
{
    "kode": "IF101",
    "nama": "Pemrograman Web",
    "sks": 3
}
```

### Absensi

* **Daftar Absensi**

  * **Endpoint**: `GET http://localhost:8080/absensi`
  * **Header**:

```
Authorization: Bearer <jwt_token_here>
```

* **Tambah Absensi**

  * **Endpoint**: `POST http://localhost:8080/absensi`
  * **Body JSON**:

```json
{
    "mahasiswa_id": 1,
    "matkul_id": 1,
    "status": "Hadir",
    "tanggal": "2024-05-15"
}
```

---

## 📁 Struktur Direktori

* `app/Controllers/AuthController.php`: Mengelola autentikasi (login, register, logout).
* `app/Controllers/MahasiswaController.php`: Mengelola data mahasiswa.
* `app/Controllers/DosenController.php`: Mengelola data dosen.
* `app/Controllers/MatkulController.php`: Mengelola data mata kuliah.
* `app/Controllers/AbsensiController.php`: Mengelola data absensi.
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

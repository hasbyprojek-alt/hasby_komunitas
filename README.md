# HasbyForum — Forum Diskusi Komunitas

**UTS Web Lanjut | Muhammad Hasby Abdillah | Sistem Informasi — UMP Pontianak**

Aplikasi forum diskusi komunitas berbasis Laravel + Tailwind CSS dengan fitur CRUD lengkap.

---

## ✨ Fitur

- ✅ **Autentikasi** — Register, Login, Logout
- ✅ **CREATE** — Buat diskusi baru
- ✅ **READ** — Lihat semua diskusi & detail diskusi
- ✅ **UPDATE** — Edit diskusi (hanya penulis)
- ✅ **DELETE** — Hapus diskusi (hanya penulis)
- ✅ **Search & Filter** — Cari berdasarkan judul dan kategori
- ✅ **Like** — Suka postingan
- ✅ **Tailwind CSS** — Desain modern & responsif
- ✅ **SQLite** — Database ringan tanpa konfigurasi tambahan

---

## 🚀 Cara Menjalankan

### Prasyarat
- PHP 8.3+
- Composer
- Node.js & NPM

### Langkah Setup

```bash
# 1. Clone repo
git clone https://github.com/USERNAME/hasby_komunitas.git
cd hasby_komunitas

# 2. Install PHP dependencies
composer install

# 3. Copy & setup environment
cp .env.example .env
php artisan key:generate

# 4. Buat database SQLite
touch database/database.sqlite

# 5. Jalankan migrasi + seeder
php artisan migrate --seed

# 6. Install & build assets
npm install
npm run dev

# 7. Jalankan server
php artisan serve
```

Buka http://localhost:8000

### Akun Demo (setelah seeding)
- **Email:** hasby@demo.com
- **Password:** password123

---

## 🗂️ Struktur Proyek

```
app/Http/Controllers/
  ├── PostController.php          # CRUD Diskusi
  └── Auth/
      ├── AuthenticatedSessionController.php
      └── RegisteredUserController.php

app/Models/
  ├── Post.php
  └── User.php

resources/views/
  ├── layouts/app.blade.php       # Layout utama
  ├── posts/
  │   ├── index.blade.php         # Daftar diskusi
  │   ├── show.blade.php          # Detail diskusi
  │   ├── create.blade.php        # Form buat diskusi
  │   └── edit.blade.php          # Form edit diskusi
  └── auth/
      ├── login.blade.php
      └── register.blade.php
```

---

## 🛠️ Tech Stack

- **Backend:** Laravel 13
- **Frontend:** Tailwind CSS (CDN)
- **Database:** SQLite
- **Auth:** Custom Breeze-style controllers

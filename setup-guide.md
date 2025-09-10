# 🚀 NewsGrid Setup Guide

## Persyaratan Sistem
- PHP 7.4+ (dengan ekstensi GD enabled)
- MySQL 5.7+
- Apache/Nginx Web Server
- Composer

## Langkah Setup

### 1. Setup Database
```sql
-- Buat database
CREATE DATABASE `news-portal`;

-- Import file SQL
-- Gunakan phpMyAdmin atau MySQL Workbench untuk import news-portal.sql
```

### 2. Konfigurasi Database Connection
File: `includes/database.inc.php`
```php
$host = "localhost";     // Server MySQL
$user = "root";          // Username MySQL  
$pass = "";              // Password MySQL
$db = "news-portal";     // Nama database
```

### 3. Install Dependencies
```bash
cd assets
composer install --ignore-platform-reqs
```

### 4. Setup Permissions
Pastikan folder berikut memiliki write permission:
- `assets/images/articles/`
- `assets/images/category/`

### 5. Akses Aplikasi
- **Frontend**: `http://localhost/NewsGrid/`
- **Admin Panel**: `http://localhost/NewsGrid/admin/`
- **Author Panel**: `http://localhost/NewsGrid/author/`

## Login Credentials

### Admin
- Email: `admin@admin.com`
- Password: `Admin123`

### Test Author (jika ada)
Buat akun author melalui sistem registrasi

## Fitur Utama

### 🔐 Admin Module
- Kelola kategori artikel
- Aktivasi/deaktivasi artikel
- Kelola trending articles
- Kelola author accounts

### ✍️ Author Module  
- Tulis artikel baru
- Edit/hapus artikel sendiri
- Ubah profil dan password

### 👤 User Module
- Baca artikel
- Bookmark artikel
- Download artikel (PDF)
- Search artikel

## Troubleshooting

### Error: "Database Connection Error"
- Pastikan MySQL service berjalan
- Cek konfigurasi di `includes/database.inc.php`
- Pastikan database `news-portal` sudah dibuat

### Error: mPDF Library
- Jalankan `composer install --ignore-platform-reqs`
- Pastikan PHP extension GD enabled

### Images tidak muncul
- Cek permission folder `assets/images/`
- Pastikan path images benar di database

### CSS/JS tidak load
- Cek path file di HTML
- Pastikan folder `assets/` accessible dari web

## Development Tips

1. **Debugging**: Enable error reporting di PHP
2. **Security**: Gunakan prepared statements untuk queries
3. **Performance**: Optimize images dan enable caching
4. **Backup**: Regular backup database

## File Structure Penting
```
NewsGrid/
├── index.php              # Homepage
├── admin/                 # Admin panel
├── author/                # Author panel  
├── includes/              # Core functions
│   ├── database.inc.php   # DB connection
│   └── functions.inc.php  # Helper functions
├── assets/               # Static files
│   ├── css/             # Stylesheets
│   ├── js/              # JavaScript
│   ├── images/          # Images storage
│   └── vendor/          # Composer packages
└── news-portal.sql      # Database schema
```

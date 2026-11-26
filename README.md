<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

<p align="center">
  <img src="public/images/logo_distro_aseli_aseli.webp" width="160" alt="Logo Distro Aseli Aseli">
</p>

<h1 align="center">Distro Aseli Aseli — Website Katalog & Manajemen UMKM</h1>

<p align="center">
  <em>"Gaya Lokal, Kualitas Maksimal — Aseli Buatan Anak Negeri."</em>
</p>

---

## Tentang Usaha (Profil UMKM)

**Distro Aseli Aseli** adalah brand pakaian *streetwear* dan kasual lokal yang menghadirkan desain orisinal dengan bahan katun kombed premium yang nyaman dipakai sehari-hari. Didirikan untuk mendukung industri kreatif lokal, setiap rilisan kami diproduksi secara terbatas dengan sablon berkualitas tinggi dan potongan modern.

Aplikasi web ini dibangun menggunakan framework **Laravel** sebagai proyek **Ujian Tengah Semester (UTS)** untuk mengelola katalog produk secara dinamis sekaligus memudahkan pengunjung menjelajahi koleksi pakaian secara daring.

## Fitur Utama Aplikasi

### 1. Halaman Publik (Pengunjung)
* **Profil & Deskripsi Usaha:** Menampilkan identitas, logo, dan cerita singkat brand **Distro Aseli Aseli**.
* **Katalog Produk Dinamis:** Menampilkan daftar pakaian dan aksesoris langsung dari database MySQL lengkap dengan kategori, harga (format Rupiah), dan status stok.
* **Halaman Detail Produk:** Menampilkan foto produk resolusi penuh, rincian spesifikasi, sisa stok, dan tombol pemesanan cepat.
* **Desain Responsif:** Antarmuka adaptif menggunakan **Tailwind CSS** yang nyaman diakses melalui perangkat desktop maupun *smartphone*.

### 2. Panel Admin (Terproteksi Autentikasi)
* **Sistem Login & Logout:** Akses khusus admin menggunakan middleware autentikasi Laravel (`auth`).
* **Manajemen Produk (CRUD Lengkap):** Menambah, melihat, memperbarui, dan menghapus data produk.
* **Upload & Manajemen Gambar:** Unggah foto produk ke direktori `storage/app/public/products` dengan pembersihan file otomatis saat foto diperbarui atau produk dihapus.
* **Validasi Sisi Server:** Validasi ketat untuk setiap input form (wajib diisi, format file gambar, batas ukuran maksimal 2MB, serta validasi angka harga dan stok).

## Cara Menjalankan Proyek (Instalasi Lokal)

1. **Clone Repositori**
   ```bash
   git clone [https://github.com/USERNAME_ANDA/distro-aseli-aseli.git](https://github.com/USERNAME_ANDA/distro-aseli-aseli.git)
   cd distro-aseli-aseli

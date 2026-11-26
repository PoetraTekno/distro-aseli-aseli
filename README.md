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

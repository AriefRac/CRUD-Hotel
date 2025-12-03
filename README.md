# CRUD‑Hotel

Sebuah aplikasi web sederhana untuk manajemen data hotel --- termasuk
kamar, tipe kamar, tamu, booking, dan user/admin.\
Proyek ini dibuat sebagai tugas kelompok UAS Pemrograman Web.

## 🔎 Fitur Utama

-   CRUD (Create, Read, Update, Delete) untuk data kamar.\
-   CRUD untuk tipe kamar (room types).\
-   Manajemen data tamu.\
-   Booking/pemesanan kamar (reservasi).\
-   Autentikasi pengguna --- login user/admin.\
-   Dashboard/admin area untuk mengelola seluruh data hotel.\
-   Struktur folder modular agar mudah dikembangkan.

## 🧰 Teknologi & Struktur Proyek

-   Bahasa: **PHP**\
-   Frontend: HTML + CSS\
-   Struktur folder umum: rooms, room-types, guest, bookings, user,
    auth, config, db, template, asset.

## 🚀 Cara Menjalankan

1.  Clone repositori:

        git clone https://github.com/AriefRac/CRUD-Hotel.git

2.  Pindahkan ke folder server lokal (XAMPP/Laragon).\

3.  Buat database `hotel_db`.\

4.  Import file SQL jika tersedia.\

5.  Sesuaikan konfigurasi database di folder `config/`.\

6.  Akses via browser:

        http://localhost/CRUD-Hotel/

## 📁 Struktur Direktori (Contoh)

    /
    ├── rooms/
    ├── room-types/
    ├── guest/
    ├── bookings/
    ├── user/
    ├── auth/
    ├── config/
    ├── db/
    ├── template/
    ├── asset/
    └── README.md

## 🤝 Kontribusi

1.  Fork repo\
2.  Buat branch baru\
3.  Commit dan push\
4.  Ajukan Pull Request

## 📜 Lisensi

Tambahkan lisensi jika diperlukan.

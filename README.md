# Tugas Praktikum 15

## Requirements

Project ini bergantung pada beberapa dependensi berikut:

- PHP >= 8.0
- MongoDB >= 2.0
- TailwindCSS >= 4.0

## Running the project

Sebelum menjalankan project ini silahkan konfigurasi Web Server terlebih dahulu, karena aplikasi PHP tidak bisa berjalan tanpa Web Server yang mendukung FastCGI. Untuk menjalankan project ini di lingkungan Development, Anda dapat menggunakan perintah berikut:

```bash
# Pastikan extension mongodb sudah diaktifkan di PHP
# Bisa menggunakan perintah berikut untuk mengecek apakah extension mongodb sudah diaktifkan
php -m | grep mongodb # Linux
php -m | findstr mongodb # Windows

# Jika extension mongodb belum diaktifkan, silahkan aktifkan terlebih dahulu

# Install dependensi
composer i
npm i

 # Menjalankan TailwindCSS CLI
npm run dev
```

---

<p align="center">Copyright &copy; 2026 - <a href="https://github.com/MowlandCodes" target="_blank">Arifin Firdaus</a></p>

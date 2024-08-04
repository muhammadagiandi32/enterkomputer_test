# TEST BACK END DEVELOPER - ENTERKOMPUTER

## Deskripsi


Project ini dikembangkan untuk mengikuti tes menjadi Backend Developer di Enterkomputer.


## Instalasi

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan aplikasi ini:

1. **Clone Repository**:

    ```bash
    git clone https://github.com/muhammadagiandi32/enterkomputer_test.git
    cd repository
    ```

2. **Instalasi Dependensi**:

    Pastikan Anda memiliki [Composer](https://getcomposer.org/) dan [PHP](https://www.php.net/) terinstal, kemudian jalankan:

    ```bash
    composer install
    ```

3. **Konfigurasi Lingkungan**:

    Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi sesuai kebutuhan Anda:

    ```bash
    cp .env.example .env
    ```

4. **Generate Kunci Aplikasi**:

    ```bash
    php artisan key:generate
    ```

5. **Migrasi Database**:

    Jalankan migrasi untuk membuat tabel yang diperlukan di database:

    ```bash
    php artisan migrate
    ```
    
    Jika tidak ingin menggunakan migrasi gunakan file db.sql yang berada di root folder

6. **Jalankan Server**:

    Mulai server :

    ```bash
    php artisan serve
    ```

## Dokumentasi API

Dokumentasi API Postman dapat diakses melalui [link berikut](https://documenter.getpostman.com/view/15005997/2sA3rwNaKz).

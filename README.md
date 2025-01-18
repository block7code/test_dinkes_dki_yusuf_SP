<h3 align="center">Merge API Daftar Rumah Sakit Di Jakarta</h3>

## ✨ Fitur
- **Merge 2 API.** Menggabungkan API semua rumah sakit [ terkoneksi ](https://dinkes.jakarta.go.id/apps/jp-2024/all-rs-terkoneksi.json) dengan API semua [ RSUD ](https://dinkes.jakarta.go.id/apps/jp-2024/all-rsud.json).

- **Mendapatkan total data terkirim.** Mengjumlahkan data  yang sudah [ dikirimkan ](https://dinkes.jakarta.go.id/apps/jp-2024/transaksi-data-satusehat.json)  ke SatuSehat Kemenkest.

- **Menentukan data terkoneksi atau belum.** 

- **Bisa filter by "kota_kab".** 

- **Bisa filter by "kelas_rs".** 

- **Bisa list "Pagination".** 

- **Bisa atur  "limit".** 


## :wrench: Dokumen Teknis

Penjelasan & Dokumen Teknis Project.

| Nama Project | Bahasa Pemograman | Database | Web Server | Repository |
|---- |----|----|----|----|
| API Daftar Rumah Sakit Di Jakarta | PHP 8.0.2, Framework Laravel 9 | MySQL | Localhost | https://github.com/block7code/test_dinkes_dki_yusuf_SP |

## Cara install 

- **Clone prject** Buka termimanal cd ke folder yg inngin disimpan atau di dalam htdoct dan jalan kan 
```
  git clone https://github.com/block7code/test_dinkes_dki_yusuf_SP.git 
```

- **Masuk ke folder prject** cd test_dinkes_dki_yusuf_SP dan enter
```
  cd test_dinkes_dki_yusuf_SP
```

- **Buat database** 
```mySql

  CREATE DATABASE myapp_database;
```

- **Update file .ENV**  port dan database sesuaikan dengan server Anda
```laravel

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=myapp_database 
    DB_USERNAME=root
    DB_PASSWORD=root
```

- **Migrasi table "rumah_sakit"**
```laravel

   public function up()
    {
        Schema::create('rumah_sakit', function (Blueprint $table) {
            $table->increments('id'); 
            $table->char('id_kode', 36)->unique();
            $table->string('nama')->nullable();
            $table->string('organisasi_id')->nullable();
            $table->integer('kode_rs')->nullable();
            $table->string('kelas_rs')->nullable();
            $table->string('status', 50)->default('Belum Terkoneksi');
            $table->text('alamat')->nullable();
            $table->string('kota_kab')->nullable();
            $table->string('email')->nullable();
            $table->string('lokasi')->nullable();
            $table->integer('jumlah_pengiriman_data')->nullable();
            $table->timestamps(0); 
        });
    }

     /* Jalankan perintah berikut  */
    php artisan migrate --path=/database/migrations/2025_01_17_065714_rumah_sakit.php
```

- **Jalankan Projectnya**
```laravel
    /* Jalankan perintah berikut  */
     php artisan serve
    /* Maka kejenerat Server  */
     http://127.0.0.1:8000/api/mergedata

    /* Atau kalau folder project simpan di localhost htdoct bisa buka url berikut */
    http://localhost:8888/test_dinkes_dki_yusuf_SP/public/api/mergedata
```


## Preview 

<table style="width:100%">
  <tr>
    <th>Contoh Kesulurhan</th>
  </tr>
  <tr>
    <td><img width="100%" alt="Preview "  src="https://raw.githubusercontent.com/block7code/test_dinkes_dki_yusuf_SP/refs/heads/main/screen/preview.gif" > </td>
  </tr>
</table>
<img width="514" alt="preview-all"  src="/screen/preview-all.gif" > 

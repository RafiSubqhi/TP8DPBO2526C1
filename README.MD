# TUGAS PRAKTIKUM 8 DPBO C1

# JANJI
Saya Rafi Subqhi Nuraziz dengan NIM 2408678 mengerjakan Tugas Praktikum 8 dalam mata kuliah Desain Pemrograman Berorientasi Objek untuk keberkahan-Nya maka saya tidak akan melakukan kecurangan seperti yang telah di spesifikasikan. Aamiin.

---

## 1. Desain Program & Arsitektur MVC

Aplikasi ini merupakan **Sistem Manajemen Akademik** berbasis web yang dibangun menggunakan bahasa pemrograman PHP dan database MySQL. Proyek ini merupakan hasil *refactoring* dari kode prosedural menjadi pola arsitektur **MVC (Model-View-Controller)** dengan penambahan entitas relasional baru.

### Pembagian Komponen Arsitektur
1. **Model (`models/`)**
   Bertanggung jawab menangani seluruh logika data dan interaksi langsung dengan database MySQL (eksekusi *query* SQL `SELECT`, `INSERT`, `UPDATE`, `DELETE`).
   - `DB.php`: Kelas induk yang mengelola koneksi database dan eksekusi *query*.
   - `Department.php`: Kelas model untuk mengelola data departemen/program studi.
   - `Lecturer.php`: Kelas model untuk mengelola data dosen beserta relasinya ke departemen (`LEFT JOIN`).
   - `Course.php`: Kelas model untuk mengelola data mata kuliah beserta relasinya ke dosen pengampu (`LEFT JOIN`).

2. **View (`views/` & `templates/`)**
   Bertanggung jawab menyajikan antarmuka pengguna secara dinamis menggunakan *template engine* kustom tanpa mengakses database secara langsung.
   - `Template.php`: *Template engine* yang membaca kerangka HTML dan mengganti *placeholder* (`DATA_...`) dengan data dinamis.
   - `DepartmentView.php`, `LecturerView.php`, `CourseView.php`: Kelas yang memformat data dari Controller ke dalam baris tabel HTML maupun *dropdown* formulir.
   - `templates/*.html`: Kumpulan kerangka antarmuka murni berbasis Bootstrap 5.

3. **Controller (`controllers/`)**
   Bertindak sebagai penghubung antara Model dan View, menerima *request* dari pengguna, memanggil fungsi pengolahan data pada Model, dan meneruskannya ke View untuk di-*render*.
   - `DepartmentController.php`, `LecturerController.php`, `CourseController.php`.

4. **Entry Points (Root Directory)**
   - `config.php`: Menyimpan konfigurasi kredensial server database (`tp_mvc25`).
   - `index.php`: Titik masuk utama untuk halaman manajemen **Lecturers** (Dosen).
   - `department.php`: Titik masuk untuk halaman manajemen **Departments** (Departemen).
   - `course.php`: Titik masuk untuk halaman manajemen **Courses** (Mata Kuliah).

---

## 2. Desain Database

Database bernama **`tp_mvc25`** terdiri dari **3 tabel** yang saling berelasi:

1. **`departments` (Tabel Baru 1)**
   - `id` (INT, Primary Key, Auto Increment)
   - `department_name` (VARCHAR) — Nama departemen/program studi.
   - `faculty` (VARCHAR) — Nama fakultas.

2. **`lecturers` (Tabel Utama — Dimodifikasi)**
   - `id` (INT, Primary Key, Auto Increment)
   - `name` (VARCHAR) — Nama lengkap beserta gelar dosen.
   - `nidn` (VARCHAR) — Nomor Induk Dosen Nasional.
   - `phone` (VARCHAR) — Nomor telepon dosen.
   - `join_date` (DATE) — Tanggal mulai bergabung.
   - `department_id` (INT, Foreign Key -> `departments.id`, `ON DELETE SET NULL`) — Atribut tambahan untuk menghubungkan dosen dengan departemennya.

3. **`courses` (Tabel Baru 2)**
   - `id` (INT, Primary Key, Auto Increment)
   - `course_code` (VARCHAR) — Kode mata kuliah.
   - `course_name` (VARCHAR) — Nama mata kuliah.
   - `sks` (INT) — Bobot Satuan Kredit Semester.
   - `lecturer_id` (INT, Foreign Key -> `lecturers.id`, `ON DELETE CASCADE`) — Menghubungkan mata kuliah dengan dosen pengampunya.

---

## 3. Penjelasan Alur Program

1. **Inisialisasi & Routing (`index.php` / `department.php` / `course.php`)**
   - Saat pengguna mengakses halaman, file *entry point* menginstansiasi objek Controller yang sesuai.
   - Sistem memeriksa parameter HTTP (`$_POST` atau `$_GET`) untuk menentukan aksi yang diminta pengguna (`add`, `edit`, `addForm`, `editForm`, `delete`, atau `index`).

2. **Alur Read (Menampilkan Data)**
   - Pengguna membuka halaman utama -> *Entry point* memanggil method `index()` pada Controller.
   - Controller membuka koneksi melalui Model dan memanggil method `get...()` yang menjalankan *query* `SELECT` disertai `LEFT JOIN` untuk mengambil nama relasi dari tabel induk.
   - Hasil *query* dikumpulkan ke dalam array dan dikirim ke View (`render($data)`).
   - View menyusun baris tabel HTML dan menyisipkannya ke dalam file *template* melalui `Template::replace()`, lalu menampilkannya ke layar pengguna.

3. **Alur Create & Update (Tambah & Ubah Data)**
   - **Menampilkan Form:** Saat tombol **+ Add New** atau **Edit** diklik, Controller mengambil data referensi tabel induk agar tampil pada *dropdown* `<select>`. Jika mode **Edit**, Controller juga mengambil data lama berdasarkan `id` untuk mengisi nilai awal pada input form.
   - **Menyimpan Perubahan:** Saat form disubmit (`POST`), Controller meneruskan array `$_POST` ke method `add($data)` atau `update($data)` pada Model untuk menjalankan *query* `INSERT` atau `UPDATE`, lalu mengarahkan pengguna kembali ke halaman utama entitas tersebut.  
   
4. **Alur Delete (Hapus Data)** 
    - Saat pengguna menekan tombol **Delete** dan mengonfirmasi dialog peringatan, parameter `id_hapus` dikirim melalui URL (`GET`). 
    - Controller memanggil method `delete($id)` pada Model untuk menghapus baris data dari database, lalu me-*redirect* halaman kembali ke tampilan tabel terbaru.

---

## 4. Dokumentasi (Screen Record)
Berikut adalah tautan video dokumentasi yang mendemonstrasikan proses Create, Read, Update, dan Delete untuk semua tabel:

[Klik di sini untuk menonton Video Screenrecord](dokumentasi/dokumentasi.mp4)
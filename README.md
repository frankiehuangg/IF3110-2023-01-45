# Tugas Besar Milestone 1 
IF3110 - Pengembangan Aplikasi Berbasis Web
Semester 1 2023/2024

## Daftar Isi
* [Deskripsi Aplikasi Web](#-deskripsi-aplikasi-web)
* [Daftar Requirement](#-daftar-requirement)
* [Cara Instalasi](#-cara-instalasi)
* [Cara Menjalankan Aplikasi](#-cara-menjalankan-aplikasi)
* [Screenshots](#-screenshots)
* [Pemabgian Tugas](#-pembagian-tugas)

## Deskripsi Aplikasi web
Prabu Baka, ayah dari Roro, merupakan seorang investor startup terkemuka. Dia ingin agar di negaranya semakin banyak startup sehingga dia bisa menjadi semakin kaya semakin banyak membantu orang lain. Dia kemudian meminta Roro mencari pasangan yang siap untuk memberikan hadiah berupa 1000 startup sebagai syarat untuk menikahi Roro. Roro tahu bahwa Bondowoso, orang yang sangat ingin meminangnya, memiliki banyak jin yang ahli di bidang informatika. Oleh karena itu, untuk memenuhi wasiat dari ayahnya, dia meminta Bondowoso untuk membuatkan 1000 startup. 

Bondowoso yang sangat ingin meminang Roro, menyanggupi keinginan Roro. Akan tetapi, Bondowoso acap kali bolos perkuliahan IF3110 Pengembangan Aplikasi Berbasis Web sehingga dia bahkan tidak mengetahui jika HTML itu bukan bahasa pemrograman. Seluruh waktunya hanya sibuk untuk melihat konten dan siniar kurang bermutu di media sosial yang beken pada zaman itu, yaitu BurBir (Burung Biru). 

Oleh karena itu, kalian, para jin Bondowoso, ditugaskan untuk membantu mewujudkan 1000 startup menggunakan seluruh pengetahuan yang kalian miliki hingga sejauh ini. Tentunya Bondowoso akan sangat mengapresiasi kalian dengan memberikan kalian sebuah kejutan. Yuk bantu Bondowoso meminang Roro!

Dengan itu kami membuat aplikasi berbasis web yang mengimitasi _twitter_ dengan fungsionalitas utama seperti login, register, home, tweeting, dll.

## Daftar Requirement
1. Untuk client-side, wajib menggunakan JavaScript, HTML, dan CSS secara murni.
2. Tidak diperbolehkan menggunakan framework CSS atau framework JS (e.g. jQuery, lodash, Bootstrap, atau Tailwind). CSS harus berada di berkas yang berbeda dengan HTML (gunakan CSS selector). Tidak diperbolehkan memanipulasi CSS.
3. Untuk server-side, wajib menggunakan PHP murni tanpa kakas apapun (seperti laravel, codeigniter). Anda harus mengimplementasikan fitur menggunakan HTTP method yang tepat.
4. Untuk basis data, wajib menggunakan MySQL, MariaDB, atau PostgreSQL. Minimal terdapat 3 entitas berbeda dengan minimal 1 relasi one-to-many atau many-to-many antara entitas-entitas tersebut. Tidak diperbolehkan menggunakan ORM atau sejenisnya dan tidak boleh menyimpan blob atau binary file pada basis data.
5. Autentikasi
   * Pengguna dapat dibedakan menjadi 2 kategori: user dan admin.
   * Pengguna harus melakukan autentikasi untuk dapat mengakses seluruh fitur, kecuali disebutkan fitur dapat diakses oleh pengguna yang tidak terautentikasi.
   * Seluruh pengguna yang terautentikasi juga harus dapat melakukan logout.
6. Implementasi CRUD
   * Setiap entitas yang ada dalam sistem (minimal 3 entitas) harus memiliki implementasi CRUD (Create, Read, Update, Delete).
   * Pengguna dengan hak akses yang sesuai (user atau admin) harus dapat menggunakan fitur CRUD ini. Dapat disesuaikan dengan ide perangkat lunak.
   * Untuk setiap aksi yang melakukan perubahan data, tampilkan pesan konfirmasi aksi (misalnya popup window) kepada pengguna sebelum eksekusi dilakukan.
   * Pengguna dapat melakukan CRUD berkas statik (pilih dua dari: gambar, audio, atau video). Implementasi ketentuan ini dibebaskan dan dapat disesuaikan dengan ide perangkat lunak (contoh: tiap pengguna diasosiasikan dengan foto profil nya atau banyak audio musik seperti SoundCloud). Untuk method Read berkas statik, disesuaikan dengan jenis berkas yang diunggah. Contoh: Jika gambar, wajib bisa menampilkan gambar. Jika audio, wajib bisa dimainkan. Jika video, wajib bisa diputar videonya.
7. Implementasi Administrasi
   * Jika pengguna adalah admin, pengguna dapat mengakses ke halaman administrasi yang menampilkan data entitas atau fitur khusus autentikasi admin (fitur dibebaskan sesuai ide produk).
   * Pengguna sebagai admin wajib dapat mengelola data (menambah, memperbarui, menghapus, dan membaca).
8. Terdapat navigation bar di setiap halaman yang dibuat (untuk halaman login atau halaman register boleh untuk tidak menggunakan navigation bar). Minimal terdapat 2 pranala untuk menuju halaman lain.
9. Search Bar
   * Pengguna (user dan admin) dapat mencari (substring), menyortir, dan mem-filter entitas berdasarkan minimal 2 atribut dari entitas tersebut untuk masing-masing fungsi. Contoh: Untuk ide P/L Spotify, mencari lagu berdasar nama artis atau judul lagu, menyortir berdasar timestamp dan judul lagu, mem-filter berdasarkan genre dan penyanyi. Ketiganya wajib dapat dilakukan secara bersamaan. 
   * Search Bar diimplementasikan minimal 1 dalam sebuah halaman daftar suatu entitas bersamaan dengan pagination.
   * Wajib melakukan implementasi debounce pada pencarian untuk menghindari pemanggilan yang berlebihan.
10. Pagination
   * Di setiap halaman yang menampilkan daftar entitas (misalnya, daftar produk), tampilkan sejumlah entitas yang sesuai dengan batasan tertentu per halaman.
   * Tampilkan navigasi (halaman berikutnya dan sebelumnya) atau tautan angka halaman untuk membantu pengguna pindah ke halaman lain.
   * Pagination wajib dilakukan secara server-side.
11. Keamanan
   * Client-side wajib melakukan validasi masukan sederhana dari pengguna (misalnya required field, regex untuk nomor handphone, etc).
   * Server-side wajib melakukan validasi data dari pengguna untuk memastikan integritas data (data unik, keberadaan data, logika, etc).
12. Implementasikan error handling untuk memberikan umpan balik yang informatif kepada pengguna.
13. Responsivitas
   * Implementasikan minimal satu halaman yang responsif (minimal untuk ukuran 1280 x 768 dan 400 x 800). Artinya, tampilan mungkin berubah menyesuaikan ukuran layar.

### BONUS
1. All Responsive Web Design,
   Semua tampilan dibuat responsif (minimal untuk ukuran 1280 x 768 dan 400 x 800). Artinya, tampilan mungkin berubah menyesuaikan ukuran layar. Hint: gunakan CSS @media rule, lebih lanjut: https://www.w3schools.com/css/css_rwd_mediaqueries.asp.
3. Docker,
   Membuat Dockerfile dari aplikasi kalian, serta membuat file docker-compose.yml dari aplikasi kalian yang berisi aplikasi kalian serta database yang digunakan. Tujuan bonus ini adalah agar kalian dapat mendapatkan pengalaman hands-on menggunakan Docker. Bonus ini juga mempermudah pengerjaan untuk milestone selanjutnya.
4. Google Lighthouse,
   Google Lighthouse adalah alat otomatis open-source untuk meningkatkan kualitas halaman web. Lighthouse dipakai sebagai alat pengukuran dan audit untuk performance kualitas website, aksesibilitas, aplikasi web progresif, dan banyak lagi. Tugas anda adalah melakukan pengecekan skor di Lighthouse untuk seluruh halaman dan pastikan bahwa skor untuk best practices, aksesibilitas yang didapatkan memiliki nilai di atas 90 dan performance yang didapatkan memiliki nilai di atas 80. Lampirkan bukti tangkapan layar pada README.


## Cara Instalasi
* _clone repository_ ini dengan `git clone https://github.com/frankiehuangg/IF3110-Tubes-1.git`
* _install_ docker pada desktop anda

## Cara Menjalankan Aplikasi
* pada _root repository_ yang sudah di-_clone_, lakukan _command_ `docker build . -t tubes-1:latest`
* setelah selesai lakukan `docker compose up`
* jika sudah selesai, lakukan _ctrl + c_ dan `docker compose down`

## Screebshots

## Pembagian Tugas
| Nama                      | NIM        | Tugas                                          |
|---------------------------|------------|------------------------------------------------|
| Hosea Nathanael Abednego  | 13521057   | Login, Register, Forget Password, User Reports |   
| Christian Albert Hasiholan| 13521078   | Sidebar, Searchbar, Page, Post, Like, Database |  
| Frankie Huang             | 13521092   | Router, PageCard, Home, BaseClass, API, Searching, Debounce | 

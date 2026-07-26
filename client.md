Konsep Aplikasi Pengajar Tahsin Offline Privat

Tujuan

Membuat aplikasi yang sederhana, mudah digunakan oleh pengajar dan admin, serta mengikuti alur kerja yang sudah berjalan di Tahsindarirumah.id.

Alur utama:
Pengajar → Presensi → Evaluasi → Mukafaah

---

1. Dashboard

Dashboard Admin

Menampilkan ringkasan:

- Jumlah pengajar aktif
- Jumlah santri aktif
- Jadwal mengajar hari ini
- Santri yang sedang berjalan
- Santri yang menunggu evaluasi
- Santri yang sudah selesai evaluasi
- Mukafaah yang siap diproses bulan ini

Dashboard Pengajar

Menampilkan:

- Nama pengajar
- Jumlah santri yang diampu
- Jadwal mengajar hari ini
- Santri yang perlu diisi presensinya
- Santri yang harus dibuatkan evaluasi

---

2. Data Pengajar

Setelah memilih nama pengajar, tampil daftar santri yang diampu beserta:

- Nama santri
- Hari & jam mengajar
- Paket kelas (4x, 8x, 12x, dst.)
- Progress pertemuan (misal 2/4, 5/8)

---

3. Presensi

Setiap selesai mengajar, pengajar mengisi:

- Tanggal pertemuan
- Kehadiran (Hadir / Reschedule / Libur)
- Catatan singkat (opsional)

Jumlah presensi otomatis mengikuti paket yang diambil.

Contoh paket 4x:

- Pertemuan 1 ✅
- Pertemuan 2 ✅
- Pertemuan 3 ✅
- Pertemuan 4 ⬜

Progress akan bertambah otomatis sesuai jumlah presensi yang telah diisi.

---

4. Evaluasi

Jika seluruh pertemuan dalam paket telah selesai (misalnya 4/4 atau 8/8), aplikasi otomatis menampilkan notifikasi:

«"Paket pembelajaran telah selesai. Silakan isi evaluasi terlebih dahulu."»

Form evaluasi berisi:

- Perkembangan bacaan
- Makhraj
- Tajwid
- Catatan pengajar
- Saran latihan

Setelah evaluasi dikirim, status berubah menjadi Evaluasi Selesai.

---

5. Mukafaah

Mukafaah hanya dapat diproses jika:

- Seluruh presensi telah lengkap.
- Evaluasi telah diisi.

Apabila evaluasi belum dibuat, data belum masuk ke daftar mukafaah.

---

6. Status Santri

Setiap santri memiliki status:

- Sedang Berjalan → Paket masih berlangsung.
- Menunggu Evaluasi → Seluruh presensi selesai, evaluasi belum diisi.
- Selesai → Evaluasi telah diisi dan siap diproses untuk mukafaah.

---

Alur Aplikasi

Dashboard
↓
Pilih Pengajar
↓
Pilih Santri
↓
Isi Presensi setiap pertemuan
↓
Paket selesai (4x/8x/12x)
↓
Wajib isi Evaluasi
↓
Masuk Perhitungan Mukafaah

Catatan

Aplikasi dibuat sederhana, cepat digunakan, dan fokus membantu operasional pengajar serta admin tanpa fitur yang berlebihan.
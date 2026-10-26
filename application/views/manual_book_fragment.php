<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Konten manual book (dibundel untuk PDF & ekspor Word).
 * Variabel: $presensi_url, $is_admin_menu, $nama_app, $deskripsi, $satker, $tanggal_cetak
 */
$nama_app = isset($nama_app) ? $nama_app : '';
$deskripsi = isset($deskripsi) ? $deskripsi : '';
$satker = isset($satker) ? $satker : '';
$tanggal_cetak = isset($tanggal_cetak) ? $tanggal_cetak : date('d/m/Y');
$is_admin_menu = !empty($is_admin_menu);
?>
<h1>Manual Book — <?= htmlspecialchars($nama_app ?: 'LEUMANG', ENT_QUOTES, 'UTF-8') ?></h1>
<p style="font-size:10pt;color:#555;"><?= htmlspecialchars($deskripsi, ENT_QUOTES, 'UTF-8') ?><?php if ($satker): ?> · <?= htmlspecialchars($satker, ENT_QUOTES, 'UTF-8') ?><?php endif; ?></p>
<p style="font-size:9pt;color:#888;">Dicetak / diekspor: <?= htmlspecialchars($tanggal_cetak, ENT_QUOTES, 'UTF-8') ?></p>

<h2>Pengantar</h2>
<p><strong>LEUMANG</strong> (Aplikasi Manajemen Untuk Mahasiswa Magang) memiliki dua jalur penggunaan utama:</p>
<ul>
    <li><strong>Panel pengelolaan</strong> — untuk pegawai yang masuk melalui <strong>SSO</strong> (single sign-on), untuk mendaftarkan peserta, laporan, koreksi presensi, dan unduh rekap.</li>
    <li><strong>Halaman presensi mahasiswa</strong> — diakses <strong>tanpa</strong> login SSO; mahasiswa membuka alamat khusus, memilih nama, memverifikasi lokasi, dan mengambil foto.</li>
</ul>
<p style="font-size:9pt;">Administrator dapat membagikan <strong>Bagian B</strong> kepada mahasiswa sebagai lembar panduan. Kotak putus-putus di dokumen ini adalah <strong>tempat menempel screenshot</strong> — ganti dengan gambar di Word, atau di editor PDF Anda.</p>
<div style="border:1px dashed #999;padding:12px;margin:10px 0;min-height:60px;color:#666;font-style:italic;font-size:9pt;">[Screenshot opsional — contoh: tampilan beranda / logo aplikasi]</div>

<h2>Bagian A — Administrator &amp; Tim Pengelola</h2>
<p style="font-size:10pt;color:#555;">Untuk pengguna yang masuk dengan akun SSO dan memiliki peran yang diizinkan.</p>

<h3>A.1 Login, akses, dan keamanan sesi</h3>
<ol>
    <li>Buka URL aplikasi magang yang disediakan institusi.</li>
    <li>Jika belum login ke SSO, Anda akan diarahkan ke halaman <strong>login SSO</strong>.</li>
    <li>Setelah login berhasil, sesi aplikasi terisi; pastikan tidak membagikan perangkat yang masih aktif sesi pegawai.</li>
    <li>Sesi dicek berkala; jika token SSO tidak valid, lakukan login ulang sesuai petunjuk di layar.</li>
    <li>Hanya peran tertentu (misalnya <em>super</em>, <em>validator</em> terkait, <em>admin satker</em>) yang dapat mengakses modul ini.</li>
</ol>
<div style="border:1px dashed #999;padding:12px;margin:10px 0;min-height:70px;color:#666;font-style:italic;font-size:9pt;">[Screenshot — halaman login SSO atau redirect]</div>

<h3>A.2 Dashboard</h3>
<p>Dari menu <strong>Dashboard</strong> Anda dapat melihat ringkasan: total peserta, peserta aktif, indikator presensi hari ini (masuk, pulang, belum presensi), dan grafik tren presensi beberapa hari terakhir.</p>
<div style="border:1px dashed #999;padding:12px;margin:10px 0;min-height:70px;color:#666;font-style:italic;font-size:9pt;">[Screenshot — dashboard dengan kartu statistik / grafik]</div>

<h3>A.3 Manajemen peserta magang</h3>
<p><strong>Menu:</strong> Manajemen Peserta Magang</p>
<p><strong>Menambah peserta baru:</strong> klik <strong>Tambah Peserta Magang</strong>, isi NIM, nama, perguruan tinggi, program studi, handphone, status (aktif/tidak aktif), lalu simpan.</p>
<p><strong>Mengubah data:</strong> gunakan tombol edit pada baris peserta di tabel.</p>
<p><strong>Reset perangkat presensi:</strong> jika mahasiswa mengganti perangkat atau cookie dihapus, gunakan <strong>Reset Perangkat</strong> pada baris peserta. Setelah reset, mahasiswa mendaftarkan perangkat lagi saat presensi pertama.</p>
<div style="border:1px dashed #999;padding:12px;margin:10px 0;min-height:70px;color:#666;font-style:italic;font-size:9pt;">[Screenshot — daftar peserta / modal tambah-edit peserta]</div>

<h3>A.4 Laporan presensi, koreksi, dan unduh PDF</h3>
<p><strong>Menu:</strong> Laporan → Presensi</p>
<ol>
    <li>Pilih <strong>tanggal</strong>, klik <strong>Cari Presensi</strong> untuk memuat tabel.</li>
    <li><strong>Koreksi / input manual:</strong> klik nama peserta, atur jam masuk/pulang dan keterangan, simpan.</li>
    <li><strong>Foto presensi:</strong> gunakan indikator jam masuk/pulang yang dapat diklik untuk melihat foto (jika ada).</li>
    <li><strong>Unduh rekap:</strong> gunakan tombol cetak/unduh presensi, atur rentang tanggal dan peserta, unduh <strong>PDF</strong>.</li>
</ol>
<div style="border:1px dashed #999;padding:12px;margin:10px 0;min-height:70px;color:#666;font-style:italic;font-size:9pt;">[Screenshot — tabel laporan presensi / dialog cetak PDF]</div>

<h3>A.5 Keluar aplikasi</h3>
<p>Gunakan menu logout untuk mengakhiri sesi dan mengarahkan ke halaman keluar SSO pada perangkat bersama.</p>

<?php if ($is_admin_menu): ?>
<h3>A.6 Dokumentasi teknis (admin)</h3>
<p>Menu <strong>Dokumentasi Teknis</strong> (jika tampil di sidebar) untuk referensi teknis tambahan.</p>
<div style="border:1px dashed #999;padding:12px;margin:10px 0;min-height:50px;color:#666;font-style:italic;font-size:9pt;">[Screenshot — menu dokumentasi teknis]</div>
<?php endif; ?>

<h2>Bagian B — Mahasiswa Magang (Pengguna Presensi)</h2>
<p>Mahasiswa <strong>tidak</strong> login SSO untuk presensi.</p>
<p><strong>Alamat presensi:</strong><br /><code style="font-size:10pt;"><?= htmlspecialchars($presensi_url, ENT_QUOTES, 'UTF-8') ?></code></p>

<h3>B.1 Apa yang perlu disiapkan</h3>
<ul>
    <li>Perangkat dengan <strong>kamera</strong> dan <strong>internet</strong> stabil.</li>
    <li><strong>GPS / lokasi</strong> aktif; izinkan browser mengakses lokasi.</li>
    <li>Terdaftar oleh administrator sebagai peserta aktif (nama muncul di daftar).</li>
</ul>
<div style="border:1px dashed #999;padding:12px;margin:10px 0;min-height:60px;color:#666;font-style:italic;font-size:9pt;">[Screenshot — halaman utama presensi]</div>

<h3>B.2 Alur presensi (masuk &amp; pulang)</h3>
<ol>
    <li>Buka alamat presensi di browser.</li>
    <li>Buka form presensi (misalnya tombol Presensi Kehadiran).</li>
    <li>Tunggu peta/lokasi sesuai aturan institusi.</li>
    <li>Pilih nama pada daftar peserta.</li>
    <li>Ambil foto diri, lalu simpan presensi.</li>
</ol>
<p><strong>Aturan waktu (sesuai sistem):</strong> presensi pada jam sebelum atau sama dengan <strong>12:00</strong> dicatat sebagai <strong>masuk</strong>. Setelah ada catatan harian, presensi berikutnya setelah 12:00 mencatat <strong>pulang</strong>. Tidak dapat mengulang presensi masuk di hari yang sama jika kedatangan sudah tercatat.</p>
<div style="border:1px dashed #999;padding:12px;margin:10px 0;min-height:70px;color:#666;font-style:italic;font-size:9pt;">[Screenshot — modal presensi: peta, pilih nama, kamera]</div>

<h3>B.3 Lokasi tidak valid atau peta tidak muncul</h3>
<ul>
    <li>Aktifkan izin lokasi untuk browser; berada di area yang ditetapkan.</li>
    <li>Perkuat sinyal GPS; muat ulang halaman.</li>
    <li>Lapor petugas — admin dapat koreksi presensi manual.</li>
</ul>

<h3>B.4 Pendaftaran perangkat</h3>
<p>Pada pertama kali atau setelah reset admin, konfirmasi <strong>pendaftaran perangkat</strong>. Satu peserta biasanya terikat satu perangkat; ganti HP memerlukan <strong>reset</strong> oleh administrator.</p>
<div style="border:1px dashed #999;padding:12px;margin:10px 0;min-height:50px;color:#666;font-style:italic;font-size:9pt;">[Screenshot — dialog daftar perangkat / konfirmasi]</div>

<h3>B.5 FAQ singkat</h3>
<p><strong>Lupa presensi masuk?</strong> Minta admin mencatat lewat koreksi presensi.</p>
<p><strong>Kamera tidak terbuka?</strong> Beri izin kamera pada browser; refresh halaman.</p>
<p><strong>Nama tidak ada di daftar?</strong> Pastikan admin mendaftarkan Anda dan status aktif.</p>
<p><strong>Ganti handphone?</strong> Minta admin <em>reset perangkat</em>, lalu daftar perangkat baru.</p>

<p style="margin-top:20px;font-size:9pt;color:#666;"><em>Kebijakan jam kerja, area presensi, dan sanksi mengikuti aturan masing-masing institusi.</em></p>

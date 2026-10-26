<?php
$presensi_url = site_url('presensi');
$role = $this->session->userdata('role');
$peran = $this->session->userdata('peran');
$is_admin_menu = ($peran == 'admin' || in_array($role, ['super', 'validator_uk_satker', 'admin_satker']));
?>
<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3"><?= $this->session->userdata('nama_client_app') ?></div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;" data-page="dashboard"><i
                                    class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Panduan Penggunaan</li>
                    </ol>
                </nav>
            </div>
        </div>
        <h6 class="mb-0 text-uppercase">Panduan Penggunaan &amp; Manual Book</h6>
        <p class="text-muted mb-3">Dokumen ini menjelaskan penggunaan aplikasi dari sisi <strong>administrator / tim pengelola</strong> dan <strong>mahasiswa magang</strong> (pengguna halaman presensi).</p>

        <div class="card border shadow-none mb-4">
            <div class="card-body">
                <h6 class="mb-2"><i class="bx bx-download me-1"></i>Unduh manual untuk ditambah screenshot</h6>
                <p class="small text-muted mb-3">Gunakan berkas <strong>Word</strong> untuk menempel gambar di kotak yang disediakan, lalu simpan sebagai <strong>.docx</strong> atau ekspor <strong>PDF</strong> dari Word. Berkas <strong>PDF</strong> di bawah adalah versi siap cetak dengan kotak penanda (bisa digabung dengan PDF lain jika perlu).</p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="<?= site_url('unduh_manual_word') ?>" class="btn btn-primary px-4" target="_blank" rel="noopener">
                        <i class="bx bxs-file-doc me-1"></i>Unduh Word (.doc)
                    </a>
                    <a href="<?= site_url('unduh_manual_pdf') ?>" class="btn btn-outline-danger px-4" target="_blank" rel="noopener">
                        <i class="bx bxs-file-pdf me-1"></i>Unduh PDF
                    </a>
                </div>
            </div>
        </div>

        <hr />

        <!-- Pengantar -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-primary border-opacity-25">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bx bx-book-reader me-2 text-primary"></i>Pengantar</h5>
                        <p class="mb-2"><strong>LEUMANG</strong> (Aplikasi Manajemen Untuk Mahasiswa Magang) terdiri dari dua jalur penggunaan utama:</p>
                        <ul class="mb-0">
                            <li><strong>Panel pengelolaan</strong> — untuk pegawai yang masuk melalui <strong>SSO</strong> (single sign-on). Digunakan untuk mendaftarkan peserta, melihat laporan, mengoreksi presensi, dan mengunduh rekap.</li>
                            <li><strong>Halaman presensi mahasiswa</strong> — diakses <strong>tanpa</strong> login SSO; mahasiswa membuka alamat khusus (biasanya dipasang di perangkat kiosk/tablet), memilih nama, memverifikasi lokasi, dan mengambil foto.</li>
                        </ul>
                        <p class="mt-3 mb-0 small text-muted">Administrator dapat mencetak atau membagikan <strong>Bagian B</strong> kepada mahasiswa magang sebagai lembar panduan.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian A: Administrator -->
        <div class="row mb-2">
            <div class="col-12">
                <h5 class="text-primary"><i class="bx bx-shield-quarter me-2"></i>Bagian A — Administrator &amp; Tim Pengelola</h5>
                <p class="text-muted small mb-3">Untuk pengguna yang masuk dengan akun SSO dan memiliki peran yang diizinkan mengakses aplikasi ini.</p>
            </div>
        </div>

        <div class="accordion mb-5" id="accordionAdmin">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#adm1">
                        A.1 Login, akses, dan keamanan sesi
                    </button>
                </h2>
                <div id="adm1" class="accordion-collapse collapse show" data-bs-parent="#accordionAdmin">
                    <div class="accordion-body">
                        <ol>
                            <li>Buka URL aplikasi magang yang disediakan institusi.</li>
                            <li>Jika belum login ke SSO, Anda akan diarahkan ke halaman <strong>login SSO</strong>.</li>
                            <li>Setelah login berhasil, sesi aplikasi terisi; pastikan tidak membagikan perangkat yang masih aktif sesi pegawai.</li>
                            <li>Sesi dicek berkala; jika token SSO tidak valid, lakukan login ulang sesuai petunjuk di layar.</li>
                            <li>Hanya peran tertentu (misalnya <em>super</em>, <em>validator</em> terkait, <em>admin satker</em>) yang dapat mengakses modul ini — pengguna lain akan diarahkan kembali ke portal SSO.</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#adm2">
                        A.2 Dashboard
                    </button>
                </h2>
                <div id="adm2" class="accordion-collapse collapse" data-bs-parent="#accordionAdmin">
                    <div class="accordion-body">
                        <p>Dari menu <strong>Dashboard</strong> Anda dapat melihat ringkasan:</p>
                        <ul>
                            <li>Total peserta, peserta aktif, dan indikator presensi hari ini (masuk, pulang, belum presensi).</li>
                            <li>Grafik tren presensi beberapa hari terakhir (sesuai implementasi di layar).</li>
                        </ul>
                        <p class="mb-0">Gunakan dashboard untuk pemantauan cepat kehadiran harian.</p>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#adm3">
                        A.3 Manajemen peserta magang
                    </button>
                </h2>
                <div id="adm3" class="accordion-collapse collapse" data-bs-parent="#accordionAdmin">
                    <div class="accordion-body">
                        <p><strong>Menu:</strong> <em>Manajemen Peserta Magang</em></p>
                        <h6 class="mt-3">Menambah peserta baru</h6>
                        <ol>
                            <li>Klik <strong>Tambah Peserta Magang</strong>.</li>
                            <li>Isi: NIM, nama, nama perguruan tinggi, program studi, nomor handphone, dan status (aktif / tidak aktif).</li>
                            <li>Simpan. Data akan digunakan untuk daftar presensi dan token perangkat.</li>
                        </ol>
                        <h6 class="mt-3">Mengubah data peserta</h6>
                        <ol>
                            <li>Pada tabel, gunakan tombol edit pada baris peserta yang bersangkutan.</li>
                            <li>Perbarui field yang diperlukan lalu simpan.</li>
                        </ol>
                        <h6 class="mt-3">Reset perangkat presensi</h6>
                        <ol>
                            <li>Jika mahasiswa mengganti HP/tablet atau cookie dihapus, gunakan fitur <strong>Reset Perangkat</strong> pada baris peserta (ikon sesuai tampilan).</li>
                            <li>Setelah reset, mahasiswa harus mendaftarkan perangkat lagi saat pertama kali presensi (lihat Bagian B).</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#adm4">
                        A.4 Laporan presensi, koreksi, dan unduh PDF
                    </button>
                </h2>
                <div id="adm4" class="accordion-collapse collapse" data-bs-parent="#accordionAdmin">
                    <div class="accordion-body">
                        <p><strong>Menu:</strong> <em>Laporan → Presensi</em></p>
                        <h6>Melihat presensi per tanggal</h6>
                        <ol>
                            <li>Pilih <strong>tanggal</strong> yang ingin ditinjau.</li>
                            <li>Klik <strong>Cari Presensi</strong> (atau tombol setara) untuk memuat tabel kehadiran.</li>
                        </ol>
                        <h6 class="mt-3">Mengoreksi / input manual</h6>
                        <ol>
                            <li>Klik pada nama peserta (atau baris yang disediakan) untuk membuka form pengeditan.</li>
                            <li>Atur jam masuk dan/atau jam pulang, serta <strong>keterangan</strong> (misalnya manual, izin, sakit) sesuai kebijakan institusi.</li>
                            <li>Simpan. Koreksi ini berguna jika mahasiswa lupa presensi atau terjadi kesalahan teknis.</li>
                        </ol>
                        <h6 class="mt-3">Melihat foto presensi</h6>
                        <ol>
                            <li>Pada tabel, gunakan indikator jam masuk/pulang yang dapat diklik untuk membuka foto yang tersimpan (jika ada).</li>
                        </ol>
                        <h6 class="mt-3">Mencetak / mengunduh laporan</h6>
                        <ol>
                            <li>Gunakan tombol cetak/unduh presensi (misalnya <strong>Cetak Presensi</strong>).</li>
                            <li>Atur rentang tanggal dan filter peserta sesuai dialog.</li>
                            <li>Unduh berkas <strong>PDF</strong> untuk arsip atau laporan formal.</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#adm5">
                        A.5 Keluar aplikasi
                    </button>
                </h2>
                <div id="adm5" class="accordion-collapse collapse" data-bs-parent="#accordionAdmin">
                    <div class="accordion-body">
                        <p>Gunakan menu/logout aplikasi untuk mengakhiri sesi dan mengarahkan ke halaman keluar SSO, sehingga akun tidak tertinggal aktif di perangkat bersama.</p>
                    </div>
                </div>
            </div>

            <?php if ($is_admin_menu): ?>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#adm6">
                        A.6 Dokumentasi teknis (admin)
                    </button>
                </h2>
                <div id="adm6" class="accordion-collapse collapse" data-bs-parent="#accordionAdmin">
                    <div class="accordion-body">
                        <p>Menu <strong>Dokumentasi Teknis</strong> (jika tampil di sidebar) diperuntukkan bagi administrator untuk referensi teknis tambahan. Pengguna tanpa hak akses tidak akan melihat menu ini.</p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Bagian B: Mahasiswa -->
        <div class="row mb-2">
            <div class="col-12">
                <h5 class="text-success"><i class="bx bx-user-pin me-2"></i>Bagian B — Mahasiswa Magang (Pengguna Presensi)</h5>
                <p class="text-muted small mb-3">Mahasiswa <strong>tidak</strong> login ke SSO untuk presensi. Gunakan alamat khusus berikut (simpan atau cetak):</p>
                <div class="alert alert-light border mb-3">
                    <strong>Alamat presensi:</strong><br />
                    <code class="user-select-all"><?= htmlspecialchars($presensi_url, ENT_QUOTES, 'UTF-8') ?></code>
                </div>
            </div>
        </div>

        <div class="accordion mb-4" id="accordionMhs">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#mhs1">
                        B.1 Apa yang perlu disiapkan
                    </button>
                </h2>
                <div id="mhs1" class="accordion-collapse collapse show" data-bs-parent="#accordionMhs">
                    <div class="accordion-body">
                        <ul>
                            <li>Perangkat dengan <strong>kamera</strong> dan <strong>internet</strong> yang stabil.</li>
                            <li><strong>GPS / lokasi</strong> diaktifkan; izinkan browser mengakses lokasi saat diminta.</li>
                            <li>Anda sudah terdaftar sebagai peserta magang oleh administrator (nama Anda muncul di daftar pilihan).</li>
                            <li>Status peserta harus <strong>aktif</strong> agar dapat dipilih untuk presensi.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mhs2">
                        B.2 Alur presensi (masuk &amp; pulang)
                    </button>
                </h2>
                <div id="mhs2" class="accordion-collapse collapse" data-bs-parent="#accordionMhs">
                    <div class="accordion-body">
                        <ol>
                            <li>Buka alamat presensi di atas menggunakan browser (disarankan di perangkat yang ditetapkan institusi).</li>
                            <li>Klik tombol untuk membuka form presensi (misalnya <strong>Presensi Kehadiran</strong>).</li>
                            <li>Tunggu peta/lokasi menunjukkan posisi Anda sesuai aturan institusi.</li>
                            <li>Pilih <strong>nama Anda</strong> pada daftar peserta.</li>
                            <li>Ambil <strong>foto diri</strong> melalui kamera sesuai petunjuk di layar.</li>
                            <li>Kirim / simpan presensi.</li>
                        </ol>
                        <div class="alert alert-info mb-0">
                            <strong>Aturan waktu (sesuai sistem):</strong>
                            <ul class="mb-0 mt-2">
                                <li>Presensi yang dicatat pada jam sebelum atau sama dengan <strong>12:00</strong> dianggap sebagai <strong>presensi masuk</strong> (kedatangan).</li>
                                <li>Setelah ada catatan harian, presensi berikutnya pada jam <strong>setelah 12:00</strong> akan mencatat <strong>pulang</strong>.</li>
                                <li>Anda tidak dapat mengulang presensi masuk di hari yang sama jika kedatangan sudah tercatat.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mhs3">
                        B.3 Lokasi tidak valid atau peta tidak muncul
                    </button>
                </h2>
                <div id="mhs3" class="accordion-collapse collapse" data-bs-parent="#accordionMhs">
                    <div class="accordion-body">
                        <ul>
                            <li>Pastikan izin <strong>lokasi</strong> untuk browser sudah diaktifkan.</li>
                            <li>Berada di area yang ditetapkan institusi (pembatasan area mengacu pada pengaturan server).</li>
                            <li>Coba muat ulang halaman; pastikan sinyal GPS kuat (bukan mode pesawat).</li>
                            <li>Jika tetap gagal, lapor ke petugas — administrator dapat melakukan <strong>koreksi presensi manual</strong>.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mhs4">
                        B.4 Pendaftaran perangkat (satu perangkat per peserta)
                    </button>
                </h2>
                <div id="mhs4" class="accordion-collapse collapse" data-bs-parent="#accordionMhs">
                    <div class="accordion-body">
                        <p>Pada penggunaan pertama atau setelah reset oleh admin, sistem dapat meminta konfirmasi untuk <strong>mendaftarkan perangkat</strong>. Setuju hanya pada perangkat yang akan dipakai untuk presensi magang.</p>
                        <ul>
                            <li>Satu peserta terikat pada satu pola token perangkat — mengganti HP biasanya memerlukan <strong>reset</strong> oleh administrator.</li>
                            <li>Hindari menghapus data browser/cookie jika tidak perlu, agar tidak harus mendaftar ulang.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mhs5">
                        B.5 FAQ mahasiswa
                    </button>
                </h2>
                <div id="mhs5" class="accordion-collapse collapse" data-bs-parent="#accordionMhs">
                    <div class="accordion-body">
                        <p><strong>Q: Saya lupa presensi masuk, bagaimana?</strong><br />
                        A: Minta tolong petugas/admin untuk mencatatkan melalui fitur koreksi presensi di panel pengelola.</p>
                        <p><strong>Q: Kamera tidak bisa dibuka?</strong><br />
                        A: Berikan izin kamera pada browser; tutup aplikasi lain yang memakai kamera; coba refresh halaman.</p>
                        <p><strong>Q: Nama saya tidak ada di daftar?</strong><br />
                        A: Pastikan administrator sudah mendaftarkan Anda dan status peserta <em>aktif</em>.</p>
                        <p><strong>Q: Ganti handphone?</strong><br />
                        A: Hubungi admin untuk <em>reset perangkat</em>, lalu daftarkan perangkat baru saat presensi berikutnya.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-light">
            <div class="card-body py-3">
                <p class="mb-0 small text-muted"><i class="bx bx-info-circle me-1"></i>Isi panduan mengikuti fitur yang tersedia di aplikasi. Kebijakan jam kerja, area presensi, dan sanksi kehadiran mengikuti aturan masing-masing institusi.</p>
            </div>
        </div>
    </div>
</div>

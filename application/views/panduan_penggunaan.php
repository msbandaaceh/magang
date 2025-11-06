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
        <h6 class="mb-0 text-uppercase">Panduan Penggunaan Sistem</h6>
        <hr />
        
        <?php
        $role = $this->session->userdata('role');
        $peran = $this->session->userdata('peran');
        
        // Tentukan jenis pengguna
        $is_admin = ($peran == 'admin' || in_array($role, ['super', 'validator_uk_satker', 'admin_satker']));
        $is_operator = ($role == 'operator' || $role == 'petugas');
        $is_pegawai = (!$is_admin && !$is_operator);
        ?>
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bx bx-book-open me-2"></i>Panduan Penggunaan</h5>
                    </div>
                    <div class="card-body">
                        <?php if ($is_admin): ?>
                            <!-- Panduan untuk Admin -->
                            <div class="alert alert-info">
                                <h6><i class="bx bx-info-circle me-2"></i>Panduan untuk Administrator</h6>
                            </div>
                            
                            <div class="accordion" id="accordionAdmin">
                                <!-- Manajemen Peserta Magang -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                                            <i class="bx bx-user me-2"></i>Manajemen Peserta Magang
                                        </button>
                                    </h2>
                                    <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#accordionAdmin">
                                        <div class="accordion-body">
                                            <h6>Menambah Peserta Magang Baru:</h6>
                                            <ol>
                                                <li>Klik menu <strong>"Manajemen Peserta Magang"</strong> di sidebar</li>
                                                <li>Klik tombol <strong>"Tambah Peserta Magang"</strong> di pojok kanan atas</li>
                                                <li>Isi form dengan data peserta:
                                                    <ul>
                                                        <li>NIM Peserta Magang (wajib)</li>
                                                        <li>Nama Peserta Magang (wajib)</li>
                                                        <li>Nama Perguruan Tinggi (wajib)</li>
                                                        <li>Nama Program Studi (wajib)</li>
                                                        <li>Nomor Handphone (wajib)</li>
                                                        <li>Status Peserta (Aktif/Tidak Aktif)</li>
                                                    </ul>
                                                </li>
                                                <li>Klik <strong>"Simpan"</strong> untuk menyimpan data</li>
                                            </ol>
                                            
                                            <h6 class="mt-3">Mengedit Data Peserta:</h6>
                                            <ol>
                                                <li>Pada tabel peserta, klik tombol <strong>"Edit"</strong> (ikon pensil) pada baris peserta yang ingin diedit</li>
                                                <li>Ubah data yang diperlukan</li>
                                                <li>Klik <strong>"Simpan"</strong> untuk menyimpan perubahan</li>
                                            </ol>
                                            
                                            <h6 class="mt-3">Melihat Detail Peserta:</h6>
                                            <ol>
                                                <li>Klik tombol <strong>"Lihat Detail"</strong> (ikon mata) pada baris peserta</li>
                                                <li>Informasi lengkap peserta akan ditampilkan</li>
                                            </ol>
                                            
                                            <h6 class="mt-3">Reset Perangkat Peserta:</h6>
                                            <ol>
                                                <li>Klik tombol <strong>"Reset Perangkat"</strong> (ikon reset) pada baris peserta</li>
                                                <li>Konfirmasi reset perangkat</li>
                                                <li>Peserta harus mendaftarkan ulang perangkat untuk presensi</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Laporan Presensi -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading2">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                            <i class="bx bx-file me-2"></i>Laporan Presensi
                                        </button>
                                    </h2>
                                    <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#accordionAdmin">
                                        <div class="accordion-body">
                                            <h6>Melihat Laporan Presensi:</h6>
                                            <ol>
                                                <li>Klik menu <strong>"Laporan" > "Presensi"</strong> di sidebar</li>
                                                <li>Pilih tanggal presensi yang ingin dilihat</li>
                                                <li>Klik tombol <strong>"Cari Presensi"</strong></li>
                                                <li>Data presensi akan ditampilkan dalam tabel</li>
                                            </ol>
                                            
                                            <h6 class="mt-3">Mengedit Presensi:</h6>
                                            <ol>
                                                <li>Klik pada nama peserta di tabel presensi</li>
                                                <li>Form edit akan muncul dengan data presensi saat ini</li>
                                                <li>Ubah jam datang atau jam pulang sesuai kebutuhan</li>
                                                <li>Pilih keterangan jika diperlukan</li>
                                                <li>Klik <strong>"Simpan"</strong> untuk menyimpan perubahan</li>
                                            </ol>
                                            
                                            <h6 class="mt-3">Melihat Foto Presensi:</h6>
                                            <ol>
                                                <li>Klik pada badge jam datang atau jam pulang di tabel</li>
                                                <li>Foto presensi akan ditampilkan dalam modal</li>
                                            </ol>
                                            
                                            <h6 class="mt-3">Mencetak/Unduh Laporan Presensi:</h6>
                                            <ol>
                                                <li>Klik tombol <strong>"Cetak Presensi"</strong> di pojok kanan atas</li>
                                                <li>Pilih tanggal awal dan tanggal akhir</li>
                                                <li>Pilih peserta magang yang ingin dicetak</li>
                                                <li>Klik <strong>"Unduh"</strong> untuk mengunduh laporan dalam format PDF</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Tips dan Trik -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading3">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                            <i class="bx bx-lightbulb me-2"></i>Tips dan Trik
                                        </button>
                                    </h2>
                                    <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#accordionAdmin">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>Pastikan data peserta sudah lengkap sebelum mengaktifkan status</li>
                                                <li>Gunakan fitur reset perangkat jika peserta mengganti perangkat</li>
                                                <li>Lakukan backup data secara berkala</li>
                                                <li>Periksa laporan presensi secara rutin untuk memastikan akurasi data</li>
                                                <li>Gunakan fitur pencarian untuk menemukan data dengan cepat</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        <?php elseif ($is_operator): ?>
                            <!-- Panduan untuk Operator/Petugas -->
                            <div class="alert alert-warning">
                                <h6><i class="bx bx-info-circle me-2"></i>Panduan untuk Operator/Petugas</h6>
                            </div>
                            
                            <div class="accordion" id="accordionOperator">
                                <!-- Presensi Peserta -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOp1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOp1">
                                            <i class="bx bx-check-circle me-2"></i>Melakukan Presensi untuk Peserta
                                        </button>
                                    </h2>
                                    <div id="collapseOp1" class="accordion-collapse collapse show" data-bs-parent="#accordionOperator">
                                        <div class="accordion-body">
                                            <h6>Langkah-langkah Presensi:</h6>
                                            <ol>
                                                <li>Pastikan Anda berada di dalam area presensi yang ditentukan</li>
                                                <li>Buka aplikasi presensi di perangkat yang sudah terdaftar</li>
                                                <li>Pilih peserta magang yang akan melakukan presensi</li>
                                                <li>Aktifkan kamera dan ambil foto diri</li>
                                                <li>Pastikan lokasi GPS sudah terdeteksi dengan benar</li>
                                                <li>Klik tombol <strong>"Simpan Presensi"</strong></li>
                                                <li>Tunggu konfirmasi bahwa presensi berhasil disimpan</li>
                                            </ol>
                                            
                                            <div class="alert alert-info mt-3">
                                                <strong>Catatan Penting:</strong>
                                                <ul class="mb-0">
                                                    <li>Presensi masuk dapat dilakukan sebelum jam 12:00</li>
                                                    <li>Presensi pulang dapat dilakukan setelah jam 12:00</li>
                                                    <li>Setiap peserta hanya dapat presensi sekali per hari untuk masuk dan pulang</li>
                                                    <li>Pastikan koneksi internet stabil saat melakukan presensi</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Melihat Laporan Presensi -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOp2">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOp2">
                                            <i class="bx bx-list-ul me-2"></i>Melihat Laporan Presensi
                                        </button>
                                    </h2>
                                    <div id="collapseOp2" class="accordion-collapse collapse" data-bs-parent="#accordionOperator">
                                        <div class="accordion-body">
                                            <h6>Melihat Laporan Presensi Harian:</h6>
                                            <ol>
                                                <li>Klik menu <strong>"Laporan" > "Presensi"</strong> di sidebar</li>
                                                <li>Pilih tanggal yang ingin dilihat</li>
                                                <li>Klik tombol <strong>"Cari Presensi"</strong></li>
                                                <li>Data presensi akan ditampilkan dalam tabel</li>
                                            </ol>
                                            
                                            <h6 class="mt-3">Informasi yang Ditampilkan:</h6>
                                            <ul>
                                                <li>Nama peserta magang</li>
                                                <li>Jam datang (jika sudah presensi)</li>
                                                <li>Jam pulang (jika sudah presensi)</li>
                                                <li>Keterangan presensi</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Troubleshooting -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOp3">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOp3">
                                            <i class="bx bx-error-circle me-2"></i>Pemecahan Masalah
                                        </button>
                                    </h2>
                                    <div id="collapseOp3" class="accordion-collapse collapse" data-bs-parent="#accordionOperator">
                                        <div class="accordion-body">
                                            <h6>Masalah yang Sering Terjadi:</h6>
                                            
                                            <div class="mb-3">
                                                <strong>1. Lokasi tidak terdeteksi</strong>
                                                <ul>
                                                    <li>Pastikan GPS perangkat sudah diaktifkan</li>
                                                    <li>Berikan izin akses lokasi pada browser</li>
                                                    <li>Pastikan berada di dalam area presensi yang ditentukan</li>
                                                </ul>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <strong>2. Kamera tidak bisa diakses</strong>
                                                <ul>
                                                    <li>Berikan izin akses kamera pada browser</li>
                                                    <li>Pastikan tidak ada aplikasi lain yang menggunakan kamera</li>
                                                    <li>Refresh halaman dan coba lagi</li>
                                                </ul>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <strong>3. Presensi gagal disimpan</strong>
                                                <ul>
                                                    <li>Periksa koneksi internet</li>
                                                    <li>Pastikan semua field sudah terisi dengan benar</li>
                                                    <li>Hubungi administrator jika masalah berlanjut</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        <?php else: ?>
                            <!-- Panduan untuk Pegawai Biasa -->
                            <div class="alert alert-success">
                                <h6><i class="bx bx-info-circle me-2"></i>Panduan untuk Pegawai</h6>
                            </div>
                            
                            <div class="accordion" id="accordionPegawai">
                                <!-- Melakukan Presensi -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingPeg1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePeg1">
                                            <i class="bx bx-check-circle me-2"></i>Cara Melakukan Presensi
                                        </button>
                                    </h2>
                                    <div id="collapsePeg1" class="accordion-collapse collapse show" data-bs-parent="#accordionPegawai">
                                        <div class="accordion-body">
                                            <h6>Presensi Masuk (Sebelum Jam 12:00):</h6>
                                            <ol>
                                                <li>Buka aplikasi presensi di perangkat yang sudah terdaftar</li>
                                                <li>Pastikan Anda berada di dalam area presensi</li>
                                                <li>Pilih nama Anda dari dropdown peserta</li>
                                                <li>Aktifkan kamera dan ambil foto diri</li>
                                                <li>Pastikan lokasi GPS terdeteksi (akan muncul peta)</li>
                                                <li>Jika lokasi sudah benar, tombol "Simpan Presensi" akan aktif</li>
                                                <li>Klik <strong>"Simpan Presensi"</strong></li>
                                                <li>Tunggu konfirmasi berhasil</li>
                                            </ol>
                                            
                                            <h6 class="mt-3">Presensi Pulang (Setelah Jam 12:00):</h6>
                                            <ol>
                                                <li>Lakukan langkah yang sama seperti presensi masuk</li>
                                                <li>Pastikan Anda sudah melakukan presensi masuk terlebih dahulu</li>
                                                <li>Klik <strong>"Simpan Presensi"</strong></li>
                                            </ol>
                                            
                                            <div class="alert alert-warning mt-3">
                                                <strong>Perhatian:</strong>
                                                <ul class="mb-0">
                                                    <li>Setiap peserta hanya dapat presensi sekali untuk masuk dan sekali untuk pulang per hari</li>
                                                    <li>Jika sudah presensi masuk, tidak bisa presensi masuk lagi di hari yang sama</li>
                                                    <li>Jika sudah presensi pulang, tidak bisa presensi lagi di hari yang sama</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Mendaftarkan Perangkat -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingPeg2">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePeg2">
                                            <i class="bx bx-mobile me-2"></i>Mendaftarkan Perangkat
                                        </button>
                                    </h2>
                                    <div id="collapsePeg2" class="accordion-collapse collapse" data-bs-parent="#accordionPegawai">
                                        <div class="accordion-body">
                                            <h6>Pendaftaran Perangkat Pertama Kali:</h6>
                                            <ol>
                                                <li>Saat pertama kali melakukan presensi, sistem akan meminta pendaftaran perangkat</li>
                                                <li>Klik <strong>"Ya, Simpan!"</strong> untuk mendaftarkan perangkat</li>
                                                <li>Perangkat akan terdaftar dan Anda bisa melakukan presensi</li>
                                                <li>Perangkat yang terdaftar akan tersimpan dalam cookie browser</li>
                                            </ol>
                                            
                                            <div class="alert alert-info mt-3">
                                                <strong>Catatan:</strong>
                                                <ul class="mb-0">
                                                    <li>Setiap peserta hanya bisa menggunakan satu perangkat untuk presensi</li>
                                                    <li>Jika ingin mengganti perangkat, hubungi administrator untuk reset perangkat</li>
                                                    <li>Jangan hapus cookie browser jika ingin tetap menggunakan perangkat yang sama</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- FAQ -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingPeg3">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePeg3">
                                            <i class="bx bx-question-mark me-2"></i>Pertanyaan yang Sering Diajukan (FAQ)
                                        </button>
                                    </h2>
                                    <div id="collapsePeg3" class="accordion-collapse collapse" data-bs-parent="#accordionPegawai">
                                        <div class="accordion-body">
                                            <div class="mb-3">
                                                <strong>Q: Apa yang harus dilakukan jika lupa presensi masuk?</strong>
                                                <p>A: Hubungi operator/petugas atau administrator untuk melakukan input manual presensi.</p>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <strong>Q: Bisa presensi dari luar area yang ditentukan?</strong>
                                                <p>A: Tidak, presensi hanya bisa dilakukan jika Anda berada di dalam area yang sudah ditentukan oleh sistem.</p>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <strong>Q: Bagaimana jika perangkat hilang atau rusak?</strong>
                                                <p>A: Hubungi administrator untuk melakukan reset perangkat, kemudian daftarkan perangkat baru.</p>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <strong>Q: Apakah bisa presensi menggunakan perangkat lain?</strong>
                                                <p>A: Tidak, setiap peserta hanya bisa menggunakan satu perangkat yang sudah terdaftar. Untuk menggunakan perangkat lain, perlu reset perangkat terlebih dahulu.</p>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <strong>Q: Bagaimana jika foto tidak jelas?</strong>
                                                <p>A: Pastikan pencahayaan cukup dan wajah terlihat jelas. Ambil foto ulang jika perlu sebelum menyimpan presensi.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


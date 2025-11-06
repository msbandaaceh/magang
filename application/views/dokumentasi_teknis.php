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
                        <li class="breadcrumb-item active" aria-current="page">Dokumentasi Teknis</li>
                    </ol>
                </nav>
            </div>
        </div>
        <h6 class="mb-0 text-uppercase">Dokumentasi Teknis Sistem</h6>
        <hr />
        
        <?php
        // Double check: hanya admin yang bisa akses
        $role = $this->session->userdata('role');
        $peran = $this->session->userdata('peran');
        $is_admin = ($peran == 'admin' || in_array($role, ['super', 'validator_uk_satker', 'admin_satker']));
        
        if (!$is_admin):
        ?>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger">
                    <h5><i class="bx bx-error-circle me-2"></i>Akses Ditolak</h5>
                    <p>Anda tidak memiliki izin untuk mengakses halaman ini. Halaman ini hanya dapat diakses oleh administrator sistem.</p>
                </div>
            </div>
        </div>
        <?php else: ?>
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0"><i class="bx bx-code-alt me-2"></i>Dokumentasi Teknis - Hanya untuk Administrator</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger">
                            <strong><i class="bx bx-lock me-2"></i>Dokumen Rahasia:</strong> Dokumentasi ini hanya boleh diakses oleh administrator sistem.
                        </div>
                        
                        <div class="accordion" id="accordionTeknis">
                            <!-- Arsitektur Sistem -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTech1">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTech1">
                                        <i class="bx bx-architecture me-2"></i>Arsitektur Sistem
                                    </button>
                                </h2>
                                <div id="collapseTech1" class="accordion-collapse collapse show" data-bs-parent="#accordionTeknis">
                                    <div class="accordion-body">
                                        <h6>Framework dan Teknologi:</h6>
                                        <ul>
                                            <li><strong>Backend Framework:</strong> CodeIgniter 3</li>
                                            <li><strong>Database:</strong> MySQL (melalui API Client)</li>
                                            <li><strong>Frontend:</strong> Bootstrap 5, jQuery, DataTables</li>
                                            <li><strong>Maps:</strong> Leaflet.js dengan OpenStreetMap</li>
                                            <li><strong>Geolocation:</strong> Turf.js untuk validasi polygon</li>
                                            <li><strong>PDF Generation:</strong> DomPDF</li>
                                            <li><strong>Authentication:</strong> SSO (Single Sign-On) Integration</li>
                                        </ul>
                                        
                                        <h6 class="mt-3">Struktur Direktori:</h6>
                                        <pre class="bg-light p-3 rounded">
application/
├── controllers/     # Controller aplikasi
├── models/          # Model database
├── views/           # Template view
├── libraries/       # Library custom (ApiHelper, Pdf, TanggalHelper)
├── config/          # Konfigurasi aplikasi
└── core/            # MY_Controller (base controller)

assets/
├── css/            # Stylesheet
├── js/             # JavaScript files
├── plugins/        # Plugin third-party
└── images/        # Gambar dan assets
                                        </pre>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Konfigurasi Sistem -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTech2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTech2">
                                        <i class="bx bx-cog me-2"></i>Konfigurasi Sistem
                                    </button>
                                </h2>
                                <div id="collapseTech2" class="accordion-collapse collapse" data-bs-parent="#accordionTeknis">
                                    <div class="accordion-body">
                                        <h6>File Konfigurasi Utama:</h6>
                                        <ul>
                                            <li><strong>application/config/config.php:</strong>
                                                <ul>
                                                    <li>Base URL aplikasi</li>
                                                    <li>SSO Server URL</li>
                                                    <li>ID Aplikasi Client</li>
                                                    <li>Session configuration</li>
                                                    <li>Cookie domain settings</li>
                                                </ul>
                                            </li>
                                            <li><strong>application/config/routes.php:</strong> Routing URL</li>
                                            <li><strong>application/config/database.php:</strong> Konfigurasi database (jika ada)</li>
                                        </ul>
                                        
                                        <h6 class="mt-3">Variabel Konfigurasi Penting:</h6>
                                        <pre class="bg-light p-3 rounded">
$config['sso_server'] = 'http://sso.ms-bandaaceh.local/';
$config['id_app'] = '8';
$config['cookie_domain'] = '.ms-bandaaceh.local';
$config['encryption_key'] = 'M4hk4m4h@Bn4';
                                        </pre>
                                        
                                        <div class="alert alert-warning mt-3">
                                            <strong>Peringatan:</strong> Jangan pernah commit encryption key ke repository publik!
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Database Schema -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTech3">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTech3">
                                        <i class="bx bx-data me-2"></i>Struktur Database
                                    </button>
                                </h2>
                                <div id="collapseTech3" class="accordion-collapse collapse" data-bs-parent="#accordionTeknis">
                                    <div class="accordion-body">
                                        <h6>Tabel Utama:</h6>
                                        
                                        <div class="mb-3">
                                            <strong>register_peserta_magang</strong>
                                            <ul>
                                                <li>id (Primary Key)</li>
                                                <li>nim</li>
                                                <li>nama</li>
                                                <li>nama_pt (Nama Perguruan Tinggi)</li>
                                                <li>program_studi</li>
                                                <li>hp (Nomor Handphone)</li>
                                                <li>status (1=Aktif, 0=Tidak Aktif)</li>
                                                <li>token (Token perangkat untuk presensi)</li>
                                                <li>created_on, created_by</li>
                                                <li>modified_on, modified_by</li>
                                                <li>hapus (Soft delete flag)</li>
                                            </ul>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <strong>register_presensi_magang</strong>
                                            <ul>
                                                <li>id (Primary Key)</li>
                                                <li>peserta_id (Foreign Key ke register_peserta_magang)</li>
                                                <li>tgl (Tanggal presensi)</li>
                                                <li>masuk (Jam masuk)</li>
                                                <li>pulang (Jam pulang)</li>
                                                <li>foto_masuk (Path foto masuk)</li>
                                                <li>foto_pulang (Path foto pulang)</li>
                                                <li>keterangan</li>
                                                <li>created_on, created_by</li>
                                                <li>modified_on, modified_by</li>
                                            </ul>
                                        </div>
                                        
                                        <h6 class="mt-3">API Integration:</h6>
                                        <p>Sistem menggunakan API Client untuk mengakses database SSO dan tabel lainnya:</p>
                                        <ul>
                                            <li><strong>apiclient/get_data_seleksi:</strong> Mengambil data dengan kondisi tertentu</li>
                                            <li><strong>apiclient/simpan_data:</strong> Menyimpan data baru</li>
                                            <li><strong>apiclient/get_lokasi:</strong> Mengambil data lokasi presensi (polygon)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Keamanan -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTech4">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTech4">
                                        <i class="bx bx-shield me-2"></i>Keamanan Sistem
                                    </button>
                                </h2>
                                <div id="collapseTech4" class="accordion-collapse collapse" data-bs-parent="#accordionTeknis">
                                    <div class="accordion-body">
                                        <h6>Mekanisme Autentikasi:</h6>
                                        <ol>
                                            <li>User login melalui SSO Server</li>
                                            <li>SSO Server mengirim token (sso_token) via cookie</li>
                                            <li>Aplikasi memvalidasi token melalui API SSO</li>
                                            <li>Session dibuat setelah validasi berhasil</li>
                                            <li>Token dicek secara berkala untuk memastikan masih valid</li>
                                        </ol>
                                        
                                        <h6 class="mt-3">Role-Based Access Control:</h6>
                                        <ul>
                                            <li>Hanya user dengan role 'super', 'validator_uk_satker', atau 'admin_satker' yang bisa mengakses aplikasi</li>
                                            <li>Role disimpan dalam session sebagai 'peran' = 'admin'</li>
                                            <li>Validasi dilakukan di MY_Controller constructor</li>
                                        </ul>
                                        
                                        <h6 class="mt-3">Keamanan Data:</h6>
                                        <ul>
                                            <li>Input validation menggunakan CodeIgniter Form Validation</li>
                                            <li>XSS filtering dengan security->xss_clean()</li>
                                            <li>Data encryption untuk ID sensitif (menggunakan CodeIgniter Encryption)</li>
                                            <li>Soft delete untuk data penting (flag 'hapus')</li>
                                            <li>File upload disimpan di folder uploads/ dengan struktur per peserta</li>
                                        </ul>
                                        
                                        <h6 class="mt-3">Keamanan Presensi:</h6>
                                        <ul>
                                            <li>Validasi lokasi menggunakan polygon geofencing</li>
                                            <li>Token perangkat untuk mencegah presensi dari perangkat tidak terdaftar</li>
                                            <li>Foto wajib untuk setiap presensi</li>
                                            <li>Validasi waktu (masuk sebelum 12:00, pulang setelah 12:00)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- API Endpoints -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTech5">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTech5">
                                        <i class="bx bx-network-chart me-2"></i>API Endpoints
                                    </button>
                                </h2>
                                <div id="collapseTech5" class="accordion-collapse collapse" data-bs-parent="#accordionTeknis">
                                    <div class="accordion-body">
                                        <h6>Internal Endpoints:</h6>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Method</th>
                                                    <th>Endpoint</th>
                                                    <th>Controller</th>
                                                    <th>Deskripsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>GET</td>
                                                    <td>/halamanutama/page/{page}</td>
                                                    <td>HalamanUtama::page()</td>
                                                    <td>Load view page (SPA)</td>
                                                </tr>
                                                <tr>
                                                    <td>POST</td>
                                                    <td>/show_tabel_peserta_magang</td>
                                                    <td>HalamanMagang::show_tabel_peserta_magang()</td>
                                                    <td>Get list peserta magang</td>
                                                </tr>
                                                <tr>
                                                    <td>POST</td>
                                                    <td>/simpan_peserta</td>
                                                    <td>HalamanMagang::simpan_peserta()</td>
                                                    <td>Save/update peserta</td>
                                                </tr>
                                                <tr>
                                                    <td>POST</td>
                                                    <td>/simpan_presensi</td>
                                                    <td>HalamanPresensi::simpan_presensi()</td>
                                                    <td>Save presensi data</td>
                                                </tr>
                                                <tr>
                                                    <td>POST</td>
                                                    <td>/show_tabel_presensi_peserta_magang</td>
                                                    <td>HalamanLaporan::show_tabel_presensi_peserta_magang()</td>
                                                    <td>Get list presensi</td>
                                                </tr>
                                                <tr>
                                                    <td>POST</td>
                                                    <td>/get_lokasi</td>
                                                    <td>HalamanPresensi::get_lokasi()</td>
                                                    <td>Get polygon lokasi presensi</td>
                                                </tr>
                                                <tr>
                                                    <td>POST</td>
                                                    <td>/cek_token</td>
                                                    <td>HalamanUtama::cek_token_sso()</td>
                                                    <td>Validate SSO token</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                        <h6 class="mt-3">External API (SSO Server):</h6>
                                        <ul>
                                            <li><strong>GET {sso_server}api/cek_token:</strong> Validasi SSO token</li>
                                            <li><strong>POST {sso_server}api/apiclient/get_data_seleksi:</strong> Query data dari database SSO</li>
                                            <li><strong>POST {sso_server}api/apiclient/simpan_data:</strong> Simpan data ke database SSO</li>
                                            <li><strong>GET {sso_server}api/apiclient/get_lokasi:</strong> Ambil data lokasi</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Troubleshooting Teknis -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTech6">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTech6">
                                        <i class="bx bx-bug me-2"></i>Troubleshooting Teknis
                                    </button>
                                </h2>
                                <div id="collapseTech6" class="accordion-collapse collapse" data-bs-parent="#accordionTeknis">
                                    <div class="accordion-body">
                                        <h6>Masalah Umum dan Solusi:</h6>
                                        
                                        <div class="mb-3">
                                            <strong>1. Session expired atau redirect loop</strong>
                                            <ul>
                                                <li>Periksa cookie domain di config.php</li>
                                                <li>Pastikan SSO server accessible</li>
                                                <li>Clear browser cookies dan coba lagi</li>
                                                <li>Periksa session save path permissions</li>
                                            </ul>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <strong>2. API call gagal</strong>
                                            <ul>
                                                <li>Periksa koneksi ke SSO server</li>
                                                <li>Periksa API endpoint URL</li>
                                                <li>Periksa log error di application/logs/</li>
                                                <li>Pastikan API client library sudah ter-load</li>
                                            </ul>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <strong>3. File upload gagal</strong>
                                            <ul>
                                                <li>Periksa permission folder uploads/</li>
                                                <li>Periksa ukuran file maksimal (php.ini)</li>
                                                <li>Pastikan folder uploads/foto/{id}/ ada</li>
                                                <li>Periksa disk space server</li>
                                            </ul>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <strong>4. Geolocation tidak bekerja</strong>
                                            <ul>
                                                <li>Pastikan HTTPS digunakan (geolocation requires secure context)</li>
                                                <li>Periksa browser permission untuk location</li>
                                                <li>Pastikan Leaflet.js dan Turf.js sudah ter-load</li>
                                                <li>Periksa format polygon JSON dari API</li>
                                            </ul>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <strong>5. PDF generation error</strong>
                                            <ul>
                                                <li>Periksa DomPDF library sudah ter-install</li>
                                                <li>Periksa memory limit PHP</li>
                                                <li>Periksa font path untuk DomPDF</li>
                                                <li>Periksa permission folder untuk temporary files</li>
                                            </ul>
                                        </div>
                                        
                                        <h6 class="mt-3">Log Files:</h6>
                                        <p>Log error dapat ditemukan di:</p>
                                        <ul>
                                            <li><code>application/logs/log-{date}.php</code></li>
                                            <li>Pastikan folder logs/ writable (chmod 755 atau 777)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Maintenance -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTech7">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTech7">
                                        <i class="bx bx-wrench me-2"></i>Maintenance dan Backup
                                    </button>
                                </h2>
                                <div id="collapseTech7" class="accordion-collapse collapse" data-bs-parent="#accordionTeknis">
                                    <div class="accordion-body">
                                        <h6>Rutinitas Maintenance:</h6>
                                        <ul>
                                            <li><strong>Backup Database:</strong> Lakukan backup harian untuk tabel register_peserta_magang dan register_presensi_magang</li>
                                            <li><strong>Backup Files:</strong> Backup folder uploads/ secara berkala</li>
                                            <li><strong>Cleanup Logs:</strong> Hapus log files yang sudah lama (lebih dari 30 hari)</li>
                                            <li><strong>Monitor Disk Space:</strong> Monitor penggunaan disk untuk folder uploads/</li>
                                            <li><strong>Update Dependencies:</strong> Update library third-party secara berkala</li>
                                        </ul>
                                        
                                        <h6 class="mt-3">Script Backup (Contoh):</h6>
                                        <pre class="bg-light p-3 rounded">
# Backup database
mysqldump -u user -p database_name register_peserta_magang register_presensi_magang > backup_$(date +%Y%m%d).sql

# Backup files
tar -czf uploads_backup_$(date +%Y%m%d).tar.gz uploads/

# Cleanup old logs (older than 30 days)
find application/logs/ -name "log-*.php" -mtime +30 -delete
                                        </pre>
                                        
                                        <h6 class="mt-3">Monitoring:</h6>
                                        <ul>
                                            <li>Monitor error logs secara berkala</li>
                                            <li>Monitor API response time</li>
                                            <li>Monitor disk usage untuk uploads/</li>
                                            <li>Monitor session storage usage</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        </div>
    </div>
</div>


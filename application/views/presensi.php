<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">

    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
    <link href="assets/plugins/notifications/css/lobibox.min.css" rel="stylesheet" />

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- Leaflet Draw (plugin untuk edit polygon) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-draw/dist/leaflet.draw.css" />
    <script src="https://unpkg.com/leaflet-draw/dist/leaflet.draw.js"></script>
    <title>LEUMANG | Presensi Kehadiran Mahasiswa Magang</title>
</head>

<body class="bg-theme bg-theme15">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="mb-4 text-center">
                            <h4>LEUMANG (Aplikasi Manajemen Untuk Mahasiswa Magang)</h4>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">PRESENSI</h3>
                                    </div>
                                    <hr />
                                    <div class="form-body">
                                        <form class="row g-3">
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                                        data-bs-target="#presensi-peserta" onclick="BukaPresensi()"><i
                                                            class="bx bxs-stopwatch"></i>Presensi Kehadiran</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>

        <div class="modal fade" id="presensi-peserta" data-bs-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <form method="POST" id="formPresensi" class="modal-content bg-gradient-moonlit">
                    <div class="modal-header">
                        <div>
                            <i class="bx bxs-user me-1 font-22"></i>
                        </div>
                        <h5 class="mb-0">Presensi Mahasiswa Magang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col" style="display: grid; place-items: center;">
                                <strong class="form-label" id="hari_"></strong>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col" style="display: grid; place-items: center;">
                                <strong class="form-label">Saat ini pukul <label id="jam_show"></label></strong>
                                <input type="hidden" id="jam" name="jam">
                            </div>
                        </div>
                        <div class="row g-2 mb-3">
                            <div id="map" style="height:250px;"></div><br />
                            <div id="ket_map" class="text-center"></div><br />
                        </div>
                        <div class="mb-3" id="peserta_">
                        </div>
                        <div id="detil_presensi">
                            <div class="row mb-3">
                                <div class="col text-center">
                                    <label class="form-label">Presensi Datang : <span class="badge bg-danger"
                                            id="jam_datang">Belum Presensi</span></label></code>
                                </div>
                            </div>
                            <div class="row mb-3 text-center">
                                <div class="col">
                                    <label class="form-label">Presensi Pulang : <span class="badge bg-danger"
                                            id="jam_pulang">Belum Presensi</span></label></code>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-0">
                                    <div class="form-group" style="display: grid; place-items: center;">
                                        <label class="form-label">Foto</label>
                                        <div>
                                            <div id="foto"></div>
                                            <input class="form-control" id="fotobase" name="foto" hidden></label>
                                        </div>
                                        <div class="form-group">
                                            <div class="btn btn-info" data-bs-toggle='modal'
                                                data-bs-target='#modal_kamera' onclick="aturIzin()">Ambil
                                                Foto</div>
                                            <input type="hidden" name="image" class="image-tag">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="btnSimpan">Simpan</button>
                    </div>
                </form>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>

    <!-- ============ MODAL KAMERA =============== -->
    <div class="modal fade" id="modal_kamera" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-gradient-moonlit">
                <div class="modal-header">
                    <h5 class="modal-title">Silakan Foto Diri Anda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        onclick="offKamera()"></button>
                </div>
                <div class="modal-body text-center">
                    <video id="video-webcam" autoplay playsinline muted
                        style="width:100%; height:auto; border-radius:8px; background:#000;">
                        Browser tidak mendukung kamera.
                    </video>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn btn-success" onclick="takeSnapshot()" data-bs-toggle="modal"
                            data-bs-target="#presensi-peserta">📸 Ambil
                        Foto</button>
                </div>
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!--plugins-->
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="assets/plugins/select2/js/select2.min.js"></script>
    <script src="assets/plugins/notifications/js/lobibox.min.js"></script>
    <script src="assets/plugins/notifications/js/notifications.min.js"></script>
    <script src="assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!--Password show & hide js -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Turf.js/6.5.0/turf.min.js"></script>

    <?php
    if ($this->session->flashdata('info')) {
        $result = $this->session->flashdata('info');
        if ($result == '1') {
            $pesan = $this->session->flashdata('pesan_sukses');
        } elseif ($result == '2') {
            $pesan = $this->session->flashdata('pesan_gagal');
        } else {
            $pesan = $this->session->flashdata('pesan_gagal');
        }
    } else {
        $result = "-1";
        $pesan = "";
    }
    ?>

    <script type="text/javascript">
        var config = {
            tokenCookies: '<?= $this->input->cookie('presensi_token', TRUE) ?>',
            result: '<?= $result ?>',
            pesan: '<?= $pesan ?>'
        };
    </script>

    <script src="assets/js/magang.js?v=1.0.1"></script>
</body>

</html>
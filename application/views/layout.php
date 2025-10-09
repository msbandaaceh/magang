<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/icons/meeting.webp" type="image/webp" />
    <!--plugins-->
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
    <link href="assets/plugins/notifications/css/lobibox.min.css" rel="stylesheet" />
    <link href="assets/plugins/flatpickr/flatpickr.min.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css"
        rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <title><?= $this->session->userdata('nama_client_app') ?> | <?= $this->session->userdata('deskripsi_client_app') ?>
    </title>

    <style>
        /* Define keyframes for the glow animation */
        @keyframes glowing {
            0% {
                box-shadow: 0 0 10px #fff;
            }

            50% {
                box-shadow: 0 0 20px #00BFFF;
            }

            100% {
                box-shadow: 0 0 10px #fff;
            }
        }

        /* Apply the glow animation to the link when it's hovered over */
        #presensi {
            animation: glowing 1.5s infinite;
        }
    </style>
</head>

<body class="bg-theme bg-theme15">
    <div class="wrapper">
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <img src="assets/images/icons/meeting.webp" class="logo-icon" alt="logo icon">
                </div>
                <div>
                    <h4 class="logo-text"><?= $this->session->userdata('nama_client_app') ?></h4>
                </div>
                <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
                </div>
            </div>
            <ul class="metismenu" id="menu">
                <li>
                    <a href="javascript:;" data-page="dashboard">
                        <div class="parent-icon"><i class='bx bx-home-circle'></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" data-page="manage_peserta">
                        <div class="parent-icon"><i class='bx bx-calendar-event'></i>
                        </div>
                        <div class="menu-title">Manajemen Peserta Magang</div>
                    </a>
                </li>

                <li class="menu-label">Laporan</li>
                <li>
                    <a href="javascript:;" data-page="laporan_presensi">
                        <div class="parent-icon"><i class='bx bx-user-circle'></i>
                        </div>
                        <div class="menu-title">Presensi</div>
                    </a>
                </li>
            </ul>
        </div>

        <!--start header -->
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>
                    <div class="top-menu ms-auto">
                    </div>
                    <div class="user-box dropdown">
                        <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= $this->session->userdata('foto') ?>" class="user-img" alt="user avatar">
                            <div class="user-info ps-3">
                                <p class="user-name mb-0"><?= $this->session->userdata('fullname') ?></p>
                                <p class="designattion mb-0"><?= $this->session->userdata('jabatan') ?></p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="keluar"><i
                                        class='bx bx-log-out-circle'></i><span>Keluar</span></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--end header -->

        <div id="app"></div>

        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javascript:;" class="back-to-top"><i
                class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2024. All right reserved.</p>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/plugins/select2/js/select2.min.js"></script>
    <script src="assets/plugins/notifications/js/lobibox.min.js"></script>
    <script src="assets/plugins/notifications/js/notifications.min.js"></script>
    <script src="assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/plugins/bootstrap-material-datetimepicker/js/moment.min.js"></script>
    <script src="assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js"></script>
    <script src="assets/plugins/flatpickr/flatpickr.js"></script>

    <!--app JS-->
    <script src="assets/js/app.js"></script>

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

    <script>
        $(document).ready(function () {
            // Load page
            loadPage('dashboard');

            // Navigasi SPA
            $('[data-page]').on('click', function (e) {
                e.preventDefault();
                $('.wrapper').removeClass('toggled');
                let page = $(this).data('page');
                loadPage(page);
            });
        });
    </script>

    <script type="text/javascript">
        var config = {
            peran: '<?= $peran ?>',
            result: '<?= $result ?>',
            pesan: '<?= $pesan ?>'
        };
    </script>

    <script src="assets/js/magang.js?v=1.0.0"></script>
</body>

</html>
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
                        <li class="breadcrumb-item active" aria-current="page">Daftar Peserta Magang</li>
                    </ol>
                </nav>
            </div>
        </div>
        <h6 class="mb-0 text-uppercase">Daftar Peserta Magang</h6>
        <hr />
        <div class="row">
            <div class="col">
                <div class="card">

                    <div class="card-header text-end">
                        <button type="button" class="btn btn-light px-5" data-bs-toggle="modal"
                            data-bs-target="#tambah-peserta"
                            onclick="loadPeserta('<?= base64_encode($this->encryption->encrypt(-1)); ?>')"><i
                                class="bx bx-user mr-1"></i>Tambah Peserta Magang</button>
                    </div>
                    <div class="card-body" id="tabelPesertaMagang">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambah-peserta" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <form method="POST" id="formTambahPesertaMagang" class="modal-content bg-gradient-moonlit">
            <div class="modal-header">
                <div>
                    <i class="bx bxs-user me-1 font-22"></i>
                </div>
                <h5 class="mb-0" id="judul_"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <input type="hidden" class="form-control" id="id" name="id">
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="nim" class="form-label">NIM PESERTA MAGANG</label><code> *</code>
                        <input type="text" id="nim" name="nim" autocomplete="off" class="form-control" placeholder="Masukkan NIM">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="nama" class="form-label">NAMA PESERTA MAGANG</label><code> *</code>
                        <input type="text" id="nama" name="nama" autocomplete="off" class="form-control" placeholder="Masukkan Nama">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="nama_pt" class="form-label">NAMA PERGURUAN TINGGI</label><code> *</code>
                        <input type="text" id="nama_pt" name="nama_pt" autocomplete="off" class="form-control"
                            placeholder="Masukkan Nama Perguruan Tinggi">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="prodi" class="form-label">NAMA PROGRAM STUDI</label><code> *</code>
                        <input type="text" id="prodi" name="prodi" autocomplete="off" class="form-control"
                            placeholder="Masukkan Nama Program Studi">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="hp" class="form-label">NOMOR HANDPHONE</label><code> *</code>
                        <input type="text" id="hp" name="hp" autocomplete="off" class="form-control"
                            placeholder="Masukkan Nomor Handphone">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="status" class="form-label">STATUS PESERTA MAGANG</label><code> *</code>
                        <div id="status_"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="btn-simpan">Simpan</button>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    $(document).ready(function () {
        loadTabelPesertaMagang();
    });
</script>
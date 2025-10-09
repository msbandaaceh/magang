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
                        <li class="breadcrumb-item active" aria-current="page">Presensi Peserta Magang</li>
                    </ol>
                </nav>
            </div>
        </div>
        <h6 class="mb-0 text-uppercase">Presensi Peserta Magang</h6>
        <hr />
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="input-group mb-3">
                    <input type="text" id="tglPresensi" class="form-control">
                    <button class="btn btn-light" type="button" onclick="cariPresensi()">Cari Presensi</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body" id="tabelPresensiPesertaMagang"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-presensi" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form method="POST" id="formEditPresensi" class="modal-content bg-gradient-moonlit">
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
                    <input type="hidden" class="form-control" id="peserta_id" name="peserta_id">
                    <input type="hidden" class="form-control" id="tgl" name="tanggal">
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="nama" class="form-label">NAMA PESERTA MAGANG</label>
                        <input type="text" id="nama" class="form-control" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="jam_datang" class="form-label">JAM DATANG</label><code> *</code>
                        <div class="input-group">
                            <input type="text" id="jam_datang" name="jam_datang" autocomplete="off"
                                class="form-control">
                            <button class="btn btn-light" type="button" id="hapus_datang">Hapus</button>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="jam_pulang" class="form-label">JAM PULANG</label><code> *</code>
                        <div class="input-group">
                            <input type="text" id="jam_pulang" name="jam_pulang" autocomplete="off"
                                class="form-control">
                            <button class="btn btn-light" type="button" id="hapus_pulang">Hapus</button>
                        </div>

                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="ket" class="form-label">KETERANGAN</label><code> *</code>
                        <div id="ket_"></div>
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

<div class="modal fade" id="lihat-foto" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content bg-gradient-moonlit">
            <div class="modal-header">
                <div>
                    <i class="bx bxs-user me-1 font-22"></i>
                </div>
                <h5 class="mb-0" id="judul_modal"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div id="foto_"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    $(document).ready(function () {
        loadTanggal();
        loadTabelPresensiPesertaMagang('<?= date('Y-m-d') ?> ');
    });
</script>
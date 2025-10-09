var result = config.result;
var pesan = config.pesan;
var token_cookies = config.tokenCookies;

$(function () {
    $(document).off('submit', '#formTambahPesertaMagang').on('submit', '#formTambahPesertaMagang', function (e) {
        e.preventDefault();
        let form = this;
        let formData = new FormData(form);

        $.ajax({
            url: 'simpan_peserta',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (res) {
                notifikasi(res.message, res.success);
                if (res.success == '1') {
                    $('#tambah-peserta').modal('hide');
                    loadTabelPesertaMagang();
                }
            },
            error: function () {
                notifikasi('Terjadi kesalahan saat menyimpan data.', 4);
            }
        });
    });

    $(document).off('submit', '#formPresensi').on('submit', '#formPresensi', function (e) {
        e.preventDefault();
        let form = this;
        let formData = new FormData(form);

        $.ajax({
            url: 'simpan_presensi',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (res) {
                notifikasi(res.message, res.success);
                if (res.success == '1') {
                    $('#presensi-peserta').modal('hide');
                }
            },
            error: function () {
                notifikasi('Terjadi kesalahan saat menyimpan data.', 4);
            }
        });
    });

    $(document).off('submit', '#formEditPresensi').on('submit', '#formEditPresensi', function (e) {
        e.preventDefault();
        let form = this;
        let formData = new FormData(form);

        $.ajax({
            url: 'simpan_edit_presensi',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (res) {
                notifikasi(res.message, res.success);
                if (res.success == '1') {
                    $('#edit-presensi').modal('hide');
                    var tanggal = document.getElementById('tglPresensi').value;
                    loadTabelPresensiPesertaMagang(tanggal);
                }
            },
            error: function () {
                notifikasi('Terjadi kesalahan saat menyimpan data.', 4);
            }
        });
    });

    $(document).off('submit', '#formCetakPresensi').on('submit', '#formCetakPresensi', function (e) {
        e.preventDefault();
        let form = this;
        let formData = new FormData(form);

        $.ajax({
            url: 'unduh_presensi',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (res) {
                notifikasi(res.message, res.success);
                if (res.success == '1') {
                    window.location = res.url;
                }
            },
            error: function () {
                notifikasi('Terjadi kesalahan saat menyimpan data.', 4);
            }
        });
    });
});

function notifikasi(pesan, result) {
    let icon;
    if (result == '1') {
        result = 'success';
        icon = 'bx bx-check-circle';
    } else if (result == '2') {
        result = 'warning';
        icon = 'bx bx-error';
    } else if (result == '3') {
        result = 'error';
        icon = 'bx bx-x-circle';
    } else {
        result = 'info';
        icon = 'bx bx-info-circle';
    }

    Lobibox.notify(result, {
        pauseDelayOnHover: true,
        continueDelayOnInactiveTab: false,
        position: 'top right',
        icon: icon,
        sound: false,
        msg: pesan
    });
}

function info(pesan) {
    Swal.fire({
        title: '<h4>Perhatian</h4>',
        html: pesan,
        icon: 'info',
        confirmButtonText: 'OK'
    });
}

function loadPage(page) {
    cekToken();
    $('#app').html(`
        <div class="page-wrapper">
            <div class="page-content">
                <div class="text-center p-4">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <div class="text-center">
                    <span>Memuat Halaman... Harap Tunggu Sebentar</span>
                </div>
            </div>
        </div>
    `);
    $.get("halamanutama/page/" + page, function (data) {
        $('#app').html(data);
    }).fail(function () {
        $('#app').html(`
            <div class="page-wrapper">
                <div class="page-content">
                    <div class="text-center p-4">Halaman tidak ditemukan.</div>
                </div>
            </div>
        `);
    });
}

function cekToken() {
    $.ajax({
        url: 'cek_token',
        type: 'POST',
        dataType: 'json',
        success: function (res) {
            if (!res.valid) {
                alert(res.message);
                window.location.href = res.url;
            }
        }
    });
}

function loadTabelPesertaMagang() {
    $.post('show_tabel_peserta_magang', function (response) {
        try {
            const json = JSON.parse(response); // Pastikan server kirim JSON valid

            $('#tabelPesertaMagang').html(''); // kosongkan wrapper

            if (!json.data_peserta || json.data_peserta.length === 0) {
                // Kalau kosong
                $('#tabelPesertaMagang').html(`
                    <div class="alert border-0 border-start border-5 border-info alert-dismissible fade show py-2">
                        <div class="d-flex align-items-center">
                            <div class="font-35 text-info"><i class='bx bx-info-square'></i></div>
                            <div class="ms-3">
                                <h6 class="mb-0 text-info">Informasi</h6>
                                <div>Belum Ada Peserta Magang Yang Dimasukkan. Terima kasih.</div>
                            </div>
                        </div>
                    </div>
                `);
                return;
            }

            // Kalau ada data, buat tabelnya
            let data = `
                <div class="table-responsive">
                <table id="tabelPesertaMagangData" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA PESERTA</th>
                            <th>NAMA PERGURUAN TINGGI</td>
                            <th>PROGRAM STUDI</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            json.data_peserta.forEach((row, index) => {
                let statusBadge = '';
                if (row.status == '1') {
                    statusBadge = '<span class="btn btn-success radius-30">Aktif</span>';
                } else {
                    statusBadge = '<span class="btn btn-danger radius-30">Tidak Aktif</span>';
                }

                // Tombol aksi
                let tombolAksi = `
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-info" title="Lihat Detil Peserta"
                            data-bs-target="#detil-peserta"
                            onclick="detailPeserta('${row.id}')"
                            data-bs-toggle="modal"><i class="bx bxs-show"></i>
                        </button>
                        <button type="button" class="btn btn-warning" title="Edit Peserta"
                            data-bs-target="#tambah-peserta"
                            onclick="loadPeserta('${row.id}')"
                            data-bs-toggle="modal"><i class="bx bxs-pencil"></i>
                        </button>
                    </div>
                `;

                // Baris tabel
                data += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${row.nama}</td>
                        <td>${row.nama_pt}</td>
                        <td>${row.program_studi}</td>
                        <td>${statusBadge}</td>
                        <td>${tombolAksi}</td>
                    </tr>
                `;
            });

            data += `
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>NO</th>
                            <th>NAMA PESERTA</th>
                            <th>NAMA PERGURUAN TINGGI</td>
                            <th>PROGRAM STUDI</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            `;

            $('#tabelPesertaMagang').append(data);

            // Aktifkan DataTables
            $("#tabelPesertaMagangData").DataTable();
        } catch (e) {
            console.error("Gagal parsing JSON:", e);
            $('#tabelPesertaMagang').html('<div class="alert alert-danger">Gagal memuat data peserta magang.</div>');
        }
    });
}

function loadPeserta(id) {
    $.post('show_peserta', {
        id: id
    }, function (response) {
        var json = jQuery.parseJSON(response);
        if (json.st == 1) {

            console.log(json);

            $("#id").val('');
            $("#judul_").html('');
            $("#nim").val('');
            $("#nama").val('');
            $("#nama_pt").val('');
            $("#prodi").val('');
            $("#hp").val('');
            $("#status_").html('');

            $("#id").val(json.id);
            $("#judul_").html(json.judul);
            $("#nim").val(json.nim);
            $("#nama").val(json.nama);
            $("#nama_pt").val(json.nama_pt);
            $("#prodi").val(json.program_studi);
            $("#hp").val(json.hp);
            $("#status_").append(json.status);
        }
    });
}

function simpanPerangkat(id) {
    Swal.fire({
        title: "Anda Belum Mendaftarkan Perangkat Untuk Melakukan Presensi",
        text: "Apa Anda Yakin Akan Mendaftarkan Perangkat Ini Untuk Melakukan Presensi?",
        icon: "info",
        showCancelButton: true,
        confirmButtonColor: "#8EC165",
        confirmButtonText: "Ya, Simpan !",
        cancelButtonText: "Tidak !"
    }).then((result) => {
        if (result.isConfirmed) {
            $.post('simpan_perangkat', { id: id }, function (response) {
                var json = jQuery.parseJSON(response);
                if (json.st == 1) {
                    Swal.fire({
                        title: "Berhasil !",
                        text: "Anda sudah mendaftarkan perangkat, silakan mengisi presensi",
                        icon: "success",
                        confirmButtonColor: "#8EC165",
                        confirmButtonText: "Oke"
                    }).then(() => {
                        location.reload();
                    });
                } else if (json.st == 0) {
                    Swal.fire("Gagal", "Anda Gagal Mendaftarkan Perangkat, Silakan Ulangi Lagi", "error");
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire("Batal", "Anda Tidak Mendaftarkan Perangkat", "error");
        }
    });
}

let map, userMarker, polygonLayer, polygonCoords = [];

function BukaPresensi() {
    Swal.fire({
        title: "Memuat...",
        text: "Silakan tunggu sebentar.",
        imageUrl: "assets/images/loader.gif",
        imageWidth: 200,
        imageHeight: 200,
        imageAlt: "Loading...",
        showConfirmButton: false,
        allowOutsideClick: false
    });

    document.getElementById('detil_presensi').style.display = 'none';
    $('#foto').html('');

    $("#modal-content").hide();
    $("#btnSimpan").attr("disabled", true);
    $.post('show_presensi', function (response) {
        var json = jQuery.parseJSON(response);
        if (json.st == 1) {
            $("#jam_show").html('');
            $("#hari_").html('');
            $("#jam").val('');
            $('#peserta_').html('');

            $("#jam_show").append(json.jam);
            $("#hari_").append(json.hari);
            $("#jam").val(json.jam);
            $('#peserta_').append(json.peserta);

            $('#presensi-peserta').on('shown.bs.modal', function () {
                $('#btnSimpan').addClass('hidden');
                if (!map) {
                    // Buat map pertama kali
                    map = L.map('map');

                    // Tambah tile layer
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors'
                    }).addTo(map);

                    // Lokasi user
                    map.locate({
                        setView: true,
                        maxZoom: 20,
                        enableHighAccuracy: true,
                        watch: true
                    });

                    map.on("locationfound", function (e) {
                        if (userMarker) {
                            userMarker.setLatLng(e.latlng);
                        } else {
                            userMarker = L.marker(e.latlng).addTo(map);
                        }

                        map.setView(e.latlng, 19); // zoom dekat

                        // Cek apakah user ada di dalam polygon
                        if (polygonCoords.length > 0) {
                            checkInsidePolygon(e.latlng);
                        }
                    });

                    map.on("locationerror", function () {
                        alert("Tidak bisa mendapatkan lokasi Anda");
                        map.setView([-6.2, 106.816], 17); // fallback ke Jakarta
                    });

                    // Ambil polygon dari server
                    $.getJSON('get_lokasi', function (data) {
                        polygonCoords = data.koordinat.map(p => [p.lng, p.lat]); // lng,lat sesuai geojson

                        // Pastikan polygon tertutup
                        if (
                            polygonCoords[0][0] !== polygonCoords[polygonCoords.length - 1][0] ||
                            polygonCoords[0][1] !== polygonCoords[polygonCoords.length - 1][1]
                        ) {
                            polygonCoords.push(polygonCoords[0]);
                        }

                        // Gambar polygon di Leaflet (ingat Leaflet pakai [lat, lng])
                        polygonLayer = L.polygon(data.koordinat.map(p => [p.lat, p.lng]), {
                            color: "red",
                            fillColor: "#f03",
                            fillOpacity: 0.4
                        }).addTo(map);

                        map.setView(polygonLayer.getBounds().getCenter(), 17);
                    });

                } else {
                    map.invalidateSize();
                    map.locate({ setView: true, maxZoom: 17 });
                }
            });

            $('#peserta').select2({
                theme: 'bootstrap4',
                dropdownParent: $('#presensi-peserta'),
                width: '100%',
                placeholder: "Pilih Peserta Magang"
            });

            Swal.close();
            $("#modal-content").show();

        } else if (json.st == 0) {
            pesan('PERINGATAN', json.msg, '');
            $('#table_pegawai').DataTable().ajax.reload();
            $("#loader").hide();
            $("#modal-content").show();
        }
    });
}

function checkInsidePolygon(latlng) {
    let point = turf.point([latlng.lng, latlng.lat]);
    let polygon = turf.polygon([polygonCoords]);
    $('#ket_map').html('');

    if (turf.booleanPointInPolygon(point, polygon)) {
        $('#ket_map').append('<p class="text-white bg-success">Anda Diperbolehkan Presensi</p>');
        document.getElementById('btnSimpan').style.display = 'block';
    } else {
        $('#ket_map').append('<p class="text-white bg-danger">Anda Tidak Diperbolehkan presensi karena diluar lokasi presensi</p>');
        document.getElementById('btnSimpan').style.display = 'none';
    }
}

function bukaDetailPresensi() {
    let id = document.getElementById('peserta').value;

    $.post('show_detail_presensi', { id: id }, function (response) {
        var json = jQuery.parseJSON(response);
        if (json.st == 1) {

            if (json.token == null) {
                simpanPerangkat(id);
            } else if (token_cookies != json.token) {
                notifikasi('Anda Menggunakan Perangkat Lain Untuk Presensi. Silakan Menggunakan Perangkat Yang Telah Didaftarkan Untuk Presensi', 2);
                document.getElementById('detil_presensi').style.display = 'none';
                $("#btnSimpan").attr("disabled", true);
            } else {
                document.getElementById('detil_presensi').style.display = 'block';
                $("#btnSimpan").attr("disabled", false);
                if (json.jam_masuk) {
                    $("#jam_datang").html('');
                    $("#jam_datang").append(json.jam_masuk);
                    $('#jam_datang').toggleClass('bg-danger bg-success');
                }

                if (json.jam_pulang) {
                    $("#jam_pulang").html('');
                    $("#jam_pulang").append(json.jam_pulang);
                    $('#jam_pulang').toggleClass('bg-danger bg-success');
                    document.getElementById('btnSimpan').style.display = 'none';
                }
            }
        } else if (json.st == 0) {
            pesan('PERINGATAN', json.msg, '');
            $('#table_pegawai').DataTable().ajax.reload();
            $("#loader").hide();
            $("#modal-content").show();
        }
    });
}

let video = document.querySelector("#video-webcam");
let img = document.createElement("img");
let stream = null;

function aturIzin() {
    document.getElementById("fotobase").value = "";

    let constraints = {
        video: { facingMode: "user" }, // bisa diganti "environment" untuk kamera belakang
        audio: false
    };

    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia(constraints)
            .then(handleVideo)
            .catch(videoError);
    } else {
        alert("Browser tidak mendukung kamera.");
    }
}

function handleVideo(mediaStream) {
    stream = mediaStream;
    video.srcObject = stream;
    video.style.transform = "scaleX(-1)"; // buat mirrored

    // fix iOS Safari
    video.setAttribute("playsinline", true);
    video.play();

    // auto responsif
    video.style.width = "100%";
    video.style.height = "auto";
}

function videoError(e) {
    console.error(e);
    alert("Izinkan kamera untuk melanjutkan.");
}

function takeSnapshot() {
    let canvas = document.createElement("canvas");
    let context = canvas.getContext("2d");

    // pakai ukuran asli video agar jelas
    canvas.width = video.videoWidth || 320;
    canvas.height = video.videoHeight || 240;

    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    let dataURL = canvas.toDataURL("image/jpeg");
    document.getElementById("fotobase").value = dataURL.replace(/^data:image\/jpeg;base64,/, "");

    img.src = dataURL;
    img.className = "img-fluid rounded mt-2";
    let fotoDiv = document.getElementById("foto");
    fotoDiv.innerHTML = "";
    fotoDiv.appendChild(img);

    offKamera(); // matikan kamera setelah ambil foto
}

function offKamera() {
    if (stream) {
        stream.getTracks().forEach(track => track.stop());
    }
    video.srcObject = null;
}

function loadTanggal() {
    tglPicker = flatpickr('#tglPresensi', {
        altFormat: 'l, d F Y',
        altInput: true,
        dateFormat: 'Y-m-d',
        locale: {
            firstDayOfWeek: 7,
            weekdays: {
                shorthand: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                longhand: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
            },
            months: {
                shorthand: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                    'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                longhand: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            },
        },
        onDayCreate: function (dObj, dStr, fp, dayElem) {
            var day = dayElem.dateObj.getDay();
            var dateStr = fp.formatDate(dayElem.dateObj, "Y-m-d");

            // Disable Sabtu & Minggu + tanggal merah (tidak bisa diklik langsung)
            if (day === 0 || day === 6) {
                dayElem.classList.add("disabled-date");
            }
        },
        onReady: function (selectedDates, dateStr, instance) {
            // Cegah klik langsung di tanggal disable
            instance.calendarContainer.addEventListener("click", function (e) {
                if (e.target.closest(".disabled-date")) {
                    e.stopPropagation();
                }
            }, true);

            instance.setDate(new Date(), true);
        }
    });
}

function loadTabelPresensiPesertaMagang(tgl) {
    $.post('show_tabel_presensi_peserta_magang', { tgl: tgl }, function (response) {
        try {
            const json = JSON.parse(response); // Pastikan server kirim JSON valid
            $('#tabelPresensiPesertaMagang').html(''); // kosongkan wrapper

            if (!json.data_peserta || json.data_peserta.length === 0) {
                // Kalau kosong
                $('#tabelPresensiPesertaMagang').html(`
                    <div class="alert border-0 border-start border-5 border-info alert-dismissible fade show py-2">
                        <div class="d-flex align-items-center">
                            <div class="font-35 text-info"><i class='bx bx-info-square'></i></div>
                            <div class="ms-3">
                                <h6 class="mb-0 text-info">Informasi</h6>
                                <div>Belum Ada Peserta Magang Yang Diinput. Terima kasih.</div>
                            </div>
                        </div>
                    </div>
                `);
                return;
            }

            // Kalau ada data, buat tabelnya
            let data = `
                <div class="table-responsive">
                <table id="tabelPresensiPesertaMagangData" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA PESERTA</th>
                            <th>JAM DATANG</td>
                            <th>JAM PULANG</th>
                            <th>KETERANGAN></th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            json.data_peserta.forEach((row, index) => {

                let badgeMasuk = '';
                let badgePulang = '';

                if (row.masuk) {
                    badgeMasuk = `<span class="badge bg-success p-2" onclick="lihatFoto('${row.presensi_id}', '1')">${row.masuk}</span>`;
                } else {
                    badgeMasuk = `<span class="badge bg-danger p-2">Belum Presensi</span>`;
                }

                if (row.pulang) {
                    badgePulang = `<span class="badge bg-success p-2" onclick="lihatFoto('${row.presensi_id}', '2')">${row.pulang}</span>`;
                } else {
                    badgePulang = `<span class="badge bg-danger p-2">Belum Presensi</span>`;
                }

                // Baris tabel
                data += `
                    <tr>
                        <td>${index + 1}</td>
                        <td><button onclick="EditPresensi('${row.presensi_id}','${row.id}')" style="background: transparent; border: none !important;">
                            <p class="text-white">${row.nama}</p>
                            </button>
                        </td>
                        <td>${badgeMasuk}</td>
                        <td>${badgePulang}</td>
                        <td>${row.keterangan}</td>
                    </tr>
                `;
            });

            data += `
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>NO</th>
                            <th>NAMA PESERTA</th>
                            <th>JAM DATANG</td>
                            <th>JAM PULANG</th>
                            <th>KETERANGAN></th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            `;

            $('#tabelPresensiPesertaMagang').append(data);

            // Aktifkan DataTables
            $("#tabelPresensiPesertaMagangData").DataTable();
        } catch (e) {
            console.error("Gagal parsing JSON:", e);
            $('#tabelPresensiPesertaMagang').html('<div class="alert alert-danger">Gagal memuat data presensi peserta magang.</div>');
        }
    });
}

function cariPresensi() {
    var tanggal = document.getElementById('tglPresensi').value;
    loadTabelPresensiPesertaMagang(tanggal);
}

function EditPresensi(presensi_id, peserta_id) {
    var tanggal = document.getElementById('tglPresensi').value;
    $.post('edit_presensi', {
        presensi_id: presensi_id, peserta_id: peserta_id
    }, function (response) {
        var json = jQuery.parseJSON(response);
        if (json.st == 1) {
            $("#edit-presensi").modal('show');
            $("#judul_").html("");
            $("#id").val('');
            $('#nama').val('');
            $("#peserta_id").val('');
            $("#jam_datang").val('');
            $("#jam_pulang").val('');
            $("#ket_").html('');
            $('#tgl').val('');

            $("#judul_").append(json.judul);
            $("#id").val(json.id);
            $("#peserta_id").val(json.peserta_id);
            $('#nama').val(json.nama);
            $('#tgl').val(tanggal);

            // set nilai default
            const jamDatang = json.masuk ? json.masuk : '';
            const jamPulang = json.pulang ? json.pulang : '';

            // isi value input
            $("#jam_datang").val(jamDatang);
            $("#jam_pulang").val(jamPulang);

            // aktifkan flatpickr setelah modal ditampilkan
            const jam_datang = flatpickr("#jam_datang", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i:S",
                time_24hr: true,
                defaultDate: jamDatang || null,
                minuteIncrement: 1,
                allowInput: true
            });

            const jam_pulang = flatpickr("#jam_pulang", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i:S",
                time_24hr: true,
                defaultDate: jamPulang || null,
                minuteIncrement: 1,
                allowInput: true
            });

            $("#ket_").append(json.ket);
            $('#ket').select2({
                theme: 'bootstrap4',
                dropdownParent: $('#edit-presensi'),
                width: '100%',
            });

            document.getElementById('hapus_datang').addEventListener('click', () => {
                jam_datang.clear();
            });

            document.getElementById('hapus_pulang').addEventListener('click', () => {
                jam_pulang.clear();
            });
        } else if (json.st == 0) {
            pesan('PERINGATAN', json.msg, '');
            $('#table_pegawai').DataTable().ajax.reload();
        }
    });
}

function lihatFoto(presensi_id, jenis) {
    $.post('lihat_foto', {
        presensi_id: presensi_id, jenis: jenis
    }, function (response) {
        var json = jQuery.parseJSON(response);
        if (json.st == 1) {
            $("#lihat-foto").modal('show');
            $("#judul_modal").html("");
            $("#foto_").html("");

            $("#judul_modal").append(json.judul);
            $("#foto_").append(`
                <img class="text-center" src="${json.foto}" width="100%">
                `);

        } else if (json.st == 0) {
            pesan('PERINGATAN', json.msg, '');
            $('#table_pegawai').DataTable().ajax.reload();
        }
    });
}

function cetakPresensi() {
    $("#cetak-presensi").modal('show');
    flatpickr('#tgl_awal, #tgl_akhir', {
        altFormat: 'l, d F Y',
        altInput: true,
        dateFormat: 'Y-m-d',
        locale: {
            firstDayOfWeek: 7,
            weekdays: {
                shorthand: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                longhand: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
            },
            months: {
                shorthand: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                    'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                longhand: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            },
        }
    });

    $.post('show_lis_peserta', function (response) {
        var json = jQuery.parseJSON(response);
        if (json.st == 1) {
            $("#peserta_").html("");

            $("#peserta_").append(json.peserta);

            $('#peserta').select2({
                theme: 'bootstrap4',
                dropdownParent: $('#cetak-presensi'),
                width: '100%',
            });
        }
    });
}
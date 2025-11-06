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
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
        <h6 class="mb-0 text-uppercase">Dashboard</h6>
        <hr />

        <!-- Statistik Cards -->
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4" id="statistikCards">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Peserta</p>
                                <h4 class="my-1" id="totalPeserta">-</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                                <i class='bx bx-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Peserta Aktif</p>
                                <h4 class="my-1" id="pesertaAktif">-</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto">
                                <i class='bx bx-user-check'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Presensi Masuk Hari Ini</p>
                                <h4 class="my-1" id="presensiMasuk">-</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
                                <i class='bx bx-log-in'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Belum Presensi</p>
                                <h4 class="my-1" id="belumPresensi">-</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto">
                                <i class='bx bx-time-five'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Chart Presensi 7 Hari Terakhir -->
            <div class="col-12 col-lg-8">
                <div class="card radius-10">
                    <div class="card-header bg-transparent">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Grafik Presensi 7 Hari Terakhir</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="chartPresensi" style="min-height: 300px;"></div>
                    </div>
                </div>
            </div>

            <!-- Info Tambahan -->
            <div class="col-12 col-lg-4">
                <div class="card radius-10">
                    <div class="card-header bg-transparent">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Informasi</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class='bx bx-calendar-check text-success me-2 font-24'></i>
                                <div>
                                    <p class="mb-0">Presensi Pulang Hari Ini</p>
                                    <h5 class="mb-0" id="presensiPulang">-</h5>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class='bx bx-user-x text-danger me-2 font-24'></i>
                                <div>
                                    <p class="mb-0">Peserta Tidak Aktif</p>
                                    <h5 class="mb-0" id="pesertaTidakAktif">-</h5>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="d-grid">
                            <a href="javascript:;" data-page="laporan_presensi" class="btn btn-primary">
                                <i class='bx bx-file me-1'></i>Lihat Laporan Presensi
                            </a>
                        </div>
                        <div class="d-grid mt-2">
                            <a href="javascript:;" data-page="manage_peserta" class="btn btn-outline-primary">
                                <i class='bx bx-user-plus me-1'></i>Kelola Peserta
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Presensi Terbaru -->
        <div class="row">
            <div class="col-12">
                <div class="card radius-10">
                    <div class="card-header bg-transparent">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Presensi Terbaru</h6>
                            </div>
                            <div class="ms-auto">
                                <a href="javascript:;" data-page="laporan_presensi" class="btn btn-sm btn-outline-primary">
                                    Lihat Semua <i class='bx bx-right-arrow-alt'></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" id="tabelPresensiTerbaru">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peserta</th>
                                        <th>Tanggal</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Pulang</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyPresensiTerbaru">
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ApexCharts -->
<script src="<?= base_url('assets/plugins/apexcharts-bundle/js/apexcharts.min.js') ?>"></script>

<script>
$(document).ready(function() {
    // Tunggu ApexCharts selesai load
    if (typeof ApexCharts === 'undefined') {
        // Jika ApexCharts belum load, tunggu sebentar
        setTimeout(function() {
            loadStatistikDashboard();
        }, 500);
    } else {
        loadStatistikDashboard();
    }
    
    // Auto refresh setiap 5 menit
    setInterval(function() {
        loadStatistikDashboard();
    }, 300000); // 5 menit
});

function loadStatistikDashboard() {
    $.ajax({
        url: 'get_statistik_dashboard',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Update statistik cards
            $('#totalPeserta').text(response.total_peserta);
            $('#pesertaAktif').text(response.peserta_aktif);
            $('#presensiMasuk').text(response.sudah_presensi_masuk);
            $('#belumPresensi').text(response.belum_presensi);
            $('#presensiPulang').text(response.sudah_presensi_pulang);
            $('#pesertaTidakAktif').text(response.peserta_tidak_aktif);
            
            // Update chart
            updateChart(response.chart_data);
            
            // Update tabel presensi terbaru
            updateTabelPresensiTerbaru(response.presensi_terbaru);
        },
        error: function() {
            console.error('Gagal memuat statistik dashboard');
        }
    });
}

function updateChart(chartData) {
    var categories = chartData.map(function(item) {
        return item.hari + ' (' + item.tanggal + ')';
    });
    var seriesData = chartData.map(function(item) {
        return item.total;
    });
    
    var options = {
        series: [{
            name: 'Total Presensi',
            data: seriesData
        }],
        chart: {
            type: 'area',
            height: 300,
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: true
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        colors: ['#5e72e4'],
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.3,
                stops: [0, 90, 100]
            }
        },
        xaxis: {
            categories: categories,
            labels: {
                style: {
                    colors: '#6c757d',
                    fontSize: '12px',
                    fontWeight: 500
                }
            },
            axisBorder: {
                color: '#dee2e6'
            }
        },
        yaxis: {
            title: {
                text: 'Jumlah Presensi',
                style: {
                    color: '#6c757d',
                    fontSize: '12px',
                    fontWeight: 500
                }
            },
            labels: {
                style: {
                    colors: '#6c757d',
                    fontSize: '12px',
                    fontWeight: 500
                }
            },
            min: 0
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " peserta";
                }
            }
        },
        grid: {
            borderColor: '#f1f1f1',
        }
    };
    
    var chartElement = document.querySelector("#chartPresensi");
    
    if (!chartElement) {
        console.error('Chart element tidak ditemukan');
        return;
    }
    
    // Jika chart sudah ada, update data saja
    if (window.chartPresensi && typeof window.chartPresensi.updateSeries === 'function') {
        try {
            window.chartPresensi.updateSeries([{
                name: 'Total Presensi',
                data: seriesData
            }]);
            window.chartPresensi.updateOptions({
                xaxis: {
                    categories: categories
                }
            });
        } catch(e) {
            console.log('Error updating chart, creating new one:', e);
            // Jika update gagal, buat chart baru
            createNewChart(chartElement, options);
        }
    } else {
        // Jika chart belum ada, buat chart baru
        createNewChart(chartElement, options);
    }
}

function createNewChart(chartElement, options) {
    // Kosongkan container chart terlebih dahulu
    if (chartElement) {
        chartElement.innerHTML = '';
    }
    
    // Buat chart baru
    if (typeof ApexCharts !== 'undefined') {
        window.chartPresensi = new ApexCharts(chartElement, options);
        window.chartPresensi.render();
    } else {
        console.error('ApexCharts library tidak ditemukan');
    }
}

function updateTabelPresensiTerbaru(data) {
    var tbody = $('#tbodyPresensiTerbaru');
    tbody.empty();
    
    if (data.length === 0) {
        tbody.append('<tr><td colspan="5" class="text-center">Belum ada data presensi</td></tr>');
        return;
    }
    
    data.forEach(function(item, index) {
        var row = '<tr>' +
            '<td>' + (index + 1) + '</td>' +
            '<td><strong>' + item.nama + '</strong></td>' +
            '<td>' + item.tanggal + '</td>' +
            '<td><span class="badge bg-success">' + item.masuk + '</span></td>' +
            '<td><span class="badge bg-info">' + item.pulang + '</span></td>' +
            '</tr>';
        tbody.append(row);
    });
}
</script>

<style>
.widgets-icons-2 {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.bg-gradient-scooter {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-bloody {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.bg-gradient-blooker {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.bg-gradient-orange {
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
}
</style>


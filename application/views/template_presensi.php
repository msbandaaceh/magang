<!DOCTYPE html>

<head>
    <style>
        @page {
            margin-top: 2cm;
            margin-bottom: 2.5cm;
            margin-left: 3cm;
            margin-right: 2cm;
        }

        .notulen {
            text-align: left;
            vertical-align: top;
        }

        body {
            font-family: 'BookmanOldStyle', serif;
            font-size: 12pt;
        }

        div {
            border-bottom-style: none;
        }

        #footer {
            position: fixed;
            bottom: -3cm;
            left: 0;
            right: 0;
            height: 2cm;
            text-align: left;
            font-size: 10pt;
            color: #777;
        }

        #tabel1 {
            border-collapse: collapse;
            width: 100%;
        }

        #tabel1 th,
        #tabel1 td {
            border: 1px solid #333;
            /* warna border */
            padding: 6px 8px;
            /* padding agar teks tidak terlalu mepet */
            vertical-align: middle;
        }

        #tabel1 thead th {
            background-color: #f2f2f2;
            /* warna latar header */
            color: #000;
            text-align: center;
        }

        #tabel1 tbody tr:nth-child(even) {
            background-color: #f9f9f9;
            /* striping baris genap */
        }

        #tabel1 tbody tr:hover {
            background-color: #e6f7ff;
            /* efek hover */
        }
    </style>
</head>

<body>
    <table style="border:none; width:100%;">
        <tr>
            <td style="text-align:center; border:none;">
                <img src="<?= $kop ?>" style="max-width:100%; height:auto;">
            </td>
        </tr>
    </table>
    <br />
    <table style="border:none; width:100%; font-family: 'BookmanOldStyle', serif; font-size: 12pt;">
        <tr>
            <td style="text-align:center; border:none;" colspan=3>
                <h3>DAFTAR KEHADIRAN MAHASISWA MAGANG</h3>
            </td>
        </tr>
        <tr>
            <td style="border:none;width:30%;" class="notulen">NIM</td>
            <td style="border:none;width:2%;" class="notulen">:</td>
            <td style="border:none;width:68%;text-align: justify;" class="notulen"><?= $nim ?>
            </td>
        </tr>
        <tr>
            <td style="border:none;" class="notulen">Nama Mahasiswa</td>
            <td style="border:none;" class="notulen">:</td>
            <td style="border:none;text-align: justify;" class="notulen"><?= $nama ?></td>
        </tr>
        <tr>
            <td style="border:none;" class="notulen">Program Studi</td>
            <td style="border:none;" class="notulen">:</td>
            <td style="border:none;text-align: justify;" class="notulen"><?= $prodi ?></td>
        </tr>

        <tr>
            <td style="border:none;" class="notulen">Nama Perguruan Tinggi</td>
            <td style="border:none;" class="notulen">:</td>
            <td colspan="2" style="border:none;text-align: justify;" class="notulen">
                <?= $nama_pt ?>
            </td>
        </tr>
        <tr>
            <td style="border:none;" class="notulen">Tempat Magang</td>
            <td style="border:none;" class="notulen">:</td>
            <td style="border:none;text-align: justify;" class="notulen"><?= $satker ?></td>
        </tr>

    </table>
    <br />

    <div style="text-align: justify; margin-bottom: 5px;">
        <table id="tabel1" class="table table-bordered table-hover"
            style="font-family: 'BookmanOldStyle', serif; font-size: 12pt;">
            <thead>
                <tr>
                    <th class="text-center" style="width: 1%">NO</th>
                    <th class="text-center" style="width: 35%">HARI, TANGGAL</th>
                    <th class="text-center">JAM DATANG</th>
                    <th class="text-center">JAM PULANG</th>
                    <th class="text-center">KETERANGAN</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($data_presensi as $row) {
                    ?>
                    <tr>
                        <td class="text-center" style="padding: 1px">
                            <?= $no; ?>
                        </td>
                        <td class="text-center" style="padding: 1px">
                            <?= $row['tanggal']; ?>
                        </td>
                        <td class="text-center" style="padding: 1px">
                            <?= $row['masuk']; ?>
                        </td>
                        <td class="text-center" style="padding: 1px">
                            <?= $row['pulang']; ?>
                        </td>
                        <td class="text-center" style="padding: 1px">
                            <?= $row['ket']; ?>
                        </td>
                    </tr>
                    <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <div id="footer">
        <em>Generate dari
            <?= $this->session->userdata('nama_app') . ' ' . ucwords(strtolower($this->session->userdata('nama_pengadilan'))) ?>
            - <?= date('Y-m-d H:i:s') ?></em>
    </div>
</body>

</html>
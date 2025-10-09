<?php

class HalamanLaporan extends MY_Controller
{
    public function show_tabel_presensi_peserta_magang()
    {
        $tgl = $this->input->post('tgl');
        $query = $this->model->get_presensi_harian($tgl);
        $data = [];
        foreach ($query as $row) {

            if (!$row->keterangan)
                $keterangan = '';
            else
                $keterangan = $row->keterangan;

            if (!$row->presensi_id)
                $presensi_id = '-1';
            else
                $presensi_id = $row->presensi_id;

            $data[] = [
                'id' => base64_encode($this->encryption->encrypt($row->id)),
                'presensi_id' => base64_encode($this->encryption->encrypt($presensi_id)),
                'masuk' => $row->masuk,
                'pulang' => $row->pulang,
                'nama' => $row->nama,
                'keterangan' => $keterangan
            ];
        }

        echo json_encode(['data_peserta' => $data]);
    }

    public function edit_presensi()
    {
        $presensi_id = $this->encryption->decrypt(base64_decode($this->input->post('presensi_id')));
        $peserta_id = $this->encryption->decrypt(base64_decode($this->input->post('peserta_id')));

        $ket = array(
            '' => "-- Keterangan --",
            'Manual Presensi' => 'Manual Presensi',
            'Tidak Presensi' => 'Tidak Presensi',
            'Izin Terlambat Masuk' => 'Izin Terlambat Masuk',
            'Izin Tidak Masuk' => 'Izin Tidak Masuk',
            'Izin Pulang Cepat' => 'Izin Pulang Cepat',
            'Izin Kuliah' => 'Izin Kuliah',
            'Tanpa Keterangan' => 'Tanpa Keterangan',
            'Sakit' => 'Sakit'
        );

        $nama = $this->model->get_seleksi_array('register_peserta_magang', ['id' => $peserta_id])->row()->nama;

        if ($presensi_id == "-1") {
            $masuk = "";
            $pulang = "";
            $ktrngn = form_dropdown('ket', $ket, '', 'class="form-control select2" id="ket"');
        } else {
            $cariPresensi = $this->model->get_seleksi_array('register_presensi_magang', ['id' => $presensi_id])->row();
            if ($cariPresensi->masuk) {
                $masuk = $cariPresensi->masuk;
            } else {
                $masuk = "";
            }
            if ($cariPresensi->pulang) {
                $pulang = $cariPresensi->pulang;
            } else {
                $pulang = "";
            }
            $ketCari = $cariPresensi->ket;
            $ktrngn = form_dropdown('ket', $ket, $ketCari, 'class="form-control select2" id="ket"');
        }

        echo json_encode(
            array(
                'st' => 1,
                'id' => base64_encode($this->encryption->encrypt($presensi_id)),
                'peserta_id' => base64_encode($this->encryption->encrypt($peserta_id)),
                'judul' => 'EDIT PRESENSI PESERTA MAGANG',
                'nama' => $nama,
                'masuk' => $masuk,
                'pulang' => $pulang,
                'ket' => $ktrngn
            )
        );
        return;
    }

    public function simpan_edit_presensi()
    {

        $data = [
            'presensi_id' => $this->encryption->decrypt(base64_decode($this->input->post('id'))),
            'peserta_id' => $this->encryption->decrypt(base64_decode($this->input->post('peserta_id'))),
            'tanggal' => $this->input->post('tanggal'),
            'jam_datang' => $this->input->post('jam_datang'),
            'jam_pulang' => $this->input->post('jam_pulang'),
            'ket' => $this->input->post('ket')
        ];

        $result = $this->model->proses_simpan_edit_presensi($data);
        if ($result['status']) {
            echo json_encode(['success' => 1, 'message' => $result['message']]);
        } else {
            echo json_encode(['success' => 3, 'message' => $result['message']]);
        }
    }

    public function lihat_foto()
    {
        $presensi_id = $this->encryption->decrypt(base64_decode($this->input->post('presensi_id')));
        $jenis = $this->input->post('jenis');

        $data_presensi = $this->model->get_seleksi_array('register_presensi_magang', ['id' => $presensi_id]);
        if ($jenis == '1')
            $foto = $data_presensi->row()->foto_masuk;
        else
            $foto = $data_presensi->row()->foto_pulang;

        echo json_encode(
            array(
                'st' => 1,
                'foto' => site_url($foto),
                'judul' => 'FOTO PRESENSI PESERTA MAGANG'
            )
        );

        return;

    }
}
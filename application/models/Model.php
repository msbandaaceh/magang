<?php

class Model extends CI_Model
{
    private $db_sso;

    public function __construct()
    {
        parent::__construct();

        // Inisialisasi variabel private dengan nilai dari session
        $this->db_sso = $this->session->userdata('sso_db');
    }

    private function add_audittrail($action, $title, $table, $descrip)
    {

        $params = [
            'tabel' => 'sys_audittrail',
            'data' => [
                'datetime' => date("Y-m-d H:i:s"),
                'ipaddress' => $this->input->ip_address(),
                'action' => $action,
                'title' => $title,
                'tablename' => $table,
                'description' => $descrip,
                'username' => $this->session->userdata('username')
            ]
        ];

        $this->apihelper->post('apiclient/simpan_data', $params);
    }

    public function cek_aplikasi($id)
    {
        $params = [
            'tabel' => 'ref_client_app',
            'kolom_seleksi' => 'id',
            'seleksi' => $id
        ];

        $result = $this->apihelper->get('apiclient/get_data_seleksi', $params);

        if ($result['status_code'] === 200 && $result['response']['status'] === 'success') {
            $user_data = $result['response']['data'][0];
            $this->session->set_userdata(
                [
                    'nama_client_app' => $user_data['nama_app'],
                    'deskripsi_client_app' => $user_data['deskripsi']
                ]
            );
        }
    }

    public function kirim_notif($data)
    {
        $params = [
            'tabel' => 'sys_notif',
            'data' => $data
        ];

        $this->apihelper->post('apiclient/simpan_data', $params);
    }

    public function get_seleksi_array($tabel, $where = [], $order_by = [])
    {
        try {
            $this->db->where('hapus', '0');

            // multiple where
            if (!empty($where)) {
                foreach ($where as $kolom => $nilai) {
                    $this->db->where($kolom, $nilai);
                }
            }

            // multiple order by
            if (!empty($order_by)) {
                foreach ($order_by as $kolom => $arah) {
                    $this->db->order_by($kolom, $arah); // ASC / DESC
                }
            }

            return $this->db->get($tabel);
        } catch (Exception $e) {
            return 0;
        }
    }

    public function get_presensi_harian($tanggal)
    {
        $this->db->select('p.id AS id, p.nama AS nama, pr.id AS presensi_id, pr.masuk AS masuk, pr.pulang AS pulang, p.status AS status, pr.ket AS keterangan');
        $this->db->from('register_peserta_magang p');
        $this->db->join(
            'register_presensi_magang pr',
            "p.id = pr.peserta_id AND DATE(pr.tgl) = " . $this->db->escape($tanggal),
            'left'
        );
        $this->db->order_by('status', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function simpan_data($tabel, $data)
    {
        try {
            $this->db->insert($tabel, $data);
            $title = "Simpan Data <br />Update tabel <b>" . $tabel . "</b>[]";
            $descrip = null;
            $this->add_audittrail("INSERT", $title, $tabel, $descrip);
            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function pembaharuan_data($tabel, $data, $kolom_seleksi, $seleksi)
    {
        try {
            $this->db->where($kolom_seleksi, $seleksi);
            $this->db->update($tabel, $data);
            $title = "Pembaharuan Data <br />Update tabel <b>" . $tabel . "</b>[Pada kolom<b>" . $kolom_seleksi . "</b>]";
            $descrip = null;
            $this->add_audittrail("UPDATE", $title, $tabel, $descrip);
            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function proses_simpan_peserta_magang($data)
    {
        $dataPeserta = [
            'nim' => $data['nim'],
            'nama' => $data['nama'],
            'nama_pt' => $data['nama_pt'],
            'program_studi' => $data['prodi'],
            'status' => $data['status'],
            'hp' => $data['hp']
        ];

        if ($data['id'] == '-1') {
            $dataPeserta['created_on'] = date('Y-m-d H:i:s');
            $dataPeserta['created_by'] = $this->session->userdata('fullname');
            $query = $this->simpan_data('register_peserta_magang', $dataPeserta);
        } else {
            $dataPeserta['modified_on'] = date('Y-m-d H:i:s');
            $dataPeserta['modified_by'] = $this->session->userdata('fullname');
            $query = $this->pembaharuan_data('register_peserta_magang', $dataPeserta, 'id', $data['id']);
        }

        if ($query == 1) {
            if ($data['id'] == '-1')
                return ['status' => true, 'message' => 'Peserta Magang Berhasil Disimpan'];
            else
                return ['status' => true, 'message' => 'Peserta Magang Berhasil Diperbarui'];
        } else
            return ['status' => false, 'message' => 'Gagal Simpan Peserta, Silakan Ulangi Lagi'];
    }

    function proses_simpan_edit_presensi($data)
    {

        if ($data['presensi_id'] <> '-1') {
            $dataPresensi = array(
                'tgl' => $data['tanggal'],
                'peserta_id' => $data['peserta_id'],
                'masuk' => $data['jam_datang'],
                'pulang' => $data['jam_pulang'],
                'ket' => $data['ket'],
                'modified_by' => $this->session->userdata('fullname'),
                'modified_on' => date('Y-m-d H:i:s')
            );

            $querySimpan = $this->pembaharuan_data('register_presensi_magang', $dataPresensi, 'id', $data['presensi_id']);

        } else {
            $dataPresensi = array(
                'tgl' => $data['tanggal'],
                'peserta_id' => $data['peserta_id'],
                'masuk' => $data['jam_datang'],
                'pulang' => $data['jam_pulang'],
                'ket' => $data['ket'],
                'created_by' => $this->session->userdata('fullname'),
                'created_on' => date('Y-m-d H:i:s')
            );

            $querySimpan = $this->simpan_data('register_presensi_magang', $dataPresensi);
        }

        if ($querySimpan == 1) {
            if ($data['presensi_id'] == '-1')
                return ['status' => true, 'message' => 'Presensi Peserta Magang Berhasil Disimpan'];
            else
                return ['status' => true, 'message' => 'Presensi Peserta Magang Berhasil Diperbarui'];
        } else
            return ['status' => false, 'message' => 'Gagal Simpan Presensi Peserta, Silakan Ulangi Lagi'];
    }

    function get_data_presensi($peserta_id, $tgl_awal, $tgl_akhir)
    {
        // Ambil data presensi dari database
        $this->db->select('tgl, masuk, pulang, ket');
        $this->db->from('register_presensi_magang');
        $this->db->where('peserta_id', $peserta_id);
        $this->db->where('tgl >=', $tgl_awal);
        $this->db->where('tgl <=', $tgl_akhir);
        $query = $this->db->get();
        $result = $query->result_array();

        // Simpan hasil query ke array asosiatif dengan key tanggal
        $presensi_data = [];
        foreach ($result as $row) {
            $presensi_data[$row['tgl']] = $row;
        }

        // Buat daftar tanggal dari tgl_awal ke tgl_akhir
        $start = new DateTime($tgl_awal);
        $end = new DateTime($tgl_akhir);
        $end->modify('+1 day');

        $period = new DatePeriod($start, new DateInterval('P1D'), $end);

        $data_tampil = [];

        foreach ($period as $date) {
            $tgl = $date->format("Y-m-d");
            $hari = $date->format("N"); // 1 = Senin ... 7 = Minggu

            // Jika Sabtu/Minggu
            if ($hari == 6 || $hari == 7) {
                $data_tampil[] = [
                    'tanggal' => $this->tanggalhelper->convertDayDate($tgl),
                    'masuk' => 'Hari Libur',
                    'pulang' => 'Hari Libur',
                    'ket' => ''
                ];
                continue;
            }

            // Jika tanggal merah (API)
            $params = [
                'api_key' => $this->config->item('api_key'),
                'tgl' => $tgl
            ];

            $result = $this->apihelper->get($this->config->item('api_izincuti') . '/cek_tgl_merah', $params);
            if ($result['status_code'] == 200 && $result['response']['status'] == 'success') {
                $data_tampil[] = [
                    'tanggal' => $this->tanggalhelper->convertDayDate($tgl),
                    'masuk' => 'Hari Libur',
                    'pulang' => 'Hari Libur',
                    'ket' => ''
                ];
                continue;
            }

            // Ambil data presensi jika ada
            if (isset($presensi_data[$tgl])) {
                $masuk = $presensi_data[$tgl]['masuk'];
                $pulang = $presensi_data[$tgl]['pulang'];

                $data_tampil[] = [
                    'tanggal' => $this->tanggalhelper->convertDayDate($tgl),
                    'masuk' => ($masuk && $masuk != '00:00:00') ? $masuk : 'Tidak Presensi',
                    'pulang' => ($pulang && $pulang != '00:00:00') ? $pulang : 'Tidak Presensi',
                    'ket' => $presensi_data[$tgl]['ket']
                ];
            } else {
                $data_tampil[] = [
                    'tanggal' => $this->tanggalhelper->convertDayDate($tgl),
                    'masuk' => 'Tidak Presensi',
                    'pulang' => 'Tidak Presensi',
                    'ket' => ''
                ];
            }
        }

        return $data_tampil;
    }
}
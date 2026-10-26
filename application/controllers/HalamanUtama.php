<?php

class HalamanUtama extends MY_Controller
{
    public function index()
    {
        #die(var_dump($this->session->all_userdata()));
        $data['peran'] = $this->session->userdata('peran');
        $data['page'] = 'dashboard';
        $data['sso'] = $this->config->item('sso_server');

        $this->load->view('layout', $data);
    }

    public function page($halaman)
    {
        // Amanin nama file view agar tidak sembarang file bisa diload
        $allowed = [
            'dashboard',
            'manage_peserta',
            'laporan_presensi',
            'panduan_penggunaan',
            'dokumentasi_teknis'
        ];

        if (in_array($halaman, $allowed)) {
            // Cek akses untuk dokumentasi teknis (hanya admin)
            if ($halaman == 'dokumentasi_teknis') {
                $role = $this->session->userdata('role');
                $peran = $this->session->userdata('peran');
                $is_admin = ($peran == 'admin' || in_array($role, ['super', 'validator_uk_satker', 'admin_satker']));
                
                if (!$is_admin) {
                    show_404();
                    return;
                }
            }
            
            $data['peran'] = $this->session->userdata('peran');
            $data['page'] = $halaman;

            $this->load->view($halaman, $data);
        } else {
            show_404();
        }
    }

    public function cek_token_sso()
    {
        $token = $this->input->cookie('sso_token');
        $cookie_domain = $this->config->item('sso_server');
        $sso_api = $cookie_domain . "api/cek_token?sso_token={$token}";
        $response = file_get_contents($sso_api);
        $data = json_decode($response, true);

        if ($data['status'] == 'success') {
            echo json_encode(['valid' => true]);
        } else {
            echo json_encode(['valid' => false, 'message' => 'Token Expired, Silakan login ulang', 'url' => $cookie_domain . 'login']);
        }
    }

    public function keluar()
    {
        $sso_server = $this->config->item('sso_server');
        $this->session->sess_destroy();
        redirect($sso_server . '/keluar');
    }

    public function get_statistik_dashboard()
    {
        $this->load->model('Model', 'model');
        $tanggal_hari_ini = date('Y-m-d');
        
        // Total peserta
        $total_peserta = $this->model->get_seleksi_array('register_peserta_magang')->num_rows();
        
        // Peserta aktif
        $peserta_aktif = $this->model->get_seleksi_array('register_peserta_magang', ['status' => '1'])->num_rows();
        
        // Peserta tidak aktif
        $peserta_tidak_aktif = $this->model->get_seleksi_array('register_peserta_magang', ['status' => '0'])->num_rows();
        
        // Presensi hari ini
        $presensi_hari_ini = $this->model->get_presensi_harian($tanggal_hari_ini);
        $sudah_presensi_masuk = 0;
        $sudah_presensi_pulang = 0;
        $belum_presensi = 0;
        
        foreach ($presensi_hari_ini as $row) {
            if ($row->status == '1') { // Hanya hitung peserta aktif
                if ($row->masuk) {
                    $sudah_presensi_masuk++;
                }
                if ($row->pulang) {
                    $sudah_presensi_pulang++;
                }
                if (!$row->masuk && !$row->pulang) {
                    $belum_presensi++;
                }
            }
        }
        
        // Data presensi 7 hari terakhir untuk chart
        $data_chart = [];
        for ($i = 6; $i >= 0; $i--) {
            $tanggal = date('Y-m-d', strtotime("-$i days"));
            $hari = $this->tanggalhelper->convertDayDate($tanggal);
            $presensi_tgl = $this->model->get_presensi_harian($tanggal);
            $total_presensi = 0;
            foreach ($presensi_tgl as $row) {
                if ($row->status == '1' && ($row->masuk || $row->pulang)) {
                    $total_presensi++;
                }
            }
            $data_chart[] = [
                'tanggal' => date('d/m', strtotime($tanggal)),
                'hari' => explode(', ', $hari)[0], // Ambil nama hari saja
                'total' => $total_presensi
            ];
        }
        
        // Presensi terbaru (5 terakhir)
        $this->db->select('p.nama, pr.tgl, pr.masuk, pr.pulang');
        $this->db->from('register_presensi_magang pr');
        $this->db->join('register_peserta_magang p', 'p.id = pr.peserta_id', 'left');
        $this->db->where('p.status', '1');
        $this->db->order_by('pr.created_on', 'DESC');
        $this->db->limit(5);
        $presensi_terbaru = $this->db->get()->result();
        
        $data_presensi_terbaru = [];
        foreach ($presensi_terbaru as $row) {
            $data_presensi_terbaru[] = [
                'nama' => $row->nama,
                'tanggal' => $this->tanggalhelper->convertDayDate($row->tgl),
                'masuk' => $row->masuk ? $this->tanggalhelper->konversiJam($row->masuk) : '-',
                'pulang' => $row->pulang ? $this->tanggalhelper->konversiJam($row->pulang) : '-'
            ];
        }
        
        echo json_encode([
            'total_peserta' => $total_peserta,
            'peserta_aktif' => $peserta_aktif,
            'peserta_tidak_aktif' => $peserta_tidak_aktif,
            'sudah_presensi_masuk' => $sudah_presensi_masuk,
            'sudah_presensi_pulang' => $sudah_presensi_pulang,
            'belum_presensi' => $belum_presensi,
            'chart_data' => $data_chart,
            'presensi_terbaru' => $data_presensi_terbaru
        ]);
    }

    /**
     * Data bersama untuk manual book (PDF & Word).
     */
    private function _manual_book_data()
    {
        $role = $this->session->userdata('role');
        $peran = $this->session->userdata('peran');

        return [
            'presensi_url' => site_url('presensi'),
            'nama_app' => $this->session->userdata('nama_client_app'),
            'deskripsi' => $this->session->userdata('deskripsi_client_app'),
            'satker' => $this->session->userdata('nama_pengadilan'),
            'tanggal_cetak' => date('d/m/Y H:i'),
            'is_admin_menu' => ($peran == 'admin' || in_array($role, ['super', 'validator_uk_satker', 'admin_satker'])),
        ];
    }

    /**
     * Unduh manual book PDF (dompdf) — kotak putus-putus untuk penanda tempat screenshot.
     */
    public function unduh_manual_pdf()
    {
        $data = $this->_manual_book_data();
        $html = $this->load->view('manual_book_pdf', $data, true);
        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->set_option('isRemoteEnabled', false);
        $this->pdf->set_option('defaultFont', 'DejaVu Sans');
        $this->pdf->render();
        $this->pdf->stream('Manual_Book_LEUMANG_' . date('Y-m-d') . '.pdf', ['Attachment' => true]);
    }

    /**
     * Unduh manual book untuk diedit di Microsoft Word (HTML sebagai .doc).
     * Buka di Word, tempel screenshot di kotak, lalu Simpan sebagai .docx atau ekspor PDF dari Word.
     */
    public function unduh_manual_word()
    {
        $data = $this->_manual_book_data();
        $filename = 'Manual_Book_LEUMANG_' . date('Y-m-d') . '.doc';
        header('Content-Description: File Transfer');
        header('Content-Type: application/msword; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');
        echo "\xEF\xBB\xBF";
        $this->load->view('manual_book_word_html', $data);
    }
}
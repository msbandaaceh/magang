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
            'presensi'
        ];

        if (in_array($halaman, $allowed)) {
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
        $sso_server = $this->item->config('sso_server');
        $this->session->sess_destroy();
        redirect($sso_server . '/keluar');
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'HalamanUtama';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['get_lokasi'] = 'HalamanPresensi/get_lokasi';
$route['simpan_perangkat'] = 'HalamanPresensi/simpan_perangkat';

$route['presensi'] = 'HalamanPresensi/presensi';
$route['show_presensi'] = 'HalamanPresensi/show_presensi';
$route['show_detail_presensi'] = 'HalamanPresensi/show_detail_presensi';
$route['simpan_presensi'] = 'HalamanPresensi/simpan_presensi';
$route['show_tabel_presensi_peserta_magang'] = 'HalamanLaporan/show_tabel_presensi_peserta_magang';
$route['edit_presensi'] = 'HalamanLaporan/edit_presensi';
$route['simpan_edit_presensi'] = 'HalamanLaporan/simpan_edit_presensi';
$route['lihat_foto'] = 'HalamanLaporan/lihat_foto';

$route['show_tabel_peserta_magang'] = 'HalamanMagang/show_tabel_peserta_magang';
$route['show_peserta'] = 'HalamanMagang/show_peserta';
$route['simpan_peserta'] = 'HalamanMagang/simpan_peserta';

$route['cek_token'] = 'HalamanUtama/cek_token_sso';

$route['keluar'] = 'HalamanUtama/keluar';

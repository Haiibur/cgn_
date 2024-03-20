<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Default
$route['default_controller'] = 'Home';

// Menu Login
$route['login']          = 'login';
$route['reset-password'] = 'login/reset_password';
$route['cek-login']      = 'login/ceklogin';

// Menu Level Admin

// Menu Admin
$route['admin'] = 'admin';
$route['simpan-registrasi'] = 'Absen_Kehadiran/simpanRegistrasi';
$route['hadir'] = 'Absen_Kehadiran/simpanRegistrasihadir';
// Menu Profil 
$route['profil']= 'Profil';
$route['form_tambah_profil']      = 'Profil/form_tambah_profil';
$route['form_ubah_profil/(:any)'] = 'Profil/edit_profil/$1';

// Menu Agenda
$route['agenda']                = 'Agenda';
$route['buat_agenda']           = 'Agenda/buat_agd';
$route['ubah_agenda/(:any)']    = 'Agenda/edit_agd/$1';
$route['api/agenda-hari-ini']   = 'Api/agendaToday';
$route['api/agenda-besok']      = 'Api/agendaTomorrow';
$route['api/riwayat-agenda']    = 'Api/agendaRiwayat';

// Menu Provinsi
$route['Provinsi']= 'Provinsi';
$route['form_tambah_provinsi']      = 'Provinsi/form_tambah_provinsi';
$route['form_ubah_provinsi/(:any)'] = 'Provinsi/edit_provinsi/$1';

// Menu Kabupaten
$route['Kabupaten']= 'Kabupaten';
$route['form_tambah_kabupaten']      = 'Kabupaten/form_tambah_kabupaten';
$route['form_ubah_kabupaten/(:any)'] = 'Kabupaten/edit_kabupaten/$1';

// Menu Materi
$route['Materi']= 'Materi';
$route['form_tambah_materi']      = 'Materi/form_tambah_materi';
$route['form_ubah_materi/(:any)'] = 'Materi/edit_materi/$1';

// Menu Galleri
$route['Galleri']= 'Galleri';
$route['form_tambah_galleri']      = 'Galleri/form_tambah_galleri';
$route['form_ubah_galleri/(:any)'] = 'Galleri/edit_galleri/$1';

// Menu Hotel
$route['Hotel']= 'Hotel';
$route['form_tambah_hotel']      = 'Hotel/form_tambah_hotel';
$route['form_ubah_hotel/(:any)'] = 'Hotel/edit_hotel/$1';

// Menu Lokasi Tujuan
$route['Lokasi_Tujuan']                  = 'Lokasi_Tujuan';
$route['form_tambah_lokasi_tujuan']      = 'Lokasi_Tujuan/form_tambah_lokasi_tujuan';
$route['form_ubah_lokasi_tujuan/(:any)'] = 'Lokasi_Tujuan/edit_lokasi_tujuan/$1';

// Menu Lokasi Vanue
$route['Lokasi_Venue']                  = 'Lokasi_Venue';
$route['form_tambah_lokasi_venue']      = 'Lokasi_Venue/form_tambah_lokasi_venue';
$route['form_ubah_lokasi_venue/(:any)'] = 'Lokasi_Venue/edit_lokasi_venue/$1';

// Menu Wisata
$route['Wisata']= 'Wisata';
$route['form_tambah_wisata']      = 'Wisata/form_tambah_wisata';
$route['form_ubah_wisata/(:any)'] = 'Wisata/edit_wisata/$1';

// Menu Level Peserta
$route['Level_Peserta']= 'Level_Peserta';
$route['form_tambah_level_peserta']      = 'Level_Peserta/form_tambah_level_peserta';
$route['form_ubah_level_peserta/(:any)'] = 'Level_Peserta/edit_level_peserta/$1';

// Menu Undangan
$route['Undangan']= 'Undangan';
$route['form_tambah_undangan']      = 'Undangan/form_tambah_undangan';
$route['form_ubah_undangan/(:any)'] = 'Undangan/edit_undangan/$1';

// Menu Pendaftaran
$route['Pendaftaran']= 'Pendaftaran';
$route['form_tambah_pendaftaran']      = 'Pendaftaran/form_tambah_pendaftaran';
$route['form_ubah_pendaftaran/(:any)'] = 'Pendaftaran/edit_pendaftaran/$1';

// Menu Absen Kehadiran
$route['Absen_Kehadiran']= 'Absen_Kehadiran';
$route['form_tambah_absen_kehadiran']      = 'Absen_Kehadiran/form_tambah_absen_kehadiran';
$route['form_ubah_absen_kehadiran/(:any)'] = 'Absen_Kehadiran/edit_absen_kehadiran/$1';

// Menu Produk
$route['Produk']= 'Produk';
$route['form_tambah_produk']      = 'Produk/form_tambah_produk';
$route['form_ubah_produk/(:any)'] = 'Produk/edit_produk/$1';

// Menu Transaksi Order
$route['Transaksi_order']= 'Transaksi_order';
$route['form_tambah_transaksi_order']      = 'Transaksi_order/form_tambah_transaksi_order';
$route['detail_order/(:any)']              = 'Transaksi_order/detail_order/$1';
$route['ubah_transaksi_order/(:any)']      = 'Transaksi_order/edit_transaksi_order/$1';

// Menu FAQ
$route['FAQ']= 'FAQ';
$route['form_tambah_faq']      = 'FAQ/form_tambah_faq';
$route['form_ubah_faq/(:any)'] = 'FAQ/edit_faq/$1';

// Menu Informasi
$route['Informasi']= 'Informasi';
$route['form_tambah_informasi']      = 'Informasi/form_tambah_informasi';
$route['form_ubah_informasi/(:any)'] = 'Informasi/edit_informasi/$1';

// Notfound
$route['404_override'] = '';

$route['translate_uri_dashes'] = FALSE;
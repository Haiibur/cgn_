<?php 
    $req = [
        'method' => 'get',
        'select' => '*',
        'table' => 't_admin',
        'join' => [
            't_level_admin' => 't_level_admin.kd_level=t_admin.level_admin'
        ],
        'where' => [
            'kd_admin' => $this->session->userdata('kd_sesi')
        ]
    ];
    $userdata = $this->Modular->queryBuild($req)->row();
?>

<div class="row mb-3">
    <?php if($userdata->nama_level=="Super Admin"){?>
    <!-- Website -->
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Lokasi_Venue" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Lokasi_Vanue.png');?>" alt="" class="float-right"
                        width="60" />
                    <h6 class="card-title font-weight-bold">Lokasi Venue</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Lokasi Venue</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Lokasi_Tujuan" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Lokasi_Tujuan.png');?>" alt="" class="float-right"
                        width="60" />
                    <h6 class="card-title font-weight-bold">Lokasi Kunjungan</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Lokasi Kunjungan</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Agenda" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Agenda.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Agenda Kegiatan</h6>
                    <h6 class="card-subtitle mb-2 text-muted">Kegiatan Bulan Ini</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Hotel" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Hotel.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Hotel</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Hotel</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <!-- <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Wisata" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Wisata.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Wisata</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Wisata</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div> -->
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Galleri" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Galleri.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Galleri</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Galleri</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>FAQ" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Galleri.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">FAQ</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data FAQ Website</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <!-- End Website -->

    <!-- Informasi -->
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Informasi" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/News2.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Informasi Terbaru</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Informasi</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Materi" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Materi.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Materi</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Materi</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <!-- End Informasi -->

    <!-- Peserta -->
    <!-- <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Undangan" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Undangan.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Undangan</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Undangan</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div> -->
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Pendaftaran" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Pendaftaran.png');?>" alt="" class="float-right"
                        width="60" />
                    <h6 class="card-title font-weight-bold">Pendaftaran</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Pendaftaran</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Absen_Kehadiran" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Absensi_Kehadiran.png');?>" alt="" class="float-right"
                        width="60" />
                    <h6 class="card-title font-weight-bold">Absen Kehadiran</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Absen Kehadiran</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <!-- End Peserta -->

    <!-- Order Produk Pujasangon -->
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Produk" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Product.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Produk</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Product</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Transaksi_order" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Product2.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Transaksi Order</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Transaksi Order</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <!-- End Order Produk Pujasangon -->

    <!-- Pengaturan -->
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url('admin'); ?>" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Admin.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Administrator</h6>
                    <h6 class="card-subtitle mb-2 text-muted">Data Akun</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <!-- <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>profil" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Profil.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Profil</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Profil Sistem</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div> -->
    <!-- End Pengaturan -->

    <?php }elseif ($userdata->nama_level=="Admin") {?>
    <!-- Website -->
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Lokasi_Venue" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Lokasi_Vanue.png');?>" alt="" class="float-right"
                        width="60" />
                    <h6 class="card-title font-weight-bold">Lokasi Venue</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Lokasi Venue</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Lokasi_Tujuan" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Lokasi_Tujuan.png');?>" alt="" class="float-right"
                        width="60" />
                    <h6 class="card-title font-weight-bold">Lokasi Kunjungan</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Lokasi Kunjungan</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Agenda" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Agenda.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Agenda Kegiatan</h6>
                    <h6 class="card-subtitle mb-2 text-muted">Kegiatan Bulan Ini</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Hotel" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Hotel.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Hotel</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Hotel</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <!-- <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Wisata" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Wisata.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Wisata</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Wisata</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div> -->
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Galleri" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Galleri.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Galleri</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Galleri</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <!-- End Website -->

    <!-- Informasi -->
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Materi" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/News2.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Materi</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Materi</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Materi" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Materi.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Materi</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Materi</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <!-- End Informasi -->

    <!-- Peserta -->
   <!--  <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Undangan" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Undangan.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Undangan</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Undangan</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div> -->
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Pendaftaran" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Pendaftaran.png');?>" alt="" class="float-right"
                        width="60" />
                    <h6 class="card-title font-weight-bold">Pendaftaran</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Pendaftaran</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Absen_Kehadiran" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Absensi_Kehadiran.png');?>" alt="" class="float-right"
                        width="60" />
                    <h6 class="card-title font-weight-bold">Absen Kehadiran</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Absen Kehadiran</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <!-- End Peserta -->

    <!-- Order Produk Pujasangon -->
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Produk" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Product.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Produk</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Product</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Produk" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Product2.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Transaksi Order</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Transaksi Order</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <!-- End Order Produk Pujasangon -->

    <?php }elseif ($userdata->nama_level=="Bapalitbang" || $userdata->nama_level=="Bag.Pemerintahan") {?>
    <!-- Website -->
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Lokasi_Venue" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Lokasi_Vanue.png');?>" alt="" class="float-right"
                        width="60" />
                    <h6 class="card-title font-weight-bold">Lokasi Venue</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Lokasi Venue</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Lokasi_Tujuan" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Lokasi_Tujuan.png');?>" alt="" class="float-right"
                        width="60" />
                    <h6 class="card-title font-weight-bold">Lokasi Kunjungan</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Lokasi Kunjungan</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Agenda" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Agenda.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Agenda Kegiatan</h6>
                    <h6 class="card-subtitle mb-2 text-muted">Kegiatan Bulan Ini</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Hotel" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Hotel.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Hotel</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Hotel</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <!-- <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Wisata" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Wisata.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Wisata</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Wisata</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div> -->
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Galleri" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Galleri.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Galleri</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Galleri</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <!-- End Website -->

    <!-- Peserta -->
    <!-- <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Undangan" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Undangan.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Undangan</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Undangan</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div> -->
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Pendaftaran" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Pendaftaran.png');?>" alt="" class="float-right"
                        width="60" />
                    <h6 class="card-title font-weight-bold">Pendaftaran</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Pendaftaran</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Absen_Kehadiran" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Absensi_Kehadiran.png');?>" alt="" class="float-right"
                        width="60" />
                    <h6 class="card-title font-weight-bold">Absen Kehadiran</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Absen Kehadiran</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <!-- End Peserta -->

    <?php }elseif ($userdata->nama_level=="Pariwisata") {?>
    <!-- Hotel -->
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Hotel" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Hotel.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Hotel</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Hotel</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <!-- End Hotel -->

    <!-- Wisata -->
    <!-- <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Wisata" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Wisata.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Wisata</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Wisata</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div> -->
    <!-- End Wisata -->

    <?php }elseif ($userdata->nama_level=="Koperasi") {?>
    <!-- Produk -->
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Produk" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Product.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Produk</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Produk</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <!-- End Produk -->

    <!-- Transaksi Order -->
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Transaksi_order" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Product2.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Transaksi Order</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Transaksi Order</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <!-- End Transaksi Order -->

    <?php }elseif ($userdata->nama_level=="IKP") {?>
    <!-- Informasi -->
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Informasi" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/News2.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Informasi Terbaru</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Informasi</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <a href="<?= base_url(); ?>Materi" style="text-decoration: none">
            <div class="card">
                <div class="card-body">
                    <img src="<?=base_url('assets/img/icon/Materi.png');?>" alt="" class="float-right" width="60" />
                    <h6 class="card-title font-weight-bold">Materi</h6>
                    <h6 class="card-subtitle mb-2 text-muted text-danger">Data Materi</h6>
                    <h2></h2>
                </div>
            </div>
        </a>
    </div>
    <!-- End Informasi -->
    <?php } ?>
</div>
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

<div class="sidebar">
    <a href="#"
        class="sidebarCollapse float-right h6 dropdown-menu-right mr-2 mt-2 position-absolute d-block d-lg-none">
        <i class="icon-close"></i>
    </a>
    <a href="<?= base_url('Home'); ?>" class="sidebar-logo d-flex">
        <img src="<?= base_url('assets/img/logocss2.png'); ?>" alt="Css" width="100"
            class="img-fluid mr-2" />

    </a>
    <ul id="side-menu" class="sidebar-menu">
        <!-- Beranda -->
        <li>
            <a href="<?= base_url('Home'); ?>">
                <i class="icon-home"></i>
                Beranda
            </a>
        </li>
        <!-- End Beranda -->

        <?php if($userdata->nama_level=="Super Admin"){?>
        <!-- Website -->
        <li class="dropdown">
            <a href="#">
                <i class="fas fa-grip-horizontal"></i>Website
            </a>
            <div>
                <ul>
                    <li>
                        <a href="<?= base_url('Lokasi_Venue'); ?>">
                            <i class="icon-location-pin"></i>
                            Lokasi Venue
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('Lokasi_Tujuan'); ?>">
                            <i class="icon-location-pin"></i>
                            Lokasi Tujuan
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('Agenda'); ?>">
                            <i class="icon-notebook"></i>
                            Agenda
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('Hotel'); ?>">
                            <i class="fa-solid fa-building"></i>
                            Hotel
                        </a>
                    </li>
                    <!-- <li>
                        <a href="<?= base_url('Wisata'); ?>">
                            <i class="icon-plane"></i>
                            Wisata
                        </a>
                    </li> -->
                    <li>
                        <a href="<?= base_url('Galleri'); ?>">
                            <i class="icon-picture"></i>
                            Galleri
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('FAQ'); ?>">
                            <i class="fa-regular fa-circle-question"></i>
                            FAQ
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- End Website -->

        <!-- Informasi -->
        <li class="dropdown">
            <a href="#"> <i class="fas fa-grip-horizontal"></i>Informasi</a>
            <div>
                <ul>
                    <li>
                        <a href="<?= base_url('Informasi'); ?>">
                            <i class="fa-solid fa-circle-info"></i>
                            Informasi
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('Materi'); ?>">
                            <i class="icon-book-open"></i>
                            Materi
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- End Informasi -->

        <!-- Peserta -->
        <li class="dropdown">
            <a href="#">
                <i class="fas fa-grip-horizontal"></i>Peserta
            </a>
            <div>
                <ul>
                    <!-- <li>
                        <a href="<?= base_url('Undangan'); ?>">
                            <i class="fas fa-grip-horizontal"></i>
                            Undangan
                        </a>
                    </li> -->
                    <li>
                        <a href="<?= base_url('Pendaftaran'); ?>">
                            <i class="fas fa-grip-horizontal"></i>
                            Pendaftaran
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('Absen_Kehadiran'); ?>">
                            <i class="fas fa-grip-horizontal"></i>
                            Registrasi Peserta
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- End Peserta -->

        <!-- Order Produk Pujasangon -->
        <li class="dropdown">
            <a href="<?= base_url('#'); ?>">
                <i class="fas fa-grip-horizontal"></i>
                Order Produk Pujasangon
            </a>
            <div>
                <ul>
                    <li>
                        <a href="<?= base_url('Produk'); ?>">
                            <i class="fas fa-grip-horizontal"></i>
                            Produk
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('Transaksi_order'); ?>">
                            <i class="fas fa-grip-horizontal"></i>
                            Transaksi Produk
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- End Produk Pujasangon -->

        <!-- Pengaturan -->
        <li class="dropdown">
            <a href="#"><i class="icon-settings"></i>Pengaturan</a>
            <div>
                <ul>
                    <li>
                        <a href="<?= base_url('Profil'); ?>">
                            <i class="fa-solid fa-user-tie"></i>
                            Profil Sistem
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin'); ?>">
                            <i class="fas fa-grip-horizontal"></i>
                            Administrator
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- Pengaturan -->

        <?php }elseif ($userdata->nama_level=="Admin") {?>
        <!-- Website -->
        <li class="dropdown">
            <a href="#">
                <i class="fas fa-grip-horizontal"></i>Website
            </a>
            <div>
                <ul>
                    <li>
                        <a href="<?= base_url('Lokasi_Venue'); ?>">
                            <i class="icon-location-pin"></i>
                            Lokasi Venue
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('Lokasi_Tujuan'); ?>">
                            <i class="icon-location-pin"></i>
                            Lokasi Tujuan
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('Agenda'); ?>">
                            <i class="icon-notebook"></i>
                            Agenda
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('Hotel'); ?>">
                            <i class="fa-solid fa-building"></i>
                            Hotel
                        </a>
                    </li>
                    <!-- <li>
                        <a href="<?= base_url('Wisata'); ?>">
                            <i class="icon-plane"></i>
                            Wisata
                        </a>
                    </li> -->
                    <li>
                        <a href="<?= base_url('Galleri'); ?>">
                            <i class="icon-picture"></i>
                            Galleri
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- End Website -->

        <!-- Informasi -->
        <li class="dropdown">
            <a href="#"> <i class="fas fa-grip-horizontal"></i>Informasi</a>
            <div>
                <ul>
                    <li>
                        <a href="<?= base_url('Informasi'); ?>">
                            <i class="icon-picture"></i>
                            Berita Terbaru
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('Materi'); ?>">
                            <i class="icon-book-open"></i>
                            Materi
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- End Informasi -->

        <!-- Peserta -->
        <li class="dropdown">
            <a href="#">
                <i class="fas fa-grip-horizontal"></i>Peserta
            </a>
            <div>
                <ul>
                    <!-- <li>
                        <a href="<?= base_url('Undangan'); ?>">
                            <i class="fas fa-grip-horizontal"></i>
                            Undangan
                        </a>
                    </li> -->
                    <li>
                        <a href="<?= base_url('Pendaftaran'); ?>">
                            <i class="fas fa-grip-horizontal"></i>
                            Pendaftaran
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('Absen_Kehadiran'); ?>">
                            <i class="fas fa-grip-horizontal"></i>
                             Registrasi Peserta
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- End Peserta -->

        <!-- Order Produk Pujasangon -->
        <li class="dropdown">
            <a href="<?= base_url('#'); ?>">
                <i class="fas fa-grip-horizontal"></i>
                Order Produk Pujasangon
            </a>
            <div>
                <ul>
                    <li>
                        <a href="<?= base_url('Produk'); ?>">
                            <i class="fas fa-grip-horizontal"></i>
                            Produk
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('Transaksi_order'); ?>">
                            <i class="fas fa-grip-horizontal"></i>
                            Transaksi Produk
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- End Produk Pujasangon -->

        <?php }elseif ($userdata->nama_level=="Bapalitbang" || $userdata->nama_level=="Bag.Pemerintahan") {?>
        <!-- Website -->
        <li class="dropdown">
            <a href="#">
                <i class="fas fa-grip-horizontal"></i>Website
            </a>
            <div>
                <ul>
                    <li>
                        <a href="<?= base_url('Lokasi_Venue'); ?>">
                            <i class="icon-location-pin"></i>
                            Lokasi Venue
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('Lokasi_Tujuan'); ?>">
                            <i class="icon-location-pin"></i>
                            Lokasi Tujuan
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('Agenda'); ?>">
                            <i class="icon-notebook"></i>
                            Agenda
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('Hotel'); ?>">
                            <i class="fa-solid fa-building"></i>
                            Hotel
                        </a>
                    </li>
                    <!-- <li>
                        <a href="<?= base_url('Wisata'); ?>">
                            <i class="icon-plane"></i>
                            Wisata
                        </a>
                    </li> -->
                    <li>
                        <a href="<?= base_url('Galleri'); ?>">
                            <i class="icon-picture"></i>
                            Galleri
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- End Website -->

        <!-- Peserta -->
        <li class="dropdown">
            <a href="#">
                <i class="fas fa-grip-horizontal"></i>Peserta
            </a>
            <div>
                <ul>
                   <!--  <li>
                        <a href="<?= base_url('Undangan'); ?>">
                            <i class="fas fa-grip-horizontal"></i>
                            Undangan
                        </a>
                    </li> -->
                    <li>
                        <a href="<?= base_url('Pendaftaran'); ?>">
                            <i class="fas fa-grip-horizontal"></i>
                            Pendaftaran
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('Absen_Kehadiran'); ?>">
                            <i class="fas fa-grip-horizontal"></i>
                             Registrasi Peserta
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- End Peserta -->

        <?php }elseif ($userdata->nama_level=="Pariwisata") {?>
        <!-- Hotel -->
        <li>
            <a href="<?= base_url('Hotel'); ?>">
                <i class="fa-solid fa-building"></i>
                Hotel
            </a>
        </li>
        <!-- End Hotel -->

        <!-- Wisata -->
        <li>
            <a href="<?= base_url('Wisata'); ?>">
                <i class="icon-plane"></i>
                Wisata
            </a>
        </li>
        <!-- End Wisata -->

        <?php }elseif ($userdata->nama_level=="Koperasi") {?>
        <!-- Produk -->
        <li>
            <a href="<?= base_url('Produk'); ?>">
                <i class="fas fa-grip-horizontal"></i>
                Produk
            </a>
        </li>
        <!-- End Produk -->

        <!-- Transaksi Order -->
        <li>
            <a href="<?= base_url('Transaksi_order'); ?>">
                <i class="fas fa-grip-horizontal"></i>
                Transaksi Produk
            </a>
        </li>
        <!-- End Transaksi Order -->

        <?php }elseif ($userdata->nama_level=="IKP") {?>
        <!-- Informasi -->
        <li>
            <a href="<?= base_url('#'); ?>">
                <i class="icon-picture"></i>
                Berita Terbaru
            </a>
        </li>
        <!-- End Informasi -->

        <!-- Materi -->
        <li>
            <a href="<?= base_url('Materi'); ?>">
                <i class="icon-book-open"></i>
                Materi
            </a>
        </li>
        <!-- End Materi -->
        <?php } ?>
    </ul>
</div>
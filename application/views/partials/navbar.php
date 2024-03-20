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
<div id="header-fix" class="header fixed-top">
    <nav class="navbar navbar-expand-lg  p-0">
        <div class="navbar-header h4 mb-0 align-self-center d-flex">
            <a href="<?=base_url();?>" class="horizontal-logo align-self-center d-flex d-lg-none">
                <img src="<?=base_url('assets/img/logocss2.png');?>" alt="CSS" width="23" class="img-fluid" />
                <span class="h5 align-self-center mb-0 ">CSS</span>
            </a>
            <a href="#" class="sidebarCollapse ml-2" id="collapse"><i class="icon-menu body-color"></i></a>
        </div>
        <!--<div style="margin-left: 10px;">-->
        <!--  <img src="<?=base_url('assets/img/logo1.png');?>" width="150">-->
        <!--</div>-->

        <div class="navbar-right ml-auto">
            <ul class="ml-auto p-0 m-0 list-unstyled d-flex">
                <li class="mr-1 d-inline-block my-auto d-block d-lg-none">
                    <a href="#" class="nav-link px-2 mobilesearch" data-toggle="dropdown" aria-expanded="false"><i
                            class="icon-magnifier h4"></i>
                    </a>
                </li>

                <li class="dropdown user-profile d-inline-block py-1 mr-2">
                    <a href="#" class="nav-link px-2 py-0" data-toggle="dropdown" aria-expanded="false">
                        <div class="media">
                            <img src="<?= base_url(); ?>assets/img/Pengaturan_Profil.png" width="35">&nbsp;
                            <div class="media-body align-self-center d-none d-sm-block mr-2">
                                <p class="mb-0 text-uppercase line-height-1">
                                    <b><?= $userdata->username; ?></b><br /><span> <?= $userdata->nama_level; ?> </span>
                                </p>
                            </div>
                        </div>
                    </a>

                    <div class="dropdown-menu  dropdown-menu-right p-0">
                        <a href="#" class="dropdown-item px-2 align-self-center d-flex" data-toggle="modal"
                            data-target="#header_modal">
                            <span class="icon-pencil mr-2 h6 mb-0"></span> Update Profil
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?=base_url('login/out');?>"
                            class="dropdown-item px-2 text-danger align-self-center d-flex">
                            <span class="icon-logout mr-2 h6  mb-0"></span> Keluar
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>

<div class="modal fade" id="header_modal" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-default">
            <div class="modal-header">
                <h4>Ubah data Profil</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="row">
                <div class="col-12 col-md-12 mt-3">
                    <div class="card">
                        <form id="formNav" action="<?=base_url('home/update_usrdt');?>" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label">Username</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="username" value="<?= $userdata->username; ?>"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label">Username</label>
                                            <div class="col-sm-9">
                                                <select class="select2 form-control" name="level">
                                                    <?php foreach($this->db->get('t_level_admin')->result() as $keylev => $valev) {
                                                        if($valev->kd_level == $userdata->level_admin) {
                                                            $selected = 'SELECTED';
                                                        } else {
                                                            $selected = '';
                                                        }
                                                    ?>
                                                    <option value="<?= $valev->kd_level; ?>" <?= $selected; ?>>
                                                        <?= $valev->nama_level; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" name="password"
                                                    placeholder="Kosongkan jika tidak ingin diubah">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan <span
                                            id="loading3"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <form id="formData" action="<?= $url; ?>" method="POST" role="<?= base_url(); ?>Pendaftaran">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Kode Pendaftaran</label>
                        <div class="col-sm-4">
                            <input type="text" name="kd_daftar" value="<?= $kd_daftar ?>" class="form-control" readonly>
                        </div>
                        <label class="col-sm-2 col-form-label">Level
                            Peserta</label>
                        <div class="col-sm-4">
                            <select name="level_peserta" class="form-control">
                                <option disabled selected>--- Pilih Level Peserta ---</option>
                                <?php
                                        foreach ($level_peserta as $value) { ?>
                                <option value=<?= $value->kd_level_peserta ?>><?= $value->nama_level_peserta ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Kode Undangan</label>
                        <div class="col-sm-4">
                            <select name="undangan_kd" class="form-control">
                                <option disabled selected>--- Pilih Kode Undangan ---</option>
                                <?php
                                        foreach ($undangan_kd as $value) { ?>
                                <option value=<?= $value->kode_undangan ?>>
                                    <?= $value->kode_undangan.' || '. $value->nama_provinsi.' || '. $value->nama_kabupaten ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label">Nama Peserta</label>
                        <div class="col-sm-4">
                            <input type="text" name="nama_peserta" value="<?= $nama_peserta ?>" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Email Peserta</label>
                        <div class="col-sm-4">
                            <input type="text" name="email_peserta" value="<?= $email_peserta ?>" class="form-control">
                        </div>
                        <label class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-4">
                            <input type="text" name="username" value="<?= $username ?>" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">
                            Nomer Telphone</label>
                        <div class="col-sm-4">
                            <input type="number" name="tlp_peserta" value="<?= $tlp_peserta ?>" class="form-control">
                        </div>
                        <label class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-4">
                            <input type="text" name="password" value="<?= $password ?>" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_peserta" value="<?= 1 ?>"
                                    id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Aktif
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_peserta" value="<?= 2 ?>"
                                    id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Non-Aktif
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm text-right">
                            <div class="btn-group" role="group">
                                <button class="btn btn-outline-primary" type="submit">
                                    Simpan <span id="loading2"></span>
                                </button>
                                <a href="<?= base_url(); ?>Pendaftaran" class="btn btn-danger">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
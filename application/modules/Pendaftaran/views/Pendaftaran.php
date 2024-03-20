<div class="row">
    <div class="col-12 col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <div id="toolbar">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a href="javascript:void(0)" class="btn btn-success" title="Kirim Username">
                            <i class="fa fa-regular fa-paper-plane"></i>
                            Kirim Username
                        </a>
                        <a href="javascript:void(0)" class="btn btn-warning" id="btnRedir"
                            title="Cetak Tiket">
                            <i class="fa fa-solid fa-qrcode"></i>
                            Cetak Tiket
                        </a>
                        <a href="<?=base_url('home/hapusData'); ?>" class="btn btn-danger" id="btnDestroy"
                            title="Hapus Data">
                            <i class="far fa-trash-alt"></i>
                            Hapus
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="table" class="table table-striped" data-toggle="table" data-toolbar="#toolbar"
                        data-show-refresh="true"   data-auto-refresh="true"
                        data-pagination="true" data-search="true" data-sort-order="desc" data-id-field="id"
                        data-page-list="[10, 25, 50, 100, all]"
                        data-url="<?=base_url('Pendaftaran/load_pendaftaran');?>">
                        <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true"  data-valign="top"></th>
                                <th data-field="kd_daftar"  data-valign="top">Nomor</th>
                                <th data-field="tgl_daftar"  data-valign="top">Tanggal</th>
                                <th data-field="provinsi"  data-valign="top">Provinsi</th>
                                <th data-field="kabupaten"  data-valign="top">Kab/Kota</th>
                                <th data-field="peserta"  data-valign="top">Detail Peserta</th>
                                <th data-field="level_peserta"  data-valign="top">Level Peserta</th>
                                <th data-field="status_peserta"  data-valign="top">Kehadiran</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
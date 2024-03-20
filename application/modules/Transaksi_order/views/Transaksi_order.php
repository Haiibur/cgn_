<div class="row">
    <div class="col-12 col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <div id="toolbar">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <!-- <a href="<?=base_url('form_tambah_transaksi_order');?>" class="btn btn-success"
                            title="Tambah Data">
                            <i class="fa fa-plus"></i>
                            Tambah
                        </a> -->
                        <a href="<?=base_url('detail_order/');?>" class="btn btn-success" id="btnRedir"
                            title="Lihat Detail">
                            <i class="fa fa-eye"></i>
                            Lihat Detail
                        </a>
                        <a href="<?=base_url('ubah_transaksi_order/');?>" class="btn btn-warning" id="btnRedir2"
                            title="Ubah Data">
                            <i class="fa fa-edit"></i>
                            Edit
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
                        data-pagination="true" data-search="true" data-sort-order="desc" data-id-field="id"
                        data-page-list="[10, 25, 50, 100, all]"
                        data-url="<?=base_url('Transaksi_order/load_transaksi_order');?>">
                        <thead>
                            <tr>
                                <th rowspan='2' data-field="state" data-checkbox="true"></th>
                                <th rowspan='2' data-field="kd_order">Nomor</th>
                                <th rowspan='2' data-field="tgl_order">Tgl Order</th>
                                <th colspan='3' data-align="center">Customer</th>
                                <th colspan='4' data-align="center">Transaksi Data</th>
                                
                                
                                
                            </tr>
                            <tr>
                                
                                <th data-field="nama_peserta">Nama Customer</th>
                                <th data-field="tlp_peserta">NO.Telp</th>
                                <th data-field="catatan">Catatan</th>
                                <th data-field="qty_order" data-align="center">Total Item</th>
                                <th data-field="jumlah_bayar" data-align="right">Jml.Bayar</th>
                                
                                <th data-field="status_kirim" data-width="130" data-align="center"> Status Order </th>
                                <th data-field="status_bayar" data-width="130" data-align="center">Status Bayar</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="BSmodal" tabindex="-1" role="dialog" aria-labelledby="Modal FormData">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header backmodal">
                <h4 class="modal-title">

                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Level Admin</label>
                        <div class="col-sm-9">
                            <select class="select2 form-control" name="level" id="level">
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" id="username"
                                placeholder="Digunakan untuk Login">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan <span id="loading"></span></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
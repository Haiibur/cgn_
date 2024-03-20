<div class="row">
    <div class="col-12 col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <div id="toolbar">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a href="<?=base_url('form_tambah_lokasi_venue');?>" class="btn btn-success"
                            title="Tambah Data">
                            <i class="fa fa-plus" style="margin-right: 5px;"></i>Tambah
                        </a>
                        <a href="<?=base_url('form_ubah_lokasi_venue/');?>" class="btn btn-warning" id="btnRedir"
                            title="Ubah Data">
                            <i class="fa fa-edit" style="margin-right: 5px;"></i> Edit
                        </a>
                        <a href="<?=base_url('home/hapusData'); ?>" class="btn btn-danger" id="btnDestroy"
                            title="Hapus Data">
                            <i class="far fa-trash-alt" style="margin-right: 5px;"></i> Hapus
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="table" class="table table-striped" data-toggle="table" data-toolbar="#toolbar"
                        data-pagination="true" data-search="true" data-sort-order="desc" data-id-field="id"
                        data-page-list="[10, 25, 50, 100, all]"
                        data-url="<?=base_url('Lokasi_Venue/load_lokasi_venue');?>">
                        <thead>
                            <tr style="text-align: center;">
                                <th data-field="state" data-checkbox="true"></th>
                                <th data-field="foto_venue" data-width="100">Foto</th>
                                <th data-field="nama_venue" data-sortable="true">Nama Venue</th>
                                <th data-field="titik_lokasi">Titik lokasi</th>
                                <th data-field="ket_venue">Keterangan</th>
                                <!-- <th data-field="status" data-width="130">Status</th> -->
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
var $table = $('#table');


</script>
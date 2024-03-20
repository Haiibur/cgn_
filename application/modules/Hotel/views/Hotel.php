<div class="row">
    <div class="col-12 col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <div id="toolbar">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a href="<?=base_url('form_tambah_hotel');?>" class="btn btn-success" title="Tambah Data">
                            <i class="fa fa-plus" style="margin-right: 5px;"></i>
                            Tambah
                        </a>
                        <a href="<?=base_url('form_ubah_hotel/');?>" class="btn btn-warning" id="btnRedir"
                            title="Ubah Data">
                            <i class="fa fa-edit" style="margin-right: 5px;"></i>
                            Edit
                        </a>
                        <a href="<?=base_url('home/hapusData'); ?>" class="btn btn-danger" id="btnDestroy"
                            title="Hapus Data">
                            <i class="far fa-trash-alt" style="margin-right: 5px;"></i>
                            Hapus
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="table" class="table table-striped" data-toggle="table" data-toolbar="#toolbar"
                        data-pagination="true" data-search="true" data-sort-order="desc" data-id-field="id"
                        data-page-list="[10, 25, 50, 100, all]" data-url="<?=base_url('Hotel/load_hotel');?>">
                        <thead>
                            <tr style="text-align:center;">
                                <th data-field="state" data-checkbox="true"></th>
                                <th data-field="foto" data-width="150">Foto</th>
                                <th data-field="nama_hotel" data-sortable="true">Nama Hotel</th>
                                <th data-field="link_website" >Link Website</th>
                                <th data-field="titik_lokasi">Titik Lokasi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
var $table = $('#table')

</script>
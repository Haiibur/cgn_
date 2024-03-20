<!-- START: Template JS-->
<script src="<?=base_url();?>assets/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
<script src="<?=base_url();?>assets/dist/vendors/moment/moment.js"></script>
<script src="<?=base_url();?>assets/moment/moment.min.js"></script>
<script src="<?=base_url();?>assets/daterangepicker/daterangepicker.js"></script>
<script src="<?=base_url();?>assets/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="<?=base_url();?>assets/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url();?>assets/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url();?>assets/dist/vendors/flag-select/js/jquery.flagstrap.min.js"></script>
<script src="<?=base_url();?>assets/js/table/bootstrap-table.min.js"></script>
<script src="<?=base_url();?>assets/js/table/locale/bootstrap-table-id-ID.min.js"></script>
<script src="<?=base_url();?>assets/js/ckeditor/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- END: Template JS-->

<!-- Sweet-Alert  -->
<script src="<?=base_url();?>assets/sweetalert2/dist/sweetalert2.all.min.js"></script>

<!-- START: APP JS-->
<script src="<?=base_url();?>assets/dist/js/app.js"></script>

<!-- <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js"></script>


<script>
let mapOptions = {
    center: [51.958, 9.141],
    zoom: 10
}

let map = new L.map('map', mapOptions);

let layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
map.addLayer(layer);

let marker = null;
map.on('click', (event) => {

    if (marker !== null) {
        map.removeLayer(marker);
    }

    marker = L.marker([event.latlng.lat, event.latlng.lng]).addTo(map);

    document.getElementById('latitude').value = event.latlng.lat;
    document.getElementById('longitude').value = event.latlng.lng;

})
</script> -->
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Form tambah pembelian</h1>

    <form>
        <div class="form-group">
            <label></label>
            <select class="form-control" id="selectBarang" autofocus="true" name="namabarang">
            </select>
         </div>

        <div class="form-group">
            <label>Suplier</label>
            <input type="text" id="suplier" class="form-control" name="suplier" required="">
        </div>

        <div class="form-group">
            <label>harga_beli</label>
            <input type="text" id="harga_beli" class="form-control" name="harga_beli" required="">
        </div>

        <div class="form-group"> 
            <label>Jumlah</label>
            <input type="text" min="1" class="form-control" id="jml-barang" name="jumlah" required="">
        </div>
         
        <div class="form-group">
            <button type="button" class="btn btn-warning float-left" onclick="window.history.back(-1)">Kembali</button>
            <button type="button" id="btn-addpembelian" class="btn btn-success float-right">Tambah data</button>
        </div>
</div>
</div>

 <script type="text/javascript">

     $(document).ready(function() {
         $('#selectBarang').select2('focus');
         $('#selectBarang').select2('open');
     });

     $('#selectBarang').select2({
         theme: 'bootstrap4',
         placeholder: 'Pilih barang',
         ajax: {
             url: '<?php echo base_url('pembelian/getNamaBarang') ?>',
             type: 'POST',
             dataType: 'json',
             data: params => ({
                 nama_barang: params.term
             }),
             processResults: data => ({
                 results: data
             }),
             cache: true
         }
     });

     // Proses pesanan
     $('#btn-addpembelian').click(function(event) {
         var id_stock   = $('#selectBarang').val();
         var jumlah     = $('#jml-barang').val();
         var harga_beli = $('#harga_beli').val();
         var suplier    = $('#suplier').val();
         $.ajax({
                 url: '<?php echo base_url('pembelian/add') ?>',
                 type: 'post',
                 data: {
                    id_stock    : id_stock,
                    harga_beli  : harga_beli,
                    suplier     : suplier,           
                    jumlah      : jumlah
                 },
             })
             .done(function(result) {
                 window.location.reload();
             })
             .always(function() {
                 console.log("complete");
             });
     });
 </script>
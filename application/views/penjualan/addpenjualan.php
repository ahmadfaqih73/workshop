<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Hal tambah penjualan</h1>
    <div class="form-group">
        <label>Kode Pesanan</label>
        <input type="text" class="form-control" id="kode_pesanan" name="kode_pesanan" required="" value="<?php echo $kode; ?>" readonly="readonly">
    </div>

    <div class="form-group">
        <label>Pelanggan</label>
        <select class="form-control" id="selectPelanggan" autofocus="true" name="nama">
        </select>
    </div>

    <div class="form-group">
        <label for="selectPelanggan">Pilih Barang</label>
        <div class="form-row">
            <div class="col">
                <select class="form-control" id="selectBarang" name="namabarang">
                </select>
            </div>
            <div class="col">
                <input type="number" min="1" id="jml-barang" class="form-control" placeholder="Jumlah">
            </div>
            <button type="button" id="btn-tambah-barang" class="btn btn-primary">+</button>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="detail_cart">

        </tbody>

    </table>

    <button type="button" class="btn btn-warning float-left" onclick="window.history.back(-1)">Kembali</button>
    <button type="submit" id="btn-submit-pesanan" class="btn btn-success float-right">Tambah data</button>

    <!--    <?php echo "<pre>";
            print_r($this->cart->contents());
            echo "</pre>"; ?> -->

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#selectPelanggan').select2('focus');
        $('#selectPelanggan').select2('open');
    });

    $('#btn-tambah-barang').click(function(event) {
        var id_stock = $('#selectBarang').val();
        var qty = $('#jml-barang').val();
        var id_pelanggan = $('#selectPelanggan').val();
        $.ajax({
                url: '<?php echo base_url('penjualan/addPesananCart') ?>',
                type: 'POST',
                data: {
                    id_stock: id_stock,
                    qty: qty,
                    id_pelanggan: id_pelanggan
                },
            })
            .done(function(result) {
                console.log("success");
                window.location.reload();
            })
    });

    // $('#selectPelanggan').select2('focus');                 

    // Proses pesanan
    $('#btn-submit-pesanan').click(function(event) {
        var id_pelanggan = $('#selectPelanggan').val();
        var kode = $('#kode_pesanan').val();
        $.ajax({
                url: '<?php echo base_url('penjualan/addValidPesanan') ?>',
                type: 'post',
                data: {
                    kode: kode,
                    id_pelanggan: id_pelanggan
                },
            })
            .done(function() {
                console.log("success");
                window.location.reload();
            })
            .always(function() {
                console.log("complete");
            });
    });

    //Load Cart
    $('#detail_cart').load("<?php echo base_url('penjualan/load_cart'); ?>");

    $('#selectPelanggan').select2({
        theme: 'bootstrap4',
        placeholder: 'Pilih pelanggan',
        ajax: {
            url: '<?php echo base_url('pelanggan/getNamaPelanggan') ?>',
            type: 'POST',
            dataType: 'json',
            data: params => ({
                nama_pelanggan: params.term
            }),
            processResults: data => ({
                results: data
            }),
            cache: true
        }
    });

    //Hapus Item Cart
    $(document).on('click', '.hapus_cart', function() {
        var row_id = $(this).attr("id"); //mengambil row_id dari artibut id
        $.ajax({
            url: "<?php echo base_url('penjualan/hapus_cart'); ?>",
            method: "POST",
            data: {
                row_id: row_id
            },
            success: function(data) {
                $('#detail_cart').html(data);
            }
        });
    });

    $('#selectBarang').select2({
        theme: 'bootstrap4',
        placeholder: 'Pilih Barang',
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
</script>
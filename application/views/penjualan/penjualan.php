<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <!-- //tampilan data user -->

    <a href="<?php echo base_url('penjualan/viewAddpenjualan') ?>" class="btn btn-primary">Add Penjualan</a>
    <br><br>
    <?php
    echo $this->session->flashdata('message');
    ?>

    <table class="table table-bordered text-center table-hover table-striped" id="tablePenjualan">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Pesanan</th>
                <th>Barang</th>
                <th>Pelanggan</th>
                <th>Jumlah</th>
                <th>harga</th>
                <th>Subtotal</th>
                <th>Update</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $no = 1;
            foreach ($penjualan as $value) {
            ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $value['kode_pesanan'] ?></td>
                    <td><?php echo $value['nama_barang'] ?></td>
                    <td><?php echo $value['nama_pelanggan'] ?></td>
                    <td><?php echo $value['jumlah'] ?></td>
                    <td><?php echo 'Rp. ' . number_format($value['Hargajual']) ?></td>
                    <td><?php echo 'Rp. ' . number_format($value['harga']) ?></td>

                    <!-- Button trigger modal -->
                    <td><button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#updatePenjualan<?= $value['id_penjualan'] ?>">
                            Update
                        </button></td>



                    <td><a href="<?php echo base_url('penjualan/hapuspenjualan/' . $value['id_penjualan']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data pelanggan <?php echo $value['jumlah'] ?> ?')">Remove</a></td>
                </tr>
            <?php $no++;
            } ?>
        </tbody>
    </table>






</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content-->
<script type="text/javascript">
    $(document).ready(function() {
        $('#tablePenjualan').DataTable();
    });
</script>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <!-- //tampilan data user -->

    <?php
    echo $this->session->flashdata('message');
    ?>

    <table class="table table-bordered text-center table-hover table-striped" id="tableTransaksi">
        <thead>
            <tr>
                <th>No</th>
                <th>kode</th>
                <th>nama</th>
                <th>Total</th>
                <th>tanggal</th>

            </tr>
        </thead>
        <tbody>

            <?php
            $no = 1;
            foreach ($barang_keluar as $value) {
            ?>
                <tr>
                    <th><?= $no ?></th>
                    <td><?php echo $value['id_transaksi'] ?></td>
                    <td><?php echo $value['nama_barang'] ?></td>
                    <td><?php echo $value['jumlah'] ?></td>
                    <td><?php echo $value['tanggal'] ?></td>
                </tr>
            <?php $no++;
            } ?>
        </tbody>
    </table>






</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<script type="text/javascript">
    $(document).ready(function() {
        $('#tableTransaksi').DataTable();
    });
</script>
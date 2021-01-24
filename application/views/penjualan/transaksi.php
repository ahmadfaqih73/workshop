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
                <th>Kode</th>
                <th>pelanggan</th>
                <th>Total</th>
                <th>Bayar</th>
                <th>Kembalian</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

            <?php 
            $no=1;
            foreach ($transaksi as $value) {
            ?>
            <tr>
                <td><?php echo $value['id_transaksi'] ?></td>
                <td><?php echo $value['nama_pelanggan'] ?></td>
                <td><?php echo 'Rp. ' . number_format($value['total']) ?></td>
                <td><?php echo 'Rp. ' . number_format($value['bayar']) ?></td>
                <td><?php echo 'Rp. ' . number_format ($value['bayar'] - $value['total']) ?></td>
                <td><?php echo ($value['status'] == 0) ? 'Belum Bayar' : 'Selesai' ; ?></td>
                
                     <!-- Button trigger modal -->
                <td><button <?php echo ($value['status'] == 0) ? '' : 'disabled' ; ?> type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#updateTransaksi<?= $value['id_transaksi'] ?>">
                  <?php echo ($value['status'] == 0) ? 'Bayar' : 'Sudah Dibayar' ?>
                </button></td>

                <!-- Modal -->
                <div class="modal fade" id="updateTransaksi<?= $value['id_transaksi'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Selesaikan transaksi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                    <form class="col-md-6" method="post" action="<?php echo base_url('penjualan/update') ?>">
                        <h4>Jumlah : </h4><b>Rp. <?php echo number_format($value['total']) ?></b>

                            <!-- Id Pelanggan -->
                      <input type="hidden" name="id_transaksi" value="<?php echo $value['id_transaksi'] ?>">

                      <input type="hidden" name="total" value="<?php echo $value['total'] ?>">

                    <div class="form-group">
                        <label>Jumlah bayar</label>
                        <input type="number" class="form-control" name="bayar" required="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success float-right">Simpan</button>
                    </div>
                    </form>
                      </div>
                    </div>
                  </div>
                </div>


            </tr>
            <?php $no++; } ?>
        </tbody>
    </table>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
  <script type="text/javascript">
        $(document).ready(function() {
            $('#tableTransaksi').DataTable();
        } );
    </script>
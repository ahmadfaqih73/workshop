<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <a href="<?php echo base_url('pembelian/viewadd') ?>" class="fas fa-plus btn btn-primary">Add pembelian</a>
  <br><br>
  <!-- //tampilan data user -->

  <?php
  echo $this->session->flashdata('message');
  ?>

  <table class="table table-bordered text-center table-hover table-striped" id="tablepembelian">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama Barang</th>
        <th>harga</th>
        <th>Jumlah</th>
        <th>Harga Total</th>
        <th>tanggal</th>
        <th>suplier</th>
        <th>Update</th>
        <th>Remove</th>
      </tr>
    </thead>
    <tbody>

      <?php
      $no = 1;
      foreach ($pembelian as $value) {
      ?>
        <tr>
          <td><?php echo $no ?></td>
          <td><?php echo $value['nama_barang'] ?></td>
          <td><?php echo 'Rp. ' . number_format($value['harga_beli'])?></td>
          <td><?php echo $value['jumlah'] ?></td>
          <td><?php echo 'Rp. ' . number_format($value['harga_total']) ?></td>
          <td><?php echo $value['tanggal'] ?></td>
          <td><?php echo $value['suplier'] ?></td>

          <!-- <th colspan="2">Action</th> -->


          <!-- Button trigger modal -->
          <td><button type="button" class="fas fa-edit btn btn-sm btn-success" data-toggle="modal" data-target="#updatepembelian<?= $value['id_pembelian'] ?>">
              Update
            </button></td>

          <!-- Modal -->
          <div class="modal fade" id="updatepembelian<?= $value['id_pembelian'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Update data pembelian</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="col-md-6" method="post" action="<?php echo base_url('pembelian/updatepembelian') ?>">

                    <!-- Id Pelanggan -->
                    <input type="hidden" name="id_pembelian" value="<?php echo $value['id_pembelian'] ?>">

                    <div class="form-group">
                      <label>Kode barang</label>
                      <input type="text" class="form-control" name="kode_barang" required="" value="<?php echo $value['barang_kode'] ?>">
                    </div>

                    <div class="form-group">
                      <label>Nama Barang</label>
                      <input type="text" class="form-control" name="nama_barang" required="" value="<?php echo $value['nama_barang'] ?>">
                    </div>
                    <div class="form-group">
                      <label>harga</label>
                      <input type="number" class="form-control" name="harga_beli" required="" value="<?php echo $value['harga_beli'] ?>">
                    </div>
                    <div class="form-group">
                      <label>Jumlah</label>
                      <input type="text" class="form-control" name="jumlah" required="" value="<?php echo $value['jumlah'] ?>">
                    </div>
                    <div class="form-group">
                      <label>harga total</label>
                      <input type="number" class="form-control" name="harga_total" required="" value="<?php echo $value['harga_total'] ?>">
                    </div>
                    <div class="form-group">
                      <label>Tanggal</label>
                      <input type="text" class="form-control" name="tanggal" required="" value="<?php echo $value['tanggal'] ?>">
                    </div>
                    <div class="form-group">
                      <label>Suplier</label>
                      <input type="text" class="form-control" name="suplier" required="" value="<?php echo $value['suplier'] ?>">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success float-right">Update data</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <td><a href="<?php echo base_url('pembelian/hapuspembelian/' . $value['id_pembelian']) ?>" class="fas fa-trash btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data pembelian <?php echo $value['nama_barang'] ?> ?')">Remove</a></td>
        </tr>
      <?php $no++;
      } ?>
    </tbody>
  </table>

</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#tablepembelian').DataTable();
  });
</script>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <!-- //tampilan data user -->
      <a href="<?php echo base_url('pembelian/viewaddstock') ?>" class="fas fa-plus btn btn-primary">Add stock</a>
    <br><br>
   <?php  
    echo $this->session->flashdata('message');
    ?>

    <table class="table table-bordered text-center table-hover table-striped" id="tablestock">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                 <th>Harga Jual</th>
                  <th>Jumlah</th>
                 
                <th>Update</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody>

            <?php 
            $no=1;
            foreach ($stock as $value) {
            ?>
            <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $value['kode_barang'] ?></td>
                <td><?php echo $value['nama_barang'] ?></td>
                <td><?php echo $value['Hargajual'] ?></td>
                <td><?php echo ($value['jumlah_barang'] < 5) ? '<div class="text-danger">'.$value['jumlah_barang'].'</div>' : $value['jumlah_barang'] ; ?></td>

                <!-- Button trigger modal -->
                <td><button type="button" class="fas fa-edit btn btn-sm btn-success" data-toggle="modal" data-target="#updatestock<?= $value['id_stock'] ?>">
                  Update
                </button></td>

                <!-- Modal -->
                <div class="modal fade" id="updatestock<?= $value['id_stock'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update data pembelian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form class="col-md-6" method="post" action="<?php echo base_url('pembelian/updatestock') ?>">

                            <!-- Id Pelanggan -->
                            <input type="hidden" name="id_stock" value="<?php echo $value['id_stock'] ?>">
                              <div class="form-group">
                        <label>Kode Barang</label>
                        <input type="text" class="form-control" name="kode_barang" required="" value="<?php echo $value['kode_barang'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" required="" value="<?php echo $value['nama_barang'] ?>">
                    </div>
                    <div class="form-group">
                        <label>harga jual</label>
                        <input type="number" class="form-control" name="Hargajual" required="" value="<?php echo $value['Hargajual'] ?>">
                    </div>
                      <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" class="form-control" name="jumlah_barang" required="" value="<?php echo $value['jumlah_barang'] ?>">
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


<td><a href="<?php echo base_url('pembelian/hapusstock/'.$value['id_stock']) ?>" class="fas fa-trash btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data stock <?php echo $value['nama_barang'] ?> ?')">Remove</a></td>
            </tr>
            <?php $no++; } ?>
        </tbody>
    </table>





</div>
<!-- /.container-fluid -->

 <script type="text/javascript">
        $(document).ready(function() {
            $('#tablestock').DataTable();
        } );
    </script>
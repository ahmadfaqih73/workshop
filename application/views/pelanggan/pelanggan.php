<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <!-- //tampilan data user -->
   <a href="<?php echo base_url('pelanggan/viewAdd') ?>" class="btn btn-primary">Add Pelanggan</a>
    <br><br>

    <?php  
    echo $this->session->flashdata('message');
    ?>

    <table class="table table-bordered text-center table-hover table-striped" id="tablePelanggan">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Pelanggan</th>
                <th>Jenis Kelamin</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Update</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody>

            <?php 
            $no=1;
            foreach ($pelanggan as $value) {
            ?>
            <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $value['nama_pelanggan'] ?></td>
                <td><?php echo ($value['jenis_kelamin'] == '1') ? 'Laki-laki' : 'Perempuan' ; ?></td>
                <td><?php echo $value['no_hp'] ?></td>
                <td><?php echo $value['alamat'] ?></td>
            
                <!-- Button trigger modal -->
                <td><button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#updatePelanggan<?= $value['id_pelanggan'] ?>">
                  Update
                </button></td>

                <!-- Modal -->
                <div class="modal fade" id="updatePelanggan<?= $value['id_pelanggan'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update data pelanggan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form class="col-md-6" method="post" action="<?php echo base_url('pelanggan/update') ?>">

                            <!-- Id Pelanggan -->
                            <input type="hidden" name="id_pelanggan" value="<?php echo $value['id_pelanggan'] ?>">

                    <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <input type="text" class="form-control" name="nama_pelanggan" required="" value="<?php echo $value['nama_pelanggan'] ?>">
                    </div>
                    <label>Jenis Kelamin</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="exampleRadios1" value="1" required="" <?php echo ($value['jenis_kelamin'] == '1') ? 'checked' : '' ; ?>>
                        <label class="form-check-label" for="exampleRadios1">
                        Laki-laki
                        </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="jenis_kelamin" id="exampleRadios2" value="2" required="" <?php echo ($value['jenis_kelamin'] == '2') ? 'checked' : '' ; ?>>
                      <label class="form-check-label" for="exampleRadios2">
                        Perempuan
                      </label>
                    </div>
                    <div class="form-group">
                        <label>No hp</label>
                        <input type="number" class="form-control" name="no_hp" required="" value="<?php echo $value['no_hp'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" required="" value="<?php echo $value['alamat'] ?>">
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

                <td><a href="<?php echo base_url('pelanggan/hapus/'.$value['id_pelanggan']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data pelanggan <?php echo $value['nama_pelanggan'] ?> ?')">Remove</a></td>
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
            $('#tablePelanggan').DataTable();
        } );
    </script>
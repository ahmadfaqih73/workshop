<!-- Begin Page Content -->
    <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Hal Pelanggan</h1>

    <form class="col-md-6" method="post" action="<?php echo base_url('pelanggan/add') ?>">
    <div class="form-group">
        <label>Nama Pelanggan</label>
        <input type="text" class="form-control" name="nama" required="">
    </div>
    <label>Jenis Kelamin</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="jenis_kelamin" id="exampleRadios1" value="1" required="">
        <label class="form-check-label" for="exampleRadios1">
        Laki-laki
        </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="jenis_kelamin" id="exampleRadios2" value="2" required="">
      <label class="form-check-label" for="exampleRadios2">
        Perempuan
      </label>
    </div>
    <div class="form-group">
        <label>No hp</label>
        <input type="number" class="form-control" name="no_hp" required="">
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <input type="text" class="form-control" name="alamat" required="">
    </div>
    <button type="button" class="btn btn-warning float-left" onclick="window.history.back(-1)">Kembali</button>
    <button type="submit" class="btn btn-success float-right">Tambah data</button>
    </form>

    </div>

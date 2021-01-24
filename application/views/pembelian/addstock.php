<!-- Begin Page Content -->
    <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Hal Menu</h1>

    <form class="col-md-6" method="post" action="<?php echo base_url('pembelian/addstock') ?>">
                    <div class="form-group">
                        <label>Kode Barang</label>
                        <input type="text" class="form-control" name="kode_barang" required="" >
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" required="" >
                    </div>
                    <div class="form-group">
                        <label>harga jual</label>
                        <input type="number" class="form-control" name="Hargajual" required="" >
                    </div>
                      <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" class="form-control" name="jumlah_barang" required="" >
                    </div>
                   
    <button type="button" class="btn btn-warning float-left" onclick="window.history.back(-1)">Kembali</button>
    <button type="submit" class="btn btn-success float-right">Tambah data</button>
    </form>

    </div>


    
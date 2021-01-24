<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <!-- //tampilan data user -->

  <!-- Earnings (Monthly) Card Example -->
  <div class="row mb-4">
    <form method="post" class="form-inline" action="<?php echo base_url('admin/index') ?>">

      <div class="form-group">
        <label>Pilih Bulan</label>
        <select id="pilih_bulan" name="bulan" class="form-control">
          <option value="0" selected="" disabled="">Pilih Bulan</option>
          <option value="1">Januari</option>
          <option value="12">Desember</option>
        </select>
      </div>
      <div class="form-group">
        <button class="btn btn-primary" type="submit">Filter</button>
      </div>
    </form>
  </div>

  <div class="row">

    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pemasukan (Bulanan)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php echo 'Rp. ' . number_format($pemasukan) ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warnin text-uppercase mb-1">Pengeluaran (Bulanan)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php echo 'Rp. ' . number_format($pengeluaran) ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
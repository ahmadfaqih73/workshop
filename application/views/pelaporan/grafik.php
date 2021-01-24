<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <!-- //tampilan data user -->
    <!-- <form method="post" action="<?php echo base_url('pelaporan/grafik') ?>"> -->
      <!-- <div class="form-group"> -->
    <!-- <label for="bulan">bulan</label> -->
    <!-- <select class="form-control" id="bulan" name="bulan"> -->
<!--       <?php  
      foreach ($bulan as $value) {
      ?>
      <option value="<?php echo $value['id_bulan'] ?>" ><?php echo $value['nama_bulan'] ?></option>
      <?php }
      ?> -->
<!--     	<?php foreach($bulan as $b): ?> 
    		<?php if($b == $bulan['bulan']) :?>
    		<option value="<?= $b; ?>" selected><?= $b; ?></option>
    		<?php else: ?>
    			<option value="<?= $b; ?>"><?= $b; ?></option>
    		<?php endif; ?>
      <?php endforeach; ?> -->
    <!-- </select> -->
  <!-- </div> -->
  <!-- <div class="form-group"> -->
    <!-- <button type="submit" class="btn btn-primary btn-sm">Search...</button> -->
  <!-- </div> -->
  <!-- </form> -->

<div>
  <hi>
</div>
    <div>
      <h1>Grafik penjualan </h1>
    	 <canvas id="myChart"></canvas>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
  <script type="text/javascript">


    function getDays() {
      let now = new Date,
      bulan = now.getMonth()+1,
      tahun = now.getFullYear(),
      hari = new Date(tahun, bulan, 0).getDate(),
      totalHari=[];
      for(var o=0; o<=hari; o++) {
        totalHari.push(o);
      }
      return totalHari;
    }

  var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [
          'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                    'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'
        ],
        datasets: [{
            label: 'Jumlah Penjualan',
            backgroundColor: '#ADD8E6',
            borderColor: '##93C3D2',
            data: <?php echo json_encode($grafik); ?>
        }]
    },
});
  </script>
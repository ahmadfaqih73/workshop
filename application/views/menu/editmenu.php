<div class="container">
  
	


	<div class="row mt-3">
		<div class="col-md-6">

			<div class="card">
  <div class="card-header">
  Form ubah data
  </div>
  <div class="card-body"> 

  	<!-- <?php if (validation_errors()): 
  	
  	 ?><div class="alert alert-danger" role="alert">
  	 	<?= validation_errors();?>
  	 </div>
  	<?php endif; ?> -->

			<form action="" method="post">
				
				<input type="hidden" id="id" name="id" value="<?= $user_menu['id'];?>" >
				 <div class="form-group">
    <label for="nama">Menu</label>
    <input type="text" class="form-control" id="menu" name="menu" value="<?= $user_menu['menu'];?>">
    <small  class="form-text text-danger"><?= form_error('menu')?></small>
  </div>
  <button type="submit" name="tambah" class="btn btn-success float-right">ubah</button>
			</form> 
  </div>
</div>
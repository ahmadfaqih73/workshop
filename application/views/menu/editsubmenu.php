
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
				
				<input type="hidden" id="id" name="id" value="<?= $user_sub_menu['id'];?>" >
				 <div class="form-group">
    <label for="nama">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="<?= $user_sub_menu['title'];?>">
    <label for="nama">Menu</label>
    <input type="text" class="form-control" id="menu_id" name="menu_id" value="<?= $user_sub_menu['menu_id'];?>">
    <label for="nama">url</label>
    <input type="text" class="form-control" id="url" name="url" value="<?= $user_sub_menu['url'];?>">
    <label for="nama">icon</label>
    <input type="text" class="form-control" id="icon" name="icon" value="<?= $user_sub_menu['icon'];?>">
    <label for="nama">Active</label>
    <input type="text" class="form-control" id="is_active" name="is_active" value="<?= $user_sub_menu['is_active'];?>">
    <small  class="form-text text-danger"><?= form_error('menu/submenu')?></small>
  </div>
  <button type="submit" name="tambah" class="btn btn-success float-right">ubah</button>
			</form> 
  </div>
</div>
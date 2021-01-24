<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model {

	public function read()
	{
		// query ambil data pelanggan
		$q_read = $this->db->get('pelanggan')->result_array();
		return $q_read;
	}

		public function hapuspelanggan($id){
	
		$this->db->delete('pelanggan',['id_pelanggan'=> $id]);

}

}

/* End of file Pelanggan_model.php */
/* Location: ./application/models/Pelanggan_model.php */
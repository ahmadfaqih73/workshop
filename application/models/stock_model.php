<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {

	public function read()
	{
		// query ambil data pelanggan
		$q_read = $this->db->get('stock')->result_array();
		return $q_read;
	}

	public function hapuspembelian($id){
		$this->db->where('id', $id);
		$this->db->delete('stock');

}

}

/* End of file stock_model.php */
/* Location: ./application/models/stock_model.php */
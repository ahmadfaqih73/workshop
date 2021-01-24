<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian_model extends CI_Model
{

	public function read()
	{

		$this->db->join('stock', 'stock.id_stock =pembelian.barang_idbarang');
		// query ambil data pelanggan
		$q_read = $this->db->get('pembelian')->result_array();
		return $q_read;
	}

	public function hapuspembelian($id)
	{

		$this->db->delete('pembelian', ['id_pembelian' => $id]);
	}
	public function readstock()
	{

		$q_read = $this->db->get('stock')->result_array();
		return $q_read;
	}

	public function hapusstock($id)
	{

		$this->db->delete('stock', ['id_stock' => $id]);
	}



	public function codebarang($kode_barang)
	{
		$this->db->where('kode_barang', $kode_barang);
		return $this->db->get('stok')->num_rows();
	}






	// //ambil data pembelian
	// public function ambilBarangPembelian($id_pembelian)
	// {
	// 	$this->db->where('id_pembelian', $id_pembelian);
	// 	$query = $this->db->get('pembelian')->result();
	// 	return $query;
	// }

	// public function stok($id_stock)
	// {
	// 	$this->db->where('id_stock', $id_stock);
	// 	$query = $this->db->get('stock')->row()->jumlah_barang;
	// 	return $query;
	// }
	// public function stokBaru($nilaiStokBaru, $id_stock)
	// {
	// 	$this->db->where('id_stock', $id_stock);
	// 	$data = array(
	// 		'jumlah_barang' => $nilaiStokBaru
	// 	);
	// 	$query = $this->db->update('stock', $data);
	// 	return $query;
	// }
}

/* End of file pembelian_model.php */
/* Location: ./application/models/pembelian_model.php */
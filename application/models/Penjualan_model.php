<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_model extends CI_Model
{

	public function read()
	{

		$this->db->join('stock', 'stock.id_stock = penjualan.barang_stockid');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = penjualan.pelanggan_pelangganid');

		// query ambil data pelanggan
		$q_read = $this->db->get('penjualan')->result_array();
		return $q_read;
	}

	public function readTransaksi()
	{

		$query = 'SELECT id_transaksi, nama_pelanggan,total,SUM(total) as total, bayar,kembalian, status FROM transaksi JOIN pelanggan ON pelanggan.id_pelanggan = transaksi.pelanggan_idpelanggan GROUP BY id_transaksi';

		$q_read = $this->db->query($query)->result_array();
		return $q_read;
	}
	public function barangkeluar()
	{

		// $this->db->join('stock', 'stock.id_stock = transaksi.barang_stockid');
		$query = 'SELECT id_transaksi, nama_barang,jumlah,tanggal FROM transaksi JOIN stock ON stock.id_stock = transaksi.barang_stockid WHERE status = 1 ';

		$q_read = $this->db->query($query)->result_array();
		return $q_read;
	}

	public function kode()
	{
		$this->db->select('RIGHT(penjualan.kode_pesanan,2) as kode_pesanan', FALSE);
		$this->db->order_by('kode_pesanan', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('penjualan');  //cek dulu apakah ada sudah ada kode di tabel.    
		if ($query->num_rows() <> 0) {
			//cek kode jika telah tersedia    
			$data = $query->row();
			$kode = intval($data->kode_pesanan) + 1;
		} else {
			$kode = 1;  //cek jika kode belum terdapat pada table
		}
		$tgl = date('dmY');
		$batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
		$kodetampil = "BR" . "5" . $tgl . $batas;  //format kode
		return $kodetampil;
	}

	public function update($id_transaksi, $bayar, $total)
	{
		$this->db->where('id_transaksi', $id_transaksi);
		$data = array(
			'bayar' => $bayar,
			'kembalian' => ($bayar  - $total),
			'status' => 1,
			'tanggal' => date('Y-m-d')
		);
		$query = $this->db->update('transaksi', $data);
		return $query;
	}

	public function ambilIdBarangTransaksi($id_transaksi)
	{
		$this->db->where('id_transaksi', $id_transaksi);
		$query = $this->db->get('transaksi')->result();
		return $query;
	}

	public function stok($id_stock)
	{
		$this->db->where('id_stock', $id_stock);
		$query = $this->db->get('stock')->row()->jumlah_barang;
		return $query;
	}

	public function stokBaru($nilaiStokBaru, $barang_stockid)
	{
		$this->db->where('id_stock', $barang_stockid);
		$data = array(
			'jumlah_barang' => $nilaiStokBaru
		);
		$query = $this->db->update('stock', $data);
		return $query;
	}
}

/* End of file Pesanan_model.php */
/* Location: ./application/models/Pesanan_model.php */
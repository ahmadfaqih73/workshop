<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelaporan_model extends CI_Model
{

    public function read()
    {
        $query = 'SELECT id_transaksi, total,bayar,kembalian,tanggal FROM transaksi WHERE status = 1 GROUP BY id_transaksi';

        $q_read = $this->db->query($query)->result_array();
        return $q_read;
    }

    public function readgrafik()
    {
        $q_read = $this->db->get('bulan')->result_array();
        return $q_read;
    }

    public function penjualanGraph($q_bulan = "")
    {

        $sql = $this->db->query("
  
  SELECT
  ifnull((SELECT count(jumlah) FROM (transaksi)WHERE((Month(tanggal)=1))),0) AS `Januari`,
  ifnull((SELECT count(jumlah) FROM (transaksi)WHERE((Month(tanggal)=2))),0) AS `Februari`,
  ifnull((SELECT count(jumlah) FROM (transaksi)WHERE((Month(tanggal)=3))),0) AS `Maret`,
  ifnull((SELECT count(jumlah) FROM (transaksi)WHERE((Month(tanggal)=4))),0) AS `April`,
  ifnull((SELECT count(jumlah) FROM (transaksi)WHERE((Month(tanggal)=5))),0) AS `Mei`,
  ifnull((SELECT count(jumlah) FROM (transaksi)WHERE((Month(tanggal)=6))),0) AS `Juni`,
  ifnull((SELECT count(jumlah) FROM (transaksi)WHERE((Month(tanggal)=7))),0) AS `Juli`,
  ifnull((SELECT count(jumlah) FROM (transaksi)WHERE((Month(tanggal)=8))),0) AS `Agustus`,
  ifnull((SELECT count(jumlah) FROM (transaksi)WHERE((Month(tanggal)=9))),0) AS `September`,
  ifnull((SELECT count(jumlah) FROM (transaksi)WHERE((Month(tanggal)=10))),0) AS `Oktober`,
  ifnull((SELECT count(jumlah) FROM (transaksi)WHERE((Month(tanggal)=11))),0) AS `November`,
  ifnull((SELECT count(jumlah) FROM (transaksi)WHERE((Month(tanggal)=12))),0) AS `Desember`
 from transaksi GROUP BY YEAR(tanggal) 
  
  ");

        return $sql;
    }
}

/* End of file Pelaporan_model.php */
/* Location: ./application/models/Pelaporan_model.php */
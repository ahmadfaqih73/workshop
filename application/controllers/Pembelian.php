<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends CI_Controller
{
        public function __construct()
        {
                parent::__construct();

                // ini adalah untuk menghindari menebak url pada dan memakai session 
                // untuk menghalngi 
                // if(!$this->session->userdata('email')){
                //         redirect('auth');
                // }
                is_logged_in();
                $this->load->model('Pembelian_model');
                $this->load->model('Penjualan_model');
        }
        public function index()
        {
                $data['title'] = 'Pembelian';
                $data['pembelian'] = $this->Pembelian_model->read();
                $data['user'] = $this->db->get_where('user', ['email' =>
                $this->session->userdata('email')])->row_array();

                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('pembelian/pembelian', $data);
                $this->load->view('templates/footer');
        }

        public function updatepembelian()
        {
                $id_pembelian = $this->input->post('id_pembelian');
                $kode_barang = $this->input->post('kode_barang');
                $nama_barang  = $this->input->post('nama_barang');
                $harga_beli  = $this->input->post('harga_beli');
                $jumlah = $this->input->post('jumlah');
                $harga_total = $this->input->post('harga_total');
                $suplier = $this->input->post('suplier');

                $data = array(
                        'barang_kode' => $kode_barang,
                        'nama_barang'  => $nama_barang,
                        'harga_beli' => $harga_beli,
                        'jumlah' => $jumlah,
                        'harga_total' => $harga_total,
                        'suplier' => $suplier
                );

                $this->db->where('id_pembelian', $id_pembelian);
                $q_update = $this->db->update('pembelian', $data);
                if ($q_update) {
                        $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible fade show" role="alert">
                          <strong>Berhasil!</strong> Data sukses diupdate...
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>');
                        // echo "<pre>";
                        // print_r($data);
                        // echo "</pre>";
                        redirect('pembelian', 'refresh');
                } else {
                        redirect('pembelian', 'refresh');
                }
        }

        public function hapuspembelian($id)
        {

                $this->Pembelian_model->hapuspembelian($id);
                $this->session->set_flashdata('message', '<div class="alert
            alert-danger" role="alert">menu succes delete
            </div>');
                redirect('pembelian');
        }

        public function viewadd()
        {
                $data['title'] = 'Pembelian';
                $data['user'] = $this->db->get_where('user', ['email' =>
                $this->session->userdata('email')])->row_array();

                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('pembelian/addpembelian', $data);
                $this->load->view('templates/footer');
        }

        // Method insert pembeliadn stok/ produk
        public function add()
        {

            $barang_idbarang    = $this->input->post('id_stock');
            $harga_beli         = $this->input->post('harga_beli');
            $jumlah             = $this->input->post('jumlah');
            $harga_total        = ($harga_beli * $jumlah);
            $suplier            = $this->input->post('suplier');
                
            $data = array(
                'barang_idbarang'   => $barang_idbarang,
                'harga_beli'        => $harga_beli,
                'harga_total'       => $harga_total,
                'jumlah'            => $jumlah,
                'tanggal'           => date('Y-m-d'),
                'suplier'           => $suplier,
            );

            // Insert to tb_pembelian
            $this->db->insert('pembelian', $data);

            // Get Stok Lama Produk
            $this->db->where('id_stock', $barang_idbarang);
            $stok = $this->db->get('stock')->row()->jumlah_barang;

            // Insert to tb_stok, to update stok produk
            $stok_baru = ($stok + $jumlah);
            $this->db->where('id_stock', $barang_idbarang);
            $data = array(
                'jumlah_barang' => $stok_baru
            );
            $q_update = $this->db->update('stock', $data);

            // Done Process
            if( $q_update ) 
            {
                return 'Berhasil menambahkan stok barang masuk';   
            }
            

        }


        public function stock()
        {
                $data['title'] = 'Stok Barang';
                $data['stock'] = $this->Pembelian_model->readstock();
                $data['user'] = $this->db->get_where('user', ['email' =>
                $this->session->userdata('email')])->row_array();

                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('pembelian/stock', $data);
                $this->load->view('templates/footer');
        }

        public function viewaddstock()
        {
                $data['title'] = 'Pembelian';
                $data['user'] = $this->db->get_where('user', ['email' =>
                $this->session->userdata('email')])->row_array();

                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('pembelian/addstock', $data);
                $this->load->view('templates/footer');
        }

        public function addstock()
        {
                $kode_barang = $this->input->post('kode_barang');
                $nama_barang  = $this->input->post('nama_barang');
                $Hargajual  = $this->input->post('Hargajual');
                $jumlah_barang = $this->input->post('jumlah_barang');
                $data = array(
                        'kode_barang' => $kode_barang,
                        'nama_barang'  => $nama_barang,
                        'Hargajual' => $Hargajual,
                        'jumlah_barang' => $jumlah_barang

                );
                $q_insert = $this->db->insert('stock', $data);
                if ($q_insert) {
                        $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible fade show" role="alert">
  <strong>Sukses!</strong> Berhasil menambahkan data menu baru...
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
                        redirect('pembelian/stock', 'refresh');
                } else {
                        redirect('pembelian/stock', 'refresh');
                }
        }

        public function updatestock()
        {
                $id_stock = $this->input->post('id_stock');
                $kode_barang = $this->input->post('kode_barang');
                $nama_barang  = $this->input->post('nama_barang');
                $Hargajual  = $this->input->post('Hargajual');
                $jumlah_barang = $this->input->post('jumlah_barang');
                $data = array(
                        'kode_barang' => $kode_barang,
                        'nama_barang'  => $nama_barang,
                        'Hargajual' => $Hargajual,
                        'jumlah_barang' => $jumlah_barang

                );

                $this->db->where('id_stock', $id_stock);
                $q_update = $this->db->update('stock', $data);
                if ($q_update) {
                        $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible fade show" role="alert">
  <strong>Berhasil!</strong> Data sukses diupdate...
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
                        redirect('pembelian/stock', 'refresh');
                } else {
                        redirect('pembelian/stock', 'refresh');
                }
        }

        public function hapusstock($id)
        {

                $this->Pembelian_model->hapusstock($id);
                $this->session->set_flashdata('message', '<div class="alert
            alert-danger" role="alert">menu succes delete
            </div>');

                redirect('pembelian/stock');
        }
        public function getNamaBarang()
        {
                header('Content-type: application/json');
                $nama = $this->input->post('nama_barang');
                $this->db->where('jumlah_barang >', 0);
                $this->db->like('nama_barang', $nama);
                $hasil = $this->db->get('stock')->result();
                foreach ($hasil as $dataStock) {
                        $data[] = array(
                                'id'    => $dataStock->id_stock,
                                'text'  => $dataStock->nama_barang
                        );
                }

                echo json_encode($data);
        }

        public function Barang_keluar()
        {
                $data['title'] = 'Barang keluar';
                $data['barang_keluar'] = $this->Penjualan_model->barangkeluar();
                $data['user'] = $this->db->get_where('user', ['email' =>
                $this->session->userdata('email')])->row_array();

                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('pembelian/Barang_keluar', $data);
                $this->load->view('templates/footer');
        }
}

/* End of file Pembelian.php */
/* Location: ./application/controllers/Pembelian.php */
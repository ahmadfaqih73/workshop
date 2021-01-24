<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
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
        $this->load->model('Penjualan_model');
    }

    public function index()
    {
        $data['title'] = 'Penjualan';
        $data['penjualan'] = $this->Penjualan_model->read();
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('penjualan/penjualan', $data);
        $this->load->view('templates/footer');
    }

    public function viewaddpenjualan()
    {
        $data['title'] = 'Penjualan';
        $data['penjualan'] = $this->Penjualan_model->read();
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['kode'] = $this->Penjualan_model->kode();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('penjualan/addpenjualan', $data);
        $this->load->view('templates/footer');
    }

    public function transaksi()
    {
        $data['title'] = 'transaksi';
        $data['transaksi'] = $this->Penjualan_model->readTransaksi();
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('penjualan/transaksi', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {

        $id_transaksi = $this->input->post('id_transaksi');

        $ambilBarang = $this->Penjualan_model->ambilIdBarangTransaksi($id_transaksi);

        foreach ($ambilBarang as $value) {

            $ambilStok = $this->Penjualan_model->stok($value->barang_stockid);

            $nilaiStokBaru = ($ambilStok - $value->jumlah);

            $stokBaru = $this->Penjualan_model->stokBaru($nilaiStokBaru, $value->barang_stockid);
        }

        $bayar = $this->input->post('bayar');
        $total = $this->input->post('total');

        $update = $this->Penjualan_model->update($id_transaksi, $bayar, $total);
        if ($update) {
            $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible fade show" role="alert">
  <strong>Berhasil!</strong> Transaksi berhasil....
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
            redirect('penjualan/transaksi', 'refresh');
        } else {
            redirect('penjualan/transaksi', 'refresh');
        }
    }





    public function addValidPesanan()
    {
        $kode = $this->input->post('kode');
        foreach ($this->cart->contents() as $key => $value) {
        }

        $idpelanggan = $value['idpelanggan1'];

        // if( $idpelanggan == null || $idpelanggan == '' ) {
        //     $idpelanggan = 'Public';
        // }

        foreach ($this->cart->contents() as $items) {
            $data = array(
                'kode_pesanan' => $kode,
                'barang_stockid' => $items['id'],
                'pelanggan_pelangganid' => $idpelanggan,
                'jumlah'          => $items['qty'],
                'tanggal_pesanan'          => date('Y-m-d'),
                'harga'           => $items['price'] * $items['qty']
            );
            $this->db->insert('penjualan', $data);
        }

        $this->cart->destroy();
    }

    function addPesananCart()
    { //fungsi Add To Cart
        $this->db->where('id_stock', $this->input->post('id_stock'));

        $getStock = $this->db->get('stock')->row();

        $data = array(
            'id' => $this->input->post('id_stock'),
            'name' => $getStock->nama_barang,
            'price' => $getStock->Hargajual,
            'qty' => $this->input->post('qty'),
            'idpelanggan1' => $this->input->post('id_pelanggan')
        );
        $this->cart->insert($data);
        echo $this->show_cart(); //tampilkan cart setelah added
    }

    function show_cart()
    { //Fungsi untuk menampilkan Cart
        $output = '';
        $no = 0;
        foreach ($this->cart->contents() as $items) {
            $no++;
            $output .= '
                <tr>
                    <td>' . $items['name'] . '</td>
                    <td>' . number_format($items['price']) . '</td>
                    <td>' . $items['qty'] . '</td>
                    <td>' . number_format($items['subtotal']) . '</td>
                    <td><button type="button" id="' . $items['rowid'] . '" class="hapus_cart btn btn-danger btn-xs">Batal</button></td>
                </tr>
            ';
        }
        $output .= '
            <tr>
                <th colspan="3">Total</th>
                <th colspan="2">' . 'Rp ' . number_format($this->cart->total()) . '</th>
            </tr>
        ';
        return $output;
    }

    function load_cart()
    { //load data cart
        echo $this->show_cart();
    }

    function hapus_cart()
    { //fungsi untuk menghapus item cart
        $data = array(
            'rowid' => $this->input->post('row_id'),
            'qty' => 0,
        );
        $this->cart->update($data);
        echo $this->show_cart();
    }
}

/* End of file Pesanan.php */
/* Location: ./application/controllers/Pesanan.php */
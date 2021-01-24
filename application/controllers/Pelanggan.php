<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

	 public function __construct()
        {
                parent::__construct();

                // ini adalah untuk menghindari menebak url pada dan memakai session 
                // untuk menghalngi 
                // if(!$this->session->userdata('email')){
                //         redirect('auth');
                // }
                is_logged_in();
                $this->load->model('Pelanggan_model');

        }

	public function index()
	{
		$data['title'] = 'Pelanggan';
		$data['pelanggan']= $this->Pelanggan_model->read();
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pelanggan/pelanggan', $data);
        $this->load->view('templates/footer');
	}

	public function viewadd(){
                $data['title'] = 'Pelanggan';        
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pelanggan/addpelanggan', $data);
        $this->load->view('templates/footer');
       
        }

        public function add(){
        	$nama 	= $this->input->post('nama');
		$jk 	= $this->input->post('jenis_kelamin');
		$no_hp 	= $this->input->post('no_hp');
		$alamat = $this->input->post('alamat');

		$data = array(
			'nama_pelanggan' => $nama,
			'jenis_kelamin'  => $jk,
			'no_hp'			=> $no_hp,
			'alamat'		=> $alamat	
		);

		$q_insert = $this->db->insert('pelanggan', $data);
		if( $q_insert ) {
			$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible fade show" role="alert">
  <strong>Sukses!</strong> Berhasil menambahkan data pelanggan baru...
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
			redirect('pelanggan','refresh');
		} else {
			redirect('pelanggan','refresh');
		}

        }

        public function update(){
        	$nama_pelanggan 	= $this->input->post('nama_pelanggan');
		$jk 	= $this->input->post('jenis_kelamin');
		$no_hp 	= $this->input->post('no_hp');
		$alamat = $this->input->post('alamat');

		$id_pelanggan = $this->input->post('id_pelanggan');

		$data = array(
			'nama_pelanggan' => $nama_pelanggan,
			'jenis_kelamin'  => $jk,
			'no_hp'			=> $no_hp,
			'alamat'		=> $alamat	
		);

		$this->db->where('id_pelanggan', $id_pelanggan);
		$q_update = $this->db->update('pelanggan', $data);
		if( $q_update ) {
			$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible fade show" role="alert">
  <strong>Berhasil!</strong> Data sukses diupdate...
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
			redirect('pelanggan','refresh');
		} else {
			redirect('pelanggan','refresh');
		}
        }

        public function hapus($id){
        	$this->Pelanggan_model->hapuspelanggan($id);
        $this->session->set_flashdata('message', '<div class="alert
            alert-danger" role="alert">menu succes delete
            </div>');
                    redirect('pelanggan'); 
        }

        public function getNamaPelanggan()
    {
        header('Content-type: application/json');
        $nama = $this->input->post('nama');
        $this->db->like('nama_pelanggan', $nama);
        $hasil = $this->db->get('pelanggan')->result();
        foreach ($hasil as $dataPelanggan) 
        {
            $data[] = array(
                'id'    => $dataPelanggan->id_pelanggan,
                'text'  => $dataPelanggan->nama_pelanggan
            );
        }

        echo json_encode($data);
    }


}

/* End of file Pelanggan.php */
/* Location: ./application/controllers/Pelanggan.php */
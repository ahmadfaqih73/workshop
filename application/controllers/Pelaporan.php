<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelaporan extends CI_Controller {

	  public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model', 'menu');
        $this->load->model('Menucrud');
        $this->load->model('Pelaporan_model');

        is_logged_in();
           }

	public function riwayat()
	{
		 $data['title'] = 'pelaporan';
        $data['riwayat_penjualan']= $this->Pelaporan_model->read();
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pelaporan/riwayat', $data);
        $this->load->view('templates/footer');
	}

    public function grafik(){
         $data['title'] = 'Grafik';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        
        $data['transaksi']= $this->Pelaporan_model->read();
        $data['bulan']= $this->Pelaporan_model->readgrafik();

        $q_bulan = $this->input->post('bulan');


        foreach($this->Pelaporan_model->penjualanGraph($q_bulan)->result_array() as $row)
       {
        $data['grafik'][]=(float)$row['Januari'];
        $data['grafik'][]=(float)$row['Februari'];
        $data['grafik'][]=(float)$row['Maret'];
        $data['grafik'][]=(float)$row['April'];
        $data['grafik'][]=(float)$row['Mei'];
        $data['grafik'][]=(float)$row['Juni'];
        $data['grafik'][]=(float)$row['Juli'];
        $data['grafik'][]=(float)$row['Agustus'];
        $data['grafik'][]=(float)$row['September'];
        $data['grafik'][]=(float)$row['Oktober'];
        $data['grafik'][]=(float)$row['November'];
        $data['grafik'][]=(float)$row['Desember'];
       }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pelaporan/grafik', $data);
        $this->load->view('templates/footer');
    }

    public function grafikFilter()
    {

    }

}

/* End of file Pelaporan.php */
/* Location: ./application/controllers/Pelaporan.php */
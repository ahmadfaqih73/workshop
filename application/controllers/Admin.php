<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
        }

        public function index()
        {
                $data['title'] = 'Dashboard';
                $data['user'] = $this->db->get_where('user', ['email' =>
                $this->session->userdata('email')])->row_array();

                $bulan = $this->input->post('bulan');

                if (isset($bulan)) {
                        $q_bulan = $bulan;
                } else {
                        $q_bulan = 'MONTH(CURRENT_DATE())';
                }
                // Ambil pemasukan
                $q_pemasukan = $this->db->query('SELECT SUM(transaksi.bayar) AS pemasukan FROM transaksi where MONTH(transaksi.tanggal) = ' . $q_bulan . '')->row()->pemasukan;
                $q_pembelian = $this->db->query('SELECT SUM(pembelian.harga_total) AS pengeluaran FROM pembelian where MONTH(pembelian.tanggal) = ' . $q_bulan . '')->row()->pengeluaran;

                $data['pemasukan'] = $q_pemasukan;
                $data['pengeluaran'] = $q_pembelian;

                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('admin/index', $data);
                $this->load->view('templates/footer');
        }

        public function role()
        {
                $data['title'] = 'role';
                $data['user'] = $this->db->get_where('user', ['email' =>
                $this->session->userdata('email')])->row_array();

                $data['role'] = $this->db->get('user_role')->result_array();

                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('admin/role', $data);
                $this->load->view('templates/footer');
        }
        public function roleaccess($role_id)
        {
                $data['title'] = 'role access';
                $data['user'] = $this->db->get_where('user', ['email' =>
                $this->session->userdata('email')])->row_array();

                // $this->db->where('id !=', 1);

                $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])
                        ->row_array();
                $this->db->where('id !=', 1);
                $data['menu'] = $this->db->get('user_menu')->result_array();

                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('admin/role-access', $data);
                $this->load->view('templates/footer');
        }

        public function changeaccess()
        {
                $menu_id = $this->input->post('menuId');
                $role_id = $this->input->post('roleId');

                $data = [
                        'role_id' => $role_id,
                        'menu_id' => $menu_id
                ];

                $result = $this->db->get_where('user_access_menu', $data);
                if ($result->num_rows()  < 1) {
                        # code...
                        // echo "ada user";
                        $this->db->insert('user_access_menu', $data);
                } else {
                        // echo "tidak";
                        $this->db->delete('user_access_menu', $data);
                }
                $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">Access change
            </div>');
        }
}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
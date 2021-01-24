<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menucrud extends CI_Model {

	//proses Menu

public function hapusmenu($id){
		$this->db->where('id', $id);
$this->db->delete('user_menu');

}

public function getMenu($id){
		return $this->db->get_where('user_menu',['id' => $id])->row_array();
	}

public function updatemenu(){
	$data=[
			"menu" => $this->input->post('menu', true)
			
		];
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('user_menu',$data);
}

//proses sub menu

public function hapussubmenu($id){
		$this->db->where('id', $id);
$this->db->delete('user_sub_menu');

}

public function getSubMenu($id){
		return $this->db->get_where('user_sub_menu',['id' => $id])->row_array();
	}

public function updatesubmenu(){
	$data=[
			"title" => $this->input->post('title', true),
			"menu_id" => $this->input->post('menu_id', true),
			"url" => $this->input->post('url', true),
			"icon" => $this->input->post('icon', true),
			"is_active" => $this->input->post('is_active', true)
			
		];
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('user_sub_menu',$data);
}
	
}

/* End of file Menucrud.php */
/* Location: ./application/models/Menucrud.php */
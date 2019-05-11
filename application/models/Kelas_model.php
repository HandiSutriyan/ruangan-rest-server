<?php

class Kelas_model extends CI_Model{
	public function getKelas($id = null){

		if ($id === null){
			return $this->db->get('kelas')->result_array();
		}else{
			return $this->db->get_where('kelas', ['id' => $id])->result_array();
		}
		
	}

	public function createKelas($data){
		$this->db->insert('kelas', $data);
		return $this->db->affected_rows();
	}
}
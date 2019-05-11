<?php

class Ruang_model extends CI_Model{
	public function getRuang($id = null){
		if ($id === null){
			return $this->db->get('ruang')->result_array();
		}else{
			return $this->db->get_where('ruang', ['id' => $id])->result_array();
		}
	}

	public function createRuang($data){
		$this->db->insert('ruang', $data);
		return $this->db->affected_rows();
	}

	public function updateRuang($data, $id){
		$this->db->update('ruang', $data, ['id' => $id]);
		return $this->db->affected_rows();
	}

	public function deleteRuang($id){
		$this->db->delete('ruang', ['id' => $id]);
		return $this->db->affected_rows();
	}
}
<?php

class Status_model extends CI_Model{
	public function getStatus($id = null){
		$this->db->select('*');
		$this->db->from('status');
		$this->db->join('ruang', 'ruang.id = status.ruang_id');
		$this->db->join('kelas', 'kelas.id = status.kelas_id');

		if ($id === null){
			$query = $this->db->get();
			return $query->result_array();
		}else{
			$this->db->where('ruang_id', $id);
			$query = $this->db->get();
			return $query->result_array();
		}
	}

	public function createStatus($data){
		$this->db->insert('status', $data);
		return $this->db->affected_rows();
	}

	public function updateStatus($id){
		$this->db->update('status', ['id', $id]);
		return $this->db->affected_rows();
	}
}
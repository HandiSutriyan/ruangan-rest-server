<?php

class Jadwal_model extends CI_Model{
	public function getJadwal($id = null){
		if ($id === null){
			return $this->db->get('jadwal')->result_array();
		}else{
			return $this->db->get_where('jadwal', ['id' => $id])->result_array();
		}
	}

	public function createJadwal($data){
		$this->db->insert('jadwal', $data);
		return $this->db->affected_rows();
	}

	public function updateJadwal($data, $id){
		$this->db->update('jadwal', $data, ['id'=> $id]);
		return $this->db->affected_rows();
	}

	public function deleteJadwal($id){
		$this->db->delete('jadwal', ['id' => $id]);
		return $this->db->affected_rows();
	}
}
<?php

class Jam_model extends CI_Model{
	public function getJam($id = null){
		if ($id === null){
			return $this->db->get('paket_jam')->result_array();
		}else{
			return $this->db->get_where('paket_jam', ['id' => $id])->result_array();
		}
	}

	public function createJam($data){
		$this->db->insert('paket_jam', $data);
		return $this->db->affected_rows();
	}

	public function updateJam($data, $id){
		$this->db->update('paket_jam', $data, ['id'=> $id]);
		return $this->db->affected_rows();
	}

	public function deleteJam($id){
		$this->db->delete('paket_jam', ['id' => $id]);
		return $this->db->affected_rows();
	}
}
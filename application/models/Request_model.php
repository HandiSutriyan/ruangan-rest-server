<?php

class Request_model extends CI_Model{
	public function getRequest($id = null){
		if ($id === null){
			return $this->db->get('request')->result_array();
		}else{
			return $this->db->get_where('request', ['id' => $id])->result_array();
		}
	}

	public function createRequest($data){
		$this->db->insert('request', $data);
		return $this->db->affected_rows();
	}

	public function updateRequest($data, $id){
		$this->db->update('request', $data, ['id'=> $id]);
		return $this->db->affected_rows();
	}

	public function deleteRequest($id){
		$this->db->delete('request', ['id' => $id]);
		return $this->db->affected_rows();
	}
}
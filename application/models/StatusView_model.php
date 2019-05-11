<?php

class StatusView_model extends CI_Model{
	public function getStatusView(){
		$this->db->select('*');
		$this->db->from('jadwal');
		$this->db->join('kelas', 'kelas.id = jadwal.kelas_id');
		$this->db->join('ruang', 'ruang.id = jadwal.ruang_id');
		$query = $this->db->get();
		return $query->result_array();
	}
}
<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Jadwal extends REST_Controller{
	public function __construct(){
		parent :: __construct();
		$this->load->model('Jadwal_model', 'jadwal');
	}

	public function index_get(){
		$id = $this->get('id');
		if ($id === null){
			$jadwal = $this->jadwal->getJadwal();
		}else{
			$jadwal = $this->jadwal->getJadwal($id);
		}

		if ($jadwal){
			 $this->response([
                    'status' => TRUE,
                    'data' => $jadwal
                ], REST_Controller::HTTP_OK);
			}else{
				$this->response([
                    'status' => FALSE,
                    'message' => 'No users id were found'
                ], REST_Controller::HTTP_NOT_FOUND);
			}
	}

	public function index_post(){
		$data = [
			'hari' => $this->post('hari'),
			'matkul' => $this->post('matkul'),
			'dosen' => $this->post('dosen'),
			'paket_jam_id_mulai' => $this->post('paket_jam_id_mulai'),
			'paket_jam_id_selesai' => $this->post('paket_jam_id_selesai'),
			'ruang_id' => $this->post('ruang_id'),
			'kelas_id' => $this->post('kelas_id'),
		];

		if ($this->jadwal->createJadwal($data) > 0){
			$this->response([
                    'status' => TRUE,
                    'data' => $data,
                    'message' => 'new data has been created'
                ], REST_Controller::HTTP_CREATED);
		}else{
			$this->response([
                    'status' => FALSE,
                    'message' => ' new data not created'
                ], REST_Controller::HTTP_BAD_REQUEST);	
		}
	}

	public function index_put(){
		$id = $this->put('id');
		$data = [
			'hari' => $this->put('hari'),
			'matkul' => $this->put('matkul'),
			'dosen' => $this->put('dosen'),
			'paket_jam_id_mulai' => $this->put('paket_jam_id_mulai'),
			'paket_jam_id_selesai' => $this->put('paket_jam_id_selesai'),
			'ruang_id' => $this->put('ruang_id'),
			'kelas_id' => $this->put('kelas_id'),
		];

		if($this->jadwal->updateJadwal($data, $id) > 0){
			$this->response([
                    'status' => TRUE,
                    'data' => $data,
                    'message' => 'data has been updated'
                ], REST_Controller::HTTP_OK);
		}else{
			 $this->response([
                    'status' => FALSE,
                    'message' => 'data not updated'
                ], REST_Controller::HTTP_BAD_REQUEST);	
		}
	}

	public function index_delete(){
		$id = $this->delete('id');
		if($id === null){
			$this->response([
                    'status' => FALSE,
                    'message' => ' id required'
                ], REST_Controller::HTTP_BAD_REQUEST);
		}else{
			if($this->jadwal->deleteJadwal($id) > 0){
				$this->response([
                    'status' => TRUE,
                    'id' => $id,
                    'message' => 'data was deleted'
                ], REST_Controller::HTTP_OK);
			}else{
				$this->response([
                    'status' => FALSE,
                    'message' => ' id was not found'
                ], REST_Controller::HTTP_NOT_FOUND);
			}
		}
	}
}
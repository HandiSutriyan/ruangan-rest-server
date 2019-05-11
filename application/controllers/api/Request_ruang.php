<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Request_ruang extends REST_Controller{
	public function __construct(){
		parent :: __construct();
		$this->load->model('Request_model', 'request_ruang');
	}

	public function index_get(){
		$id = $this->get('id');
		if ($id === null){
			$request_ruang = $this->request_ruang->getRequest();
		}else{
			$request_ruang = $this->request_ruang->getRequest($id);
		}

		if ($request_ruang){
			 $this->response([
                    'status' => TRUE,
                    'data' => $request_ruang
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
			'user' => $this->post('user'),
			'kelas_id' => $this->put('kelas_id'),
			'matkul' => $this->post('matkul'),
			'dosen' => $this->post('dosen'),
			'hari' => $this->post('hari'),
			'tanggal' => $this->post('tanggal'),
			'ruang_id' => $this->post('ruang_id'),
			'jam_mulai' => $this->post('jam_mulai'),
			'jam_selesai' => $this->post('jam_selesai'),
		];

		if ($this->request_ruang->createRequest($data) > 0){
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
			'user' => $this->put('user'),
			'kelas_id' => $this->put('kelas_id'),
			'matkul' => $this->put('matkul'),
			'dosen' => $this->put('dosen'),
			'hari' => $this->put('hari'),
			'tanggal' => $this->put('tanggal'),
			'ruang_id' => $this->put('ruang_id'),
			'jam_mulai' => $this->put('jam_mulai'),
			'jam_selesai' => $this->put('jam_selesai'),
		];


		if($this->request_ruang->updateRequest($data, $id) > 0){
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
			if($this->request_ruang->deleteRequest($id) > 0){
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
<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Kelas extends REST_Controller{
	//load model
	public function __construct(){
		parent :: __construct();
		$this->load->model('Kelas_model','kelas');

		//$this->methods['index_get']['limit'] = 12;
	}

	public function index_get(){
		$id= $this->get('id');

		if($id == null){
			$kelas = $this->kelas->getKelas();
		}else{
			$kelas = $this->kelas->getKelas($id);
		}

		// var_dump($kelas); respon bentuk array

		if ($kelas){
			 $this->response([
                    'status' => TRUE,
                    'data' => $kelas
                ], REST_Controller::HTTP_OK);
		}else{
			 $this->response([
                    'status' => FALSE,
                    'message' => 'No id were found'
                ], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function index_post(){
		$data=[
			'kelas' => $this->post('kelas'),
			'semester' => $this->post('semester'),
			'pj' => $this->post('pj'),
			'no_hp' => $this->post('no_hp'),
		];

		if ($this->kelas->createKelas($data) > 0){
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

		$data=[
			'kelas' => $this->put('kelas'),
			'semester' => $this->put('semester'),
			'pj' => $this->put('pj'),
			'no_hp' => $this->put('no_hp'),
		];

		if ($this->kelas->updateKelas($data, $id) > 0){
			$this->response([
                    'status' => TRUE,
                    'data' => $data,
                    'message' => 'new data has been updated'
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

		if ($id === null){
			 $this->response([
                    'status' => FALSE,
                    'message' => ' id required'
                ], REST_Controller::HTTP_BAD_REQUEST);
			}else{
				if ($this->kelas->deleteKelas($id) > 0){
						$this->response([
	                    'status' => TRUE,
	                    'id' => $id,
	                    'message' => 'data has been deleted'
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
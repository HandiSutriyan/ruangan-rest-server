<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Ruang extends REST_Controller{
	//load model
	public function __construct(){
		parent :: __construct();
		$this->load->model('Ruang_model', 'ruang');
	}

	public function index_get(){
		$id = $this->get('id');

		if($id === null){
			$ruang = $this->ruang->getRuang();
		}else{
			$ruang = $this->ruang->getRuang($id);
		}

		if ($ruang){
			 $this->response([
                    'status' => TRUE,
                    'data' => $ruang
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
			'gedung' => $this->post('gedung'),
			'ruang' => $this->post('ruang'),
		];

		if ($this->ruang->createRuang($data) > 0){
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
			'gedung' => $this->put('gedung'),
			'ruang' => $this->put('ruang'),
		];

		if($this->ruang->updateRuang($data, $id) > 0){
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
			if($this->ruang->deleteRuang($id) > 0){
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
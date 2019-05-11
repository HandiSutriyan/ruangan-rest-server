<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Jam extends REST_Controller{
	public function __construct(){
		parent :: __construct();
		$this->load->model('Jam_model', 'jam');
	}

	public function index_get(){
		$id = $this->post('id');

		if ($id === null){
			$jam = $this->jam->getJam();
		}else{
			$jam = $this->jam->getJam($id);
		}

		if ($jam){
			 $this->response([
                    'status' => TRUE,
                    'data' => $jam
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
			'paket' => $this->post('paket'),
			'jam_mulai' => $this->post('jam_mulai'),
			'normal' => $this->post('normal'),
		];

		if ($this->jam->createJam($data) > 0){
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
			'paket' => $this->put('paket'),
			'jam_mulai' => $this->put('jam_mulai'),
			'normal' => $this->put('normal'),
		];

		if($this->jam->updateJam($data, $id) > 0){
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
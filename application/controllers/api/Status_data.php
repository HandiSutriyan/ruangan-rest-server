<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Status_data extends REST_Controller{
	public function __construct(){
		parent :: __construct();
		$this->load->model('Status_model', 'status_data');
	}

	public function index_get(){
		$id = $this->get('id');
		if ($id === null){
			$status_data = $this->status_data->getStatus();
		}else{
			$status_data = $this->status_data->getStatus($id);
		}
		
		 if ($status_data){
		 	$this->response([
                    'status' => TRUE,
                    'data' => $status_data
                ], REST_Controller::HTTP_OK);
		 }else{
		 	$this->response([
                    'status' => FALSE,
                    'message' => 'data not found'
                ], REST_Controller::HTTP_NOT_FOUND);
		 }
	}

}
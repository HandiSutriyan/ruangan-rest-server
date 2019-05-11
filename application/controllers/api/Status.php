<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Status extends REST_Controller{
	public function __construct(){
		parent :: __construct();
		$this->load->model('StatusView_model', 'status');
	}

	public function index_get(){
		$status_view = $this->status->getStatusView();
		 if ($status_view){
		 	$this->response([
                    'status' => TRUE,
                    'data' => $status_view
                ], REST_Controller::HTTP_OK);
		 }else{
		 	$this->response([
                    'status' => FALSE,
                    'message' => 'data not found'
                ], REST_Controller::HTTP_NOT_FOUND);
		 }
	}

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Masterdata extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('masterdata_model');
		$this->load->model('global_model');
		$this->load->helper(array('url', 'html'));
	}

	public function index(){
		if(isset($_SESSION['user_name']) != null){
			redirect('Dashboard/Admin', 'refresh');
		}else{
			$this->load->view('Pages/login');
		}
	}


	private function check_auth($modul){
		if(isset($_SESSION['user_name']) == null){
			redirect('Masterdata', 'refresh');
		}else{
			$user_role_id = $_SESSION['user_role_id'];
			$check_access = $this->global_model->check_access($user_role_id, $modul);
			return($check_access);
		}
	}

	// customer //

	public function customer()
	{
		$modul = 'Customer';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$check_auth['check_auth'] = $check_auth;
			$this->load->view('Pages/Masterdata/customer', $check_auth);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}

	public function customer_list()
	{
		$modul = 'Customer';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$search 			= $this->input->post('search');
			$length 			= $this->input->post('length');
			$start 			  	= $this->input->post('start');

			if($search != null){
				$search = $search['value'];
			}
			$list = $this->masterdata_model->customer_list($search, $length, $start)->result_array();
			$count_list = $this->masterdata_model->customer_list_count($search)->result_array();
			$total_row = $count_list[0]['total_row'];
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $field) {

				if($check_auth[0]->edit == 'Y'){
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" data-bs-toggle="modal" data-bs-target="#exampleModaledit" data-id="'.$field['customer_id'].'" data-codes="'.$field['customer_code'].'" data-name="'.$field['customer_name'].'" data-phone="'.$field['customer_phone'].'" data-address="'.$field['customer_address'].'"><i class="fas fa-edit sizing-fa"></i></button> ';
				}else{
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-edit sizing-fa"></i></button> <button type="button" class="btn btn-icon btn-info btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-cog sizing-fa"></i></button> ';
				}


				if($check_auth[0]->delete == 'Y'){
					$delete = '<button type="button" class="btn btn-icon btn-danger delete btn-sm mb-2-btn" onclick="deletes('.$field['customer_id'].')"><i class="fas fa-trash-alt sizing-fa"></i></button> ';
				}else{
					$delete = '<button type="button" class="btn btn-icon btn-danger delete btn-sm mb-2-btn"  disabled="disabled"><i class="fas fa-trash-alt sizing-fa"></i></button> ';
				}

				$no++;
				$row = array();
				$row[] = $field['customer_code'];
				$row[] = $field['customer_name'];
				$row[] = $field['customer_phone'];
				$row[] = $field['customer_address'];
				$row[] = $edit.$delete;
				$data[] = $row;
			}

			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $total_row,
				"recordsFiltered" => $total_row,
				"data" => $data,
			);
			echo json_encode($output);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);die();
		}
	}

	public function save_customer()
	{	

		$modul = 'Customer';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){
			$customer_name 				= $this->input->post('customer_name');
			$customer_phone 			= $this->input->post('customer_phone');
			$customer_address 			= $this->input->post('customer_address');
			$user_id 		   			= $_SESSION['user_id'];

			if($customer_name == null){
				$msg = "Nama pelanggan Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			$maxCode = $this->masterdata_model->last_customer_code();
			if ($maxCode == NULL) {
				$last_code = 'C000001';
			} else {
				$maxCode = $maxCode[0]->product_code;
				$last_code = substr($maxCode, -6);
				$last_code = 'C'.substr('000000' . strval(floatval($last_code) + 1), -6);
			}
			
			$data_insert = array(
				'customer_code'	       		=> $last_code,
				'customer_name'	       		=> $customer_name,
				'customer_phone'	   		=> $customer_phone,
				'customer_address'	    	=> $customer_address,
			);

			$this->masterdata_model->save_customer($data_insert);
			$msg = "Succes Input";
			echo json_encode(['code'=>200, 'result'=>$msg]);
			die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}

	public function edit_customer()
	{
		$modul = 'Customer';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->edit == 'Y'){
			$customer_id 				= $this->input->post('customer_id');
			$customer_name 				= $this->input->post('customer_name');
			$customer_phone 			= $this->input->post('customer_phone');
			$customer_address 			= $this->input->post('customer_address');
			$user_id 		   			= $_SESSION['user_id'];

			if($customer_name == null){
				$msg = "Nama pelanggan Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			$data_update = array(
				'customer_name'	       		=> $customer_name,
				'customer_phone'	   		=> $customer_phone,
				'customer_address'	    	=> $customer_address,
			);

			$this->masterdata_model->edit_customer($data_update, $customer_id);
			$msg = "Succes Edit";
			echo json_encode(['code'=>200, 'result'=>$msg]);
			die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}
	}

	public function delete_customer()
	{
		$modul = 'Customer';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->delete == 'Y'){
			$customer_id  	= $this->input->post('id');
			$user_id 		= $_SESSION['user_id'];
			$this->masterdata_model->delete_customer($customer_id);
			$msg = "Succes Delete";
			echo json_encode(['code'=>200, 'result'=>$msg]);
			die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}
	
	// end customer //


	// product //

	public function product()
	{
		$modul = 'Product';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$check_auth['check_auth'] = $check_auth;
			$this->load->view('Pages/Masterdata/product', $check_auth);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}

	public function product_list()
	{
		$modul = 'Product';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$search 			= $this->input->post('search');
			$length 			= $this->input->post('length');
			$start 			  	= $this->input->post('start');

			if($search != null){
				$search = $search['value'];
			}
			$list = $this->masterdata_model->product_list($search, $length, $start)->result_array();
			$count_list = $this->masterdata_model->product_list_count($search)->result_array();
			$total_row = $count_list[0]['total_row'];
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $field) {

				if($check_auth[0]->edit == 'Y'){
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" data-bs-toggle="modal" data-bs-target="#exampleModaledit" data-id="'.$field['product_id'].'" data-codes="'.$field['product_code'].'" data-name="'.$field['product_name'].'" data-price="'.$field['product_price'].'"><i class="fas fa-edit sizing-fa"></i></button> ';
				}else{
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-edit sizing-fa"></i></button> <button type="button" class="btn btn-icon btn-info btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-cog sizing-fa"></i></button> ';
				}


				if($check_auth[0]->delete == 'Y'){
					$delete = '<button type="button" class="btn btn-icon btn-danger delete btn-sm mb-2-btn" onclick="deletes('.$field['product_id'].')"><i class="fas fa-trash-alt sizing-fa"></i></button> ';
				}else{
					$delete = '<button type="button" class="btn btn-icon btn-danger delete btn-sm mb-2-btn"  disabled="disabled"><i class="fas fa-trash-alt sizing-fa"></i></button> ';
				}

				$no++;
				$row = array();
				$row[] = $field['product_code'];
				$row[] = $field['product_name'];
				$row[] = 'Rp. '.number_format($field['product_price']);
				$row[] = $edit.$delete;
				$data[] = $row;
			}

			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $total_row,
				"recordsFiltered" => $total_row,
				"data" => $data,
			);
			echo json_encode($output);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);die();
		}
	}

	public function save_product()
	{	

		$modul = 'Product';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){
			$product_name 				= $this->input->post('product_name');
			$product_price 				= $this->input->post('product_price_val');
			$user_id 		   			= $_SESSION['user_id'];
			if($product_name == null){
				$msg = "Nama Produk Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}
			if($product_price <= 0){
				$msg = "Harga Jual Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}
			$maxCode = $this->masterdata_model->last_product_code();

			if ($maxCode == NULL) {
				$last_code = 'P000001';
			} else {
				$maxCode = $maxCode[0]->product_code;
				$last_code = substr($maxCode, -6);
				$last_code = 'P'.substr('000000' . strval(floatval($last_code) + 1), -6);
			}
			
			$data_insert = array(
				'product_code'	    => $last_code,
				'product_name'	    => $product_name,
				'product_price'	   	=> $product_price,
			);
			$this->masterdata_model->save_product($data_insert);
			$msg = "Succes Input";
			echo json_encode(['code'=>200, 'result'=>$msg]);
			die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}

	public function edit_product()
	{
		$modul = 'Product';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->edit == 'Y'){
			$product_id 				= $this->input->post('product_id');
			$product_name 				= $this->input->post('product_name');
			$product_price 				= $this->input->post('product_price_val');
			$user_id 		   			= $_SESSION['user_id'];
			if($product_name == null){
				$msg = "Nama Produk Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}
			if($product_price <= 0){
				$msg = "Harga Jual Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}
			$data_update = array(
				'product_name'	    => $product_name,
				'product_price'	   	=> $product_price,
			);
			$this->masterdata_model->edit_product($data_update, $product_id);
			$msg = "Succes Edit";
			echo json_encode(['code'=>200, 'result'=>$msg]);
			die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}
	}
	// end product //



}	

?>
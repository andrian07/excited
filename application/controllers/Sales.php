<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Sales extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('masterdata_model');
		$this->load->model('global_model');
		$this->load->model('transaction_model');
		$this->load->helper(array('url', 'html'));
	}

	public function index(){
		if(isset($_SESSION['user_name']) != null){
			redirect('Sales/salesview', 'refresh');
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

	// sales //

	public function salesview()
	{
		$modul = 'Sales';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$check_auth['check_auth'] = $check_auth;
			$this->load->view('Pages/Sales/sales', $check_auth);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}

	public function addsales()
	{
		$modul = 'Sales';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$check_auth['check_auth'] = $check_auth;
			$customer_list['customer_list'] = $this->global_model->customer_list();
			$ekspedisi_list['ekspedisi_list'] = $this->global_model->ekspedisi_list();
			$data['data'] = array_merge($check_auth, $customer_list, $ekspedisi_list);
			$this->load->view('Pages/Sales/addsales', $data);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);die();
		}
	}

	public function transaction_list()
	{
		$modul = 'Sales';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$search 			= $this->input->post('search');
			$length 			= $this->input->post('length');
			$start 			  	= $this->input->post('start');

			if($search != null){
				$search = $search['value'];
			}
			$list = $this->transaction_model->transaction_list($search, $length, $start)->result_array();
			$count_list = $this->transaction_model->transaction_list_count($search)->result_array();
			$total_row = $count_list[0]['total_row'];
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $field) {

				$detail = '<a href="'.base_url().'Register/detailtransaction?id='.$field['transaction_header_id'].'" data-fancybox="" data-type="iframe"><button type="button" class="btn btn-icon btn-primary btn-sm mb-2-btn" data-id="'.$field['transaction_header_id'].'"><i class="fas fa-eye sizing-fa"></i></button></a> ';

				if($check_auth[0]->edit == 'Y'){
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" data-bs-toggle="modal" data-bs-target="#exampleModaledit" data-id="'.$field['transaction_header_id'].'" data-name="'.$field['transaction_header_invoice'].'"><i class="fas fa-edit sizing-fa"></i></button> ';
				}else{
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-edit sizing-fa"></i></button> <button type="button" class="btn btn-icon btn-info btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-cog sizing-fa"></i></button> ';
				}

				$print = '<a href="'.base_url().'Sales/print_nota?id='.$field['transaction_header_id'].'"><button type="button" class="btn btn-icon btn-info btn-sm mb-2-btn" data-id="'.$field['transaction_header_id'].'" title="Print"><i class="fas fa-copy sizing-fa"></i></button></a> ';

				$date = date_create($field['transaction_header_date']); 

				//$url_image = base_url().'assets/products/'.$field['product_image'];
				$no++;
				$row = array();
				$row[] = $field['transaction_header_invoice'];
				$row[] = $field['customer_name'];
				$row[] = date_format($date,"d-m-Y");
				$row[] = 'Rp. '.number_format($field['transaction_header_subtotal']);
				$row[] = 'Rp. '.number_format($field['transaction_header_discount']);
				$row[] = 'Rp. '.number_format($field['transaction_header_total']);
				$row[] = $detail.$edit.$print;
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

	public function print_nota()
	{
		$transaction_register_id  = $this->input->get('id');
		//$get_register['get_register'] = $this->register_model->get_register($transaction_register_id);
		//$get_detail_register['get_detail_register'] = $this->register_model->get_detail_register($transaction_register_id);
		//$data['data'] = array_merge($get_register, $get_detail_register);
		$this->load->view('Pages/Sales/print');
	}

	public function print_dispatch()
	{
		$transaction_register_id  = $this->input->get('id');
		//$get_register['get_register'] = $this->register_model->get_register($transaction_register_id);
		//$get_detail_register['get_detail_register'] = $this->register_model->get_detail_register($transaction_register_id);
		//$data['data'] = array_merge($get_register, $get_detail_register);
		$this->load->view('Pages/Sales/dispatch');
	}


	public function temp_sales_list()
	{
		$modul = 'Sales';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$search 			= $this->input->post('search');
			$length 			= $this->input->post('length');
			$start 			  	= $this->input->post('start');

			if($search != null){
				$search = $search['value'];
			}
			$list = $this->transaction_model->temp_sales_list($search, $length, $start)->result_array();
			$count_list = $this->transaction_model->temp_sales_list_count($search)->result_array();
			$total_row = $count_list[0]['total_row'];
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $field) {

				$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-edit sizing-fa"></i></button> <button type="button" class="btn btn-icon btn-info btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-cog sizing-fa"></i></button> ';
				$delete = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-edit sizing-fa"></i></button> <button type="button" class="btn btn-icon btn-info btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-cog sizing-fa"></i></button> ';

				$no++;
				$row = array();
				$row[] = $field['product_code'];
				$row[] = $field['product_name'];
				$row[] = 'Rp. '.number_format($field['temp_price']);
				$row[] = $field['temp_qty'];
				$row[] = 'Rp. '.number_format($field['temp_total']);
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

	public function get_customer()
	{
		$customer_id = $this->input->post('customer_id');
		$get_customer = $this->global_model->get_customer($customer_id);
		echo json_encode(['code'=>200, 'result'=>$get_customer]);die();
	}

	public function search_product()
	{	
		$supplier_id = $this->input->get('id');
		$keyword = $this->input->get('term');
		$result = ['success' => FALSE, 'num_product' => 0, 'data' => [], 'message' => ''];
		if (!($keyword == '' || $keyword == NULL)) {
			$find = $this->global_model->search_product($keyword)->result_array();
			$find_result = [];
			foreach ($find as $row) {
				$diplay_text = $row['product_name'];
				$find_result[] = [
					'id'                  => $row['product_id'],
					'value'               => $diplay_text,
					'product_price'       => $row['product_price'],
				];
			}
			$result = ['success' => TRUE, 'num_product' => count($find_result), 'data' => $find_result, 'message' => ''];
		}
		echo json_encode($result);
	} 

	public function save_product()
	{	

		$product_id 				= $this->input->post('product_id');
		$temp_price_val 			= $this->input->post('temp_price_val');
		$temp_qty 					= $this->input->post('temp_qty');
		$temp_total_val 			= $this->input->post('temp_total_val');
		$user_id 		   			= $_SESSION['user_id'];

		if($product_id == null){
			$msg = "Nama Produk Harus Di isi";
			echo json_encode(['code'=>0, 'result'=>$msg]);die();
		}
		if($temp_qty <= 0){
			$msg = "Qty Harus Di isi";
			echo json_encode(['code'=>0, 'result'=>$msg]);die();
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
	}
	// end sales //

}	

?>
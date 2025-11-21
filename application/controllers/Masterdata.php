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

	// member //

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
				$maxCode = $maxCode[0]->customer_code;
				$last_code = substr($maxCode, -7);
				$last_code = substr('C00000' . strval(floatval($last_code) + 1), -7);
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
			$msg = "Succes Input";
			echo json_encode(['code'=>200, 'result'=>$msg]);
			die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}
	}

	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';

		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[random_int(0, $charactersLength - 1)];
		}

		return $randomString;
	}

	public function edit_member()
	{
		$modul = 'Member';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->edit == 'Y'){
			$screenshoot 				= $this->input->post('screenshoot_edit');
			$member_id   				= $this->input->post('member_id_edit');
			$member_code 				= $this->input->post('member_code_edit');
			$member_name 				= $this->input->post('member_name_edit');
			$member_phone 				= $this->input->post('member_phone_edit');
			$member_nik 				= $this->input->post('member_nik_edit');
			$member_dob 		 		= $this->input->post('member_dob_edit');
			$member_email   			= $this->input->post('member_email_edit');
			$member_address      		= $this->input->post('member_address_edit');
			$member_gender      		= $this->input->post('member_gender_edit');
			$member_urgent_phone	 	= $this->input->post('member_urgent_phone_edit');
			$member_urgent_sibiling 	= $this->input->post('member_urgent_sibiling_edit');
			$member_desc 				= $this->input->post('member_desc_edit');

			$user_id 		   			= $_SESSION['user_id'];

			if($member_name == null){
				$msg = "Nama member Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($member_phone == null){
				$msg = "No Hp Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			$get_member_by_id = $this->masterdata_model->get_member_by_id($member_id);

			$check_image_name = $get_member_by_id[0]->member_image;

			if($_FILES['screenshoot_edit']['name'] == null){
				$new_image_name = $get_member_by_id[0]->member_image;
			}else{
				if($check_image_name != $_FILES['screenshoot_edit']['name']){
					$new_image_name = $member_code.$this->generateRandomString().'.png';
					$config['upload_path'] = './assets/member/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|PNG';
					$config['file_name'] = $new_image_name;
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('screenshoot_edit')) 
					{
						$error = array('error' => $this->upload->display_errors());
						echo json_encode(['code'=>0, 'result'=>$error]);die();
					} 
					else
					{
						$data = array('image_metadata' => $this->upload->data());
					}
				}else{
					$new_image_name = $check_image_name;
				}
			}

			$data_edit = array(
				'member_name'	       		=> $member_name,
				'member_phone'	   			=> $member_phone,
				'member_address'	    	=> $member_address,
				'member_dob'	       		=> $member_dob,
				'member_gender'	    		=> $member_gender,
				'member_nik'				=> $member_nik,
				'member_email'	    		=> $member_email,
				'member_image'				=> $new_image_name,
				'member_urgent_phone'		=> $member_urgent_phone,
				'member_urgent_sibiling'	=> $member_urgent_sibiling,
				'member_desc'				=> $member_desc,
			);

			$this->masterdata_model->edit_member($data_edit, $member_id);

			$data_insert_act = array(
				'activity_table_desc'	       => 'Ubah Master Member '.$member_name,
				'activity_table_user'	       => $user_id,
			);
			$this->global_model->save($data_insert_act);

			$msg = "Succes Input";
			echo json_encode(['code'=>200, 'result'=>$msg]);
			die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}

	public function get_member_id()
	{
		$id = $this->input->post('id');
		$get_member_by_id['get_member_by_id'] = $this->masterdata_model->get_member_by_id($id);
		echo json_encode(['code'=>200, 'result'=>$get_member_by_id]);
	}

	public function delete_member()
	{
		$modul = 'Member';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->delete == 'Y'){
			$member_id  	= $this->input->post('id');
			$user_id 		= $_SESSION['user_id'];
			$this->masterdata_model->delete_member($member_id);
			$data_insert_act = array(
				'activity_table_desc'	       => 'Hapus Master member',
				'activity_table_user'	       => $user_id,
			);
			$this->global_model->save($data_insert_act);
			$msg = "Succes Delete";
			echo json_encode(['code'=>200, 'result'=>$msg]);
			die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}

	public function get_edit_member()
	{
		$modul = 'Member';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$id = $this->input->post('id');
			$detail_edit_member = $this->masterdata_model->get_member_by_id($id);
			echo json_encode(['code'=>200, 'result'=>$detail_edit_member]);die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);die();
		}
	}
	
	// end member //


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
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" data-bs-toggle="modal" data-bs-target="#exampleModaledit" data-id="'.$field['product_id'].'" data-name="'.$field['product_name'].'"><i class="fas fa-edit sizing-fa"></i></button> ';
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

	
	// end member //



}	

?>
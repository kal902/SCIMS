<?php
include_once "models/Accounts.php";
include_once "models/Patients.php";
include_once "models/Prescriptions.php";
include_once "models/Pending_patients.php";
include_once "models/Drug_store.php";
include_once "models/Lab_request.php";
include_once "models/Lab_result.php";
include_once "models/Drug_request.php";
class Controller{
	private $session;
	public function __construct($req){
		$this->date=date("Y-m-d");
		//$this->session = $_SESSION['id'];
		$this->request = $req;
		$this->views = array("admin"=>"../SCIMS/views/admin.php",
							 "manager"=>"../SCIMS/views/manager.php",
							 "doctor"=>"../SCIMS/views/doctor.php",
							 "lab_tech"=>"../SCIMS/views/lab_tech.php",
							 "dispensary"=>"../SCIMS/views/dispensary.php",
							 "drug_store_mgr"=>"../SCIMS/views/drug_store_mgr.php",
							 "registrar"=>"../SCIMS/views/registrar.php");
	}

	function view_login(){
		$failed_auth = false; // if true, login.php will show auth failed message.
		include_once "../SCIMS/views/login.php";

	}

	function login(){
		$data = $this->request->getBody();
		$id = $data['id'];
		$pass = $data['pass'];

		$acc = new Accounts();
		$failed_auth = false;
		if($acc->auth($id, $pass)){
			$account_type = $acc->account_type($id);
			session_start();
			$_SESSION['id'] = $id;
			$_SESSION['account_type'] = $account_type;
			/*
			foreach ($this->views as $view => $path) {
				if($account_type==$view){
					include_once $path;
				}
			}
			*/
			switch ($account_type){
				case "admin":
					include_once $this->views['admin'];
					break;
				case "doctor":
					$lab_request = new LabRequest();
					$prescriptions = new Prescriptions();
					$patients = new Patients(); // doctor.php needs Patients class obj.
					$pending_patients = new PendingPatients();
					include_once $this->views['doctor'];
					break;
				case "registrar":
					$patients = new Patients(); // doctor.php needs Patients class obj.
					include_once $this->views['registrar'];
					break;
				case "dispensary":
					$prescriptions = new Prescriptions();
					$drugstore = new DrugStore();
					include_once $this->views['dispensary'];
					break;
				case "drug_store_man":
					$drugstore = new DrugStore();
					include_once $this->views['drug_store_mgr'];
					break;
				case "lab_tech":
					$lab_request = new LabRequest();
					include_once $this->views['lab_tech'];
					break;
				case "manager":
					include_once $this->views['manager'];
					break;
				default:
					// display an error page
					echo "unknown account type";
					break;


			}
			
		}else{
			$failed_auth = true; // show failed auth message.
			include_once "../SCIMS/views/login.php";
		}
		
	}

	function add_user(){
		$user_data=$this->request->getBody();
		$acc=new Accounts();
		$new_staff_id=$acc->get_new_id($user_data['first_name'], $user_data['account_type']);
		$userdata=array("first_name"=>$user_data['first_name'],
						"last_name"=>$user_data['last_name'],
						"work_position"=>$user_data['account_type'],
						"password"=>md5($user_data['password']),
						"date_of_reg"=>date("Y-m-d"),
						"phone_num"=>$user_data['phone_num'],
						"gender"=>$user_data['gender'],
						"staff_id"=>$new_staff_id);

		$val=$acc->create_account($userdata);
		$response=array("status"=>$val,
						"id"=>$new_staff_id);
		$response=json_encode($response);// response
		echo $response;
	}

	function search_patient(){
		$post=$this->request->getBody();
		$pat= new Patients();
		$patient=$pat->get_patient_by_id($post['patient_id']);
		$res_dat=array();
		if($patient!=null){
			$res_dat['status']=0; // patient found
			$res_dat['result']=$patient;
		}else{
			$res_dat['status']=1;
		}
		
		echo json_encode($res_dat);
	}

	function add_patient(){
		$post=$this->request->getBody();
		$pat= new Patients(); 
		$response = array('pat_id'=>$post['stu_id'],
						  'status'=>$pat->add_patient($post),
						  'date_of_reg'=>$this->date);
		echo json_encode($response);
	}

	function edit_patient(){
		$post=$this->request->getBody();
		$pat= new Patients(); 
		echo json_encode($pat->edit_patient($post));// returns 0 if success
	}

	function prescribe(){
		$post=$this->request->getBody();
		$pre = new Prescriptions();
		 if($pre->prescribe($post)){
		 	echo "success";
		 }
	}

	function delete_patient(){
		$post=$this->request->getBody();
		$pat= new Patients(); 
		echo json_encode($pat->delete_patient($post['patient_id']));// returns 0 if success
	}

	function get_patient_history(){
		$post=$this->request->getBody();
		$pat=new Patients();
		$pat_hist=$pat->get_patient_history($post['pat_id']);
		$patient_history=array('count'=>count($pat_hist),
							   'patient_histories'=>$pat_hist);
		echo json_encode($patient_history);

	}

	function add_patient_history(){
		$post = $this->request->getBody();
		$pat = new Patients();
		$stat=$pat->add_patient_history($post);
		if($stat){
			// remove patient from pending patient
			$pend = new PendingPatients();
			echo $pend->remove_appointment($post['pat_id']);
		}else{
			echo false;
		}

	}
	function add_drug(){
		$post = $this->request->getBody();
		$drugstore = new DrugStore();
		echo json_encode($drugstore->add_drug($post));
	}

	function generate_patient_report(){
		$post = $this->request->getBody();
		$lab_request = new LabRequest();
		$lab_requests = $lab_request->get_request_count_by_pat_id($post['pat_id']);
		$report = array('requests_to_lab'=>$lab_requests);
	}

	function generate_doctor_report(){
		$post = $this->request->getBody();
		$lab_request = new LabRequest();
		$num_of_requests = $lab_request->get_request_count_by_doc_id($post['doctor_id']);
		$patient = new Patients();
		$num_of_diagnosed_patients = $patient->get_patient_count_by_doctor_id($post['doctor_id']);

		$report = array('number_of_lab_requests'=>$num_of_requests,
						'number_of_diagnosed_patients'=>$num_of_diagnosed_patients);
		echo json_encode($report);
	}

	function make_lab_request(){
		$post = $this->request->getBody();
		$lab_request = new LabRequest();
		$status = $lab_request->add_request($post['doc_id'], $post['pat_id'], $post['request']);
		if($status){
			echo '0'; // success
		}else{
			echo '1';
		}
	}

	function set_appointment(){
		$post = $this->request->getBody();
		$pend_pat = new PendingPatients();
		$status =  $pend_pat->set_appointment($post['stu_id']);
		if($status){
			echo '0'; // success
		}else{
			echo '1';
		}
	}

	function submit_lab_result(){
		$post = $this->request->getBody();
		$lab_result = new LabResult();
		$status = $lab_result->add_lab_result($post['staff_id'], $post['pat_id'], $post['result'],$post['request_type']);
		if($status){
			echo '0'; // success
		}else{
			echo '1';
		}
	}
	// returns lab result if the pat_id is in pending_patients table.
	function get_lab_results(){
		$post = $this->request->getBody();
		$pend_pats = new PendingPatients();
		$all_pending_pats = $pend_pats->get_all_appointments();
		$pending_pat = array();
		$i=0;
		foreach($all_pending_pats as $pat){
			$pending_pat[$i]=$pat['stu_id'];
			$i++;
		}
		$lab_result = new LabResult();
		$results = $lab_result->get_lab_result_detail($post['pat_id'], $post['request_type']);
		if(in_array($results['pat_id'], $pending_pat)){
			$filterd_res = str_replace("&#34;","",$results['result']);
			echo json_encode(array("result"=>$filterd_res));
		}else{
			echo '1'; // failed
		}
	}

	function get_lab_results_list(){
		$pend_pats = new PendingPatients();
		$all_pending_pats = $pend_pats->get_all_appointments();
		$pending_pat = array();
		$i=0;
		foreach($all_pending_pats as $pat){
			$pending_pat[$i]=$pat['stu_id'];
			$i++;
		}
		$lab_result = new LabResult();
		$results = $lab_result->get_lab_result();
		$lab_results_list = array();
		foreach($results as $result){
			if(in_array($result['pat_id'], $pending_pat)){
				$lab_result->pat_id=$result['pat_id'];
				$lab_result->lab_tech_id=$result['lab_tech_id'];
				$lab_result->request_type=$result['request_type'];
				array_push($lab_results_list, $lab_result);
			}
		}
		echo json_encode($lab_results_list);
	}

	function request_drug(){
		$post = $this->request->getBody();
		$drug_req = new DrugRequest();
		$stat = $drug_req->request_drug($post['staff_id'], $post['drug_name'], $post['ammount']);
		echo $stat;
	}
}


<?php
include_once "models/Accounts.php";
include_once "models/Patients.php";

class Controller{
	private $session;
	public function __construct($req){
		//$this->session = $_SESSION['id'];
		$this->request = $req;
		$this->views = array("admin"=>"../SCIMS/views/admin.php",
							 "manager"=>"../SCIMS/views/manager.php",
							 "doctor"=>"../SCIMS/views/doctor.php",
							 "lab_tech"=>"../SCIMS/views/lab_tech.php",
							 "dispensary"=>"../SCIMS/views/dispensary.php",
							 "store_man"=>"../SCIMS/views/store_man.php",
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
					$pat = new Patients(); // doctor.php needs Patients class obj.
					include_once $this->views['doctor'];
					break;
				case "registrar":
					$pat = new Patients(); // doctor.php needs Patients class obj.
					include_once $this->views['registrar'];
					break;
				default:
					// display an error page
					echo "unknown account type";


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
		echo json_encode($pat->add_patient($post));// returns 0 if success

	}

}
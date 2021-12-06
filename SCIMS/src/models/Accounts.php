<?php
require_once "../SCIMS/src/helpers/Accounts_data_helper.php";
require_once "../SCIMS/config/constants.php";
require_once "../SCIMS/config/database.php";
/*
	table accounts: staff_id, first_name, last_name, work_position, password, date_of_re, phone_num, gender
*/
class Accounts extends AccountDataHelper{
	public $conn;
	private $tbl_name = "Accounts";

	public function __construct(){
		$db = new Database();
		$this->conn = $db->get_connection();
		if($this->conn==null) die("database server is offline");
	}
    /*
		@param $user_data:- array containing user info submited from the form.
		keys:- field name of the table "staff_accounts".
		
		eg. $user['first_name']

	*/

	function create_account($user){
		// mysql will throw error if $user[''] is used in the statment string.
		$res = extract($user); // extract the array
		//$date_of_reg = "none"; // Todo:- set the current time
		//$staff_id = $this->_get_new_id(); // get new unique id;
		//$pass = md5($password); // encrypt the password

		$stmt = "INSERT INTO $this->tbl_name(staff_id, first_name, last_name, work_position, password, date_of_reg, phone_num, gender)";
		$stmt .= "VALUES ('$staff_id','$first_name', '$last_name','$work_position', '$password', '$date_of_reg', '$phone_num', '$gender')";
		if(mysqli_query($this->conn, $stmt)){
			return Constants::$SUCCESS;
		}else{
			return Constants::$DATABASE_ERROR;
		}
	}

	function delete_account($user_id){
		if($this->tbl_name){
			if($this->_account_exists($user_id)){
				if (mysqli_query($this->conn, "DELETE FROM $this->tbl_name WHERE staff_id='$user_id'")){
					Constants::$SUCCESS;
				}else{
					Constants::$DATABASE_ERROR;
				}
			}else{
				return Constants::$USER_DOESNT_EXIST;
			}
		}
		return false;
	}

	function update_account($user_id, $new_data){
		if($this->tbl_name){
			extract($new_data);
			if($this->_account_exists($user_id)){
				$stmt = "UPDATE $this->tbl_name SET first_name='$first_name', last_name='$last_name', phone_num='$phone_num', gender='$gender' WHERE staff_id='$staff_id'";
				if(mysqli_query($this->conn, $stmt)){
					Constants::$SUCCESS;
				}else{
					Constants::$DATABASE_ERROR;
				}
			}else{
				return Constants::$USER_DOESNT_EXIST;
			}
		}
		return false;
	}

	// return all staff members including admin.
	function get_all_accounts(){
		$query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_name");
		$staffs = array();
		while($row=mysqli_fetch_array($query)){
			array_push($staffs, $row);
		}
		return $staffs;
	}
	
	function auth($user_id, $pass){
		return $this->_check_password($user_id, $pass);
	}

	function account_type($user_id){
		return $this->_account_type($user_id);
	}

	function get_new_id($name,$workpos){
		return $this->_get_new_id($name, $workpos);
	}
}
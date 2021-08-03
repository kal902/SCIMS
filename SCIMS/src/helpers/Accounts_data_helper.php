<?php
require_once "../SCIMS/config/constants.php";
class AccountDataHelper{
	public $conn; // super class must set this variable on initialization.
	private $tbl_name = "accounts";

	protected function _account_exists($id){
		$query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_name WHERE staff_id='$id' ");
		if(mysqli_num_rows($query)>0){
			return true;
		}else{
			return false;
		}
	}
	// return work position
	protected function _account_type($id){
		$query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_name WHERE staff_id='$id'");
		$row = mysqli_fetch_array($query);
		return $row['work_position'];
	}
	// id = first name + random number + @ + work_position i.e baya2222@doctor.
	protected function _get_new_id($name,$work_pos){
		$new_id;
		while(true){
			$rand_int = rand(1000,6000);
			$new_id = "$name".$rand_int."@".$work_pos;
			if($this->_account_exists($new_id)!=true){
				break;
			}
		}
		return $new_id;
	}

	protected function _check_password($id, $pass){
		$query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_name WHERE staff_id='$id'");
		$row = mysqli_fetch_array($query);
		$password = $row['password']; // returns md5 hash
		return $password==md5($pass); // the string $pass should be encrypted for comparition, b/c decription of md5 hash is not possible;
	}

}
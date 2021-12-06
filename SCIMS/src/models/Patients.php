<?php
require_once "../SCIMS/config/constants.php";
require_once "../SCIMS/config/database.php";
require_once "../SCIMS/src/helpers/Patients_data_helper.php";

/*
	table patients: stu_id,first_name, last_name, gender, age, phone_num, departement, date_of_reg
*/

/*
table patients_history: pat_id, staff_id, service, diagnosis, date
*/

class Patients extends PatientDataHelper{
	private $tbl_patients = "patients";
	private $tbl_pat_hist = "patient_history";

	function __construct(){
		$db = new Database();
		$this->conn = $db->get_connection();
		$this->current_date = date("Y-m-d");
		if($this->conn==null) die;
		// todo init database
	}

	function add_patient($patient_data){
		extract($patient_data);
		//$pat_id = $this->_get_new_id($first_name);
		$date_of_reg = $this->current_date; // todo get current date.

		$stmt = "INSERT INTO $this->tbl_patients(stu_id, first_name, last_name, gender, age, phone_num, department, date_of_reg)";
		$stmt .= "VALUES ('$stu_id', '$first_name', '$last_name', '$gender', '$age', '$phone_num','$department', '$date_of_reg')";
		if(mysqli_query($this->conn, $stmt)){
			return Constants::$SUCCESS;
		}else{
			return Constants::$DATABASE_ERROR;
		}
		
	}

	// data to update:- firstname, lastname, department, phonenum, age, gender
	function update_patient($new_data){
		extract($new_data);
		if($this->_patient_exists($patient_id)){
			$stmt = "UPDATE $this->tbl_patients SET stu_id='$stu_id', first_name='$first_name', last_name='$last_name', department='$department',phone_num='$phone_num', age='$age', gender='$gender' WHERE stu_id='$patient_id'";
			if(mysqli_query($this->conn, $stmt)){
				return Constants::$SUCCESS;
			}else{
				return Constants::$DATABASE_ERROR;
			}
		}else{
			return Constants::$USER_DOESNT_EXIST;
		}
	}

	function delete_patient($patient_id){
		if(mysqli_query($this->conn, "DELETE FROM $this->tbl_patients WHERE stu_id='$patient_id'")){
			return Constants::$SUCCESS;
		}else{
			return Constants::$DATABASE_ERROR;
		}
	}

	function get_all_patients(){
		$query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_patients");
		$patients = array();
		if(mysqli_num_rows($query)>0){
			while($row=mysqli_fetch_array($query)){
				array_push($patients, $row);
			}
		}
		
		return $patients;
	}

	function get_patient_by_id($pat_id){
		$query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_patients WHERE stu_id='$pat_id'");
		if(mysqli_num_rows($query)>0){
			return mysqli_fetch_array($query);
		}
		 return array();//return an empty array as the caller expects an array object.
	}

	function get_patient_by_phonenum($phone_num){
		$query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_patients WHERE phone_num='$phone_num'");
		$pat = array();
		while($row=mysqli_fetch_array($query)){
			array_push($pat, $row);
		}	
		return $pat;
	}



/***********************************************************************/
	// fetch a patients history from the "patients_history" table.
	function get_patient_history($patient_id){
		$query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_pat_hist WHERE stu_id='$patient_id'");
		$patient_hist = array();
		if(mysqli_num_rows($query)>0){
			
			while($row=mysqli_fetch_array($query)){
				array_push($patient_hist, $row);
			}}
		return $patient_hist;
	}

	function add_patient_history($patient_history){
		extract($patient_history);
		$stmt = "INSERT INTO $this->tbl_pat_hist(stu_id, staff_id, service, diagnosis, date)";
		$stmt .= " VALUES ('$pat_id','$staff_id', '$service', '$diagnosis', '$this->current_date')";
		if(mysqli_query($this->conn, $stmt)){
			return true;
		}
		return false;
	}

	function get_patient_history_by_staffid($staff_id){
		$query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_pat_hist WHERE $staff_id='$staff_id'");
		$pat_hist = array();
		while($row=mysqli_fetch_array($query)){
			array_push($pat_hist, $row);
		}	
		return $pat_hist;
	}

	function get_patient_count_by_doctor_id($doc_id){
		$query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_pat_hist WHERE staff_id='$doc_id'");
        return mysqli_num_rows($query);
	}
}

?>
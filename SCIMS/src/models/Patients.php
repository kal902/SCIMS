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
	private $tbl_pen_pat = "patient_history";
	private $current_date;

	function __construct(){
		$db = new Database();
		$this->conn = $db->get_connection();
		$this->current_date = date("Y-m-d"); 
		if($this->conn==null) die;
		// todo init database
	}

	public function add_patient($patient_data){
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
	public function update_patient($patient_id, $new_data){
		extract($new_data);
		if($this->_patient_exists($patient_id)){
			$stmt = "UPDATE $this->tbl_patients SET first_name='$first_name', last_name='$last_name', department='$department',phone_num='$phone_num', age='$age', gender='$gender' WHERE stu_id='$patient_id'";
			if(mysqli_query($this->conn, $stmt)){
				return Constants::$SUCCESS;
			}else{
				return Constants::$DATABASE_ERROR;
			}
		}else{
			return Constants::$USER_DOESNT_EXIST;
		}
	}

	public function delete_patient($patient_id){
		if(mysqli_query($this->conn, "DELETE FROM $this->tbl_patients WHERE stu_id='$pat_id'")){
			return Constants::$SUCCESS;
		}else{
			return Constants::$DATABASE_ERROR;
		}
	}

	public function get_all_patients(){
		$query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_patients");
		$patients = array();
		if(mysqli_num_rows($query)>0){
			while($row=mysqli_fetch_array($query)){
				array_push($patients, $row);
			}
		}
		
		return $patients;
	}

	public function get_patient_by_id($pat_id){
		$query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_patients WHERE stu_id='$pat_id'");
		if(mysqli_num_rows($query)>0){
			return mysqli_fetch_array($query);
		}
		 return null;
	}

	public function get_patient_by_phonenum($phone_num){
		$query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_patients WHERE phone_num='$phone_num'");
		$pat = array();
		while($row=mysqli_fetch_array($query)){
			array_push($row);
		}	
		return $pat;
	}

	/**
	 * pending patients
	 */
	public function set_appointment($patient_id,$patient_name){
        $stmt = "INSERT INTO $this->tbl_pen_pat(stu_id, pat_name, date_time)";
        $stmt .= "VALUSE ('$stu_id', '$patient__name', '$this->current_date')";
        if(mysqli_query($this->conn, $stmt)){
            return true;
        }
        return false;
    }

    public function remove_appointment($patient_id){
        if(mysqli_query($this->conn, "DELETE FROM $this->tbl_pen_pat WHERE stu_id='$patient_id'")){
            return true;
        }
        return false;
    }

    public function get_appointments(){
        $stmt = "SELECT * FROM $this->tbl_pen_pat";
        $query = mysqli_query($this->conn, $stmt);
        if(mysqli_num_rows($query)>0){
            $appointments = array();
            while($row=mysqli_fetch_array($query)){
                array_push($appointments, $row);
            }
            return $appointments;
        }
        return null;
    }
/***********************************************************************/
	// fetch a patients history from the "patients_history" table.
	public function get_patient_history($patient_id){
		$query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_pat_hist WHERE stu_id='$patient_id'");
		if(mysqli_num_rows($query)>0){
			$patient_hist = array();
			$count = 0;
			while($row=mysqli_fetch_array($query)){
				$patient_hist[$count]=$row;
				$count = $count+1;
			}
			return $patient_hist;
		}
		return null; // no patient history
	}

	public function add_patient_history($patient_history){
		$stmt = "INSERT INTO $this->tbl_pat_hist(stu_id, staff_id, service, diagnosis, date)";
		$stmt .= " VALUES ('$pat_id','$staff_id', '$service', '$diagnosis', '$this->current_date')";
		if(mysqli_query($this->conn, $stmt)){
			return true;
		}
		return false;
	}

	public function get_patient_history_by_patid($pat_id){
		$query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_pat_hist WHERE $pat_id='$pat_id'");
		$pat_hist = array();
		while($row=mysqli_fetch_array($query)){
			array_push($row);
		}	
		return $pat_hist;
	}

}

?>
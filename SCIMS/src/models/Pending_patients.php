<?php
require_once "../SCIMS/config/constants.php";
require_once "../SCIMS/config/database.php";
/* table pending_patients:- stu_id(text), pat_name(text), reg_time(text) */
class PendingPatients{
    private $tbl_name = "pending_patients";
    private $conn;

    function __construct(){
        $db = new Database();
        $this->conn = $db->get_connection();
        $this->current_date = date("Y-m-d");
    }

    function set_appointment($patient_id){
        $stmt = "INSERT INTO $this->tbl_name(stu_id, date)";
        $stmt .= "VALUES ('$patient_id', '$this->current_date')";
        if(mysqli_query($this->conn, $stmt)){
            return true;
        }
        return false;
    }

    function remove_appointment($patient_id){
        if(mysqli_query($this->conn, "DELETE FROM $this->tbl_name WHERE stu_id='$patient_id'")){
            return true;
        }
        return false;
    }

    // get all data from "pending_patients" table
    function get_all_appointments(){
        $stmt = "SELECT * FROM $this->tbl_name";
        $query = mysqli_query($this->conn, $stmt);
        $appointments = array();
        if(mysqli_num_rows($query)>0){
            
            while($row=mysqli_fetch_array($query)){
                array_push($appointments, $row);
            }
        }
        return $appointments;
    }
}

?>
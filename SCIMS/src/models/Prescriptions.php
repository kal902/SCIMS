<?php
require_once "../SCIMS/config/constants.php";
require_once "../SCIMS/config/database.php";
/* table prescriptions:-  pat_id(text), staff_id(text), medicine(text), strength(text) */

class Prescriptions{
    private $tbl_name = "prescriptions";
    private $conn;
    
    function __construct(){
        $db = new Database();
        $this->conn = $db->get_connection();
        $this->current_date = date("Y-m-d");
    }

    function prescribe($prescription_data){
        extract($prescription_data);
        $stmt = "INSERT INTO $this->tbl_name(pat_id, staff_id, medicine, strength, date) ";
        $stmt .= "VALUES ('$pat_id', '$staff_id', '$medicine', '$strength', '$this->current_date')";
        if(mysqli_query($this->conn, $stmt)){
            return true;
        }
        return false;
    }

    function remove_prescription($pat_id){
        if(mysqli_query($this->conn, "DELETE FROM $this->tbl_name WHERE pat_id='$pat_id'")){
            return true;
        }
        return false;
    }

    function get_all_prescriptions(){
        $query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_name");
        $prescriptions = array();
        if(mysqli_num_rows($query)>0){
            
            while($row=mysqli_fetch_array($query)){
                array_push($prescriptions, $row);
            }
            
        }
        return $prescriptions;
    }
}
?>
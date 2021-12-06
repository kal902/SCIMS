<?php
require_once "../SCIMS/config/constants.php";
require_once "../SCIMS/config/database.php";
class DrugRequest{
	private $conn;
    private $tbl_name="drug_request";

	function __construct(){
        $db = new Database();
        $this->conn = $db->get_connection();
        $this->req_time=date("Y-m-d");
    }
    
    function request_drug($staff_id, $drug_name, $ammount){
    	$stmt = "INSERT INTO $this->tbl_name(staff_id, drug_name, ammount, req_time) ";
        $stmt .= "VALUES ('$staff_id', '$drug_name', '$ammount', '$this->req_time')";
        if(mysqli_query($this->conn, $stmt)){
            return true;
        }
        return false;
    }

    function remove_request($drug_name){
    	if(mysqli_query($this->conn, "DELETE FROM $this->tbl_name WHERE drug_name='$drug_name'")){
            return true;
        }
        return false;
    }
}
?> 

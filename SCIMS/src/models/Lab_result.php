<?php
require_once "../SCIMS/config/constants.php";
require_once "../SCIMS/config/database.php";

// lab_result table:- lab_tech_id, pat_id, result(text(json)), date(date)
class LabResult{
    private $tbl_name = "lab_result";
    private $conn;
    
    public function __construct(){
        $db = new Database();
        $this->conn = $db->get_connection();
        $this->date=date("Y-m-d");
    }

    function add_lab_result($lab_tech_id, $pat_id, $result, $request_type){
        $stmt = "INSERT INTO $this->tbl_name(lab_tech_id, pat_id, result, request_type, date)";
        $stmt .= "VALUES ('$lab_tech_id', '$pat_id', '$result', '$request_type','$this->date')";
        if(mysqli_query($this->conn, $stmt)){
            return true;
        }
        return false;
    }
    // get todays lab result
    function get_lab_result(){
        $query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_name WHERE date='$this->date'");
        $results = array();
        if(mysqli_num_rows($query)>0){
            while($row=mysqli_fetch_array($query)){
                array_push($results, $row);
            }
        }
        return $results;
    }
   
    function get_lab_result_detail($pat_id, $request){
        $query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_name WHERE pat_id='$pat_id' AND request_type='$request' AND date='$this->date'");
        if(mysqli_num_rows($query)>0){
           return mysqli_fetch_array($query);
        }
        return array();
    }
    function get_lab_result_by_pat_id($pat_id){
        $query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_name WHERE pat_id='$pat_id'");
        $results = array();
        if(mysqli_num_rows($query)>0){
            while($row=mysqli_fetch_array($query)){
                array_push($results, $row);
            }
        }
        return $results;
    }




}
?>
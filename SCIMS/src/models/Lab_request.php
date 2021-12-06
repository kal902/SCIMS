<?php
require_once "../SCIMS/config/constants.php";
require_once "../SCIMS/config/database.php";


class LabRequest{
    private $tbl_name = "lab_requests";
    private $conn;
    
    public function __construct(){
        $db = new Database();
        $this->conn = $db->get_connection();
        $this->date=date("Y-m-d");
    }

    function add_request($doc_id, $pat_id, $request){
        if(!$this->is_request_duplicate($pat_id, $request)){
            $stmt = "INSERT INTO $this->tbl_name(doctor_id, pat_id, request, date, status)";
            $stmt .= "VALUES ('$doc_id', '$pat_id', '$request', '$this->date', 'pending')";
            if(mysqli_query($this->conn, $stmt)){
                return true;
            }
            return false;
        }
        return false;
    }

    function set_request_completed($pat_id){
        // where pat_id = patid, date=today
        $stmt = "UPDATE $this->tbl_name SET status='completed' WHERE pat_id='$pat_id', date='$this->date'";
        if(mysqli_query($this->conn, $stmt)){
            return true;
        }
        return false;
    }

    function get_all_requests(){
        $query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_name");
        $requests = array();
        if(mysqli_num_rows($query)>0){
            while($row=mysqli_fetch_array($query)){
                array_push($requests, $row);
            }
        }
        return $requests;
    }

    
    function get_pending_requests(){
        $query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_name WHERE status='pending'");
        $requests = array();
        if(mysqli_num_rows($query)>0){
            while($row=mysqli_fetch_array($query)){
                array_push($requests, $row);
            }
        }
        return $requests;
    }

    function get_request_count_by_doc_id($doc_id){
        $query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_name WHERE doctor_id='$doc_id'");
        return mysqli_num_rows($query);
    }

    function get_all_requests_by_doc_id($doc_id){
        $query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_name WHERE doctor_id='$doc_id'");
        $requests = array();
        if(mysqli_num_rows($query)>0){
            while($row=mysqli_fetch_array($query)){
                array_push($requests, $row);
            }
        }
        return $requests;
    }

    function get_request_count_by_pat_id($pat_id){
        $query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_name WHERE pat_id='$pat_id'");
        return mysqli_num_rows($query);
    }

    function is_request_duplicate($pat_id, $request){
         $query = mysqli_query($this->conn, "SELECT * FROM $this->tbl_name WHERE pat_id='$pat_id' AND request='$request' AND status='pending'");
         if(mysqli_num_rows($query)>1){
            return true;
         }
         return false;
    }
    
}
?>
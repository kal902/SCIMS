<?php
include_once "../SCIMS/src/route/Router.php";
include_once "../SCIMS/src/route/Request.php";
include_once "../SCIMS/src/controller.php";

$router = new Router(new Request);

$router->get("/SCIMS", function($request){
	$con = new Controller($request);
	$con->view_login();
});

$router->post("/SCIMS/auth", function($request){
	$con = new Controller($request);
	$con->login();
});

$router->post("/SCIMS/add_user", function($request){
	$con = new Controller($request);
	$con->add_user();
});

$router->post("/SCIMS/search_patient", function($request){
	$con = new Controller($request);
	$con->search_patient();
});

$router->post("/SCIMS/add_patient", function($request){
	$con = new Controller($request);
	$con->add_patient();
});

$router->post("/SCIMS/prescribe", function($request){
	$con = new Controller($request);
	$con->prescribe();
});

$router->post("/SCIMS/patient_history", function($request){
	$con = new Controller($request);
	$con->get_patient_history();
});

$router->post("/SCIMS/edit_patient", function($request){
	$con = new Controller($request);
	$con->edit_patient();
});

$router->post("/SCIMS/delete_patient", function($request){
	$con = new Controller($request);
	$con->delete_patient();
});

$router->post("/SCIMS/add_drug", function($request){
	$con = new Controller($request);
	$con->add_drug();
});

$router->post("/SCIMS/request_drug", function($request){
	$con = new Controller($request);
	$con->request_drug();
});

$router->post("/SCIMS/generate_doctor_report", function($request){
	$con = new Controller($request);
	$con->generate_doctor_report();
});

$router->post("/SCIMS/generate_patient_report", function($request){
	$con = new Controller($request);
	$con->generate_patient_report();
});

$router->post("/SCIMS/make_lab_request", function($request){
	$con = new Controller($request);
	$con->make_lab_request();
});

$router->post("/SCIMS/set_appointment", function($request){
	$con = new Controller($request);
	$con->set_appointment();
});

$router->post("/SCIMS/submit_lab_result", function($request){
	$con = new Controller($request);
	$con->submit_lab_result();
});

$router->post("/SCIMS/get_lab_results", function($request){
	$con = new Controller($request);
	$con->get_lab_results();
});

$router->post("/SCIMS/get_lab_results_list", function($request){
	$con = new Controller($request);
	$con->get_lab_results_list();
});

$router->post("/SCIMS/add_patient_history", function($request){
	$con = new Controller($request);
	$con->add_patient_history();
});
$router->resolve();

?>

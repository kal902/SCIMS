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

$router->route();

?>
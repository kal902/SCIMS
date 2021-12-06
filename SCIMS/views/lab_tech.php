<html>
<title>HUSCIMS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="../SCIMS/lib/w3.css">
<link rel="stylesheet" href="../SCIMS/lib/w3-colors-flat.css">
<body>
	<!--sidebar-->

	<div class="w3-sidebar w3-bar-block w3-card w3-flat-asbestos" style="width:20%">
	    <div style="height:20%"></div>
	    <br><br>
	    
  		<a  class="w3-bar-item w3-button" onclick="loadView('lab_requests_view')"><img src="../SCIMS/res/laboratory.png" alt="lab requests" width="30" height="30">Lab Requests</a>
	  
	</div>
	<!--sidebar end -->
	<div class="w3-flat-asbestos w3-container w3-card" style="margin-left:20%; height:20%">
		<br><br>
		<div class="w3-flat-belize-holey w3-container w3-center">
			<h3 class="w3-monospace w3-wide">Hawasa University Student Clinic Information<br>Managment System</h3>
			
		</div>
	</div>

	<div class="w3-container" style="margin-left:21%;margin-top:7px;margin-right:7px">
		<div id="patient_info_view" class="w3-container view">
  			<h2>Patient info</h2>
  			
  			<table id="patient_info_table" class="w3-table w3-striped w3-border">
				<thead>
					<tr class="w3-grey">
					  <th>Student id</th>
					  <th>First Name</th>
					  <th>Last Name</th>
					  <th>Gender</th>
					  <th>Age</th>
					  <th>Phone no</th>
					  <th>Department</th>
					  <th>Date of reg</th>
					</tr>
				</thead>
				
			</table>
		</div>
	</div>
	<?php echo "<input id='sessionid' type='hidden' value='",$_SESSION['id'], "'>" ?>
	<?php include "../SCIMS/views/view_helpers/lab_requests.php"?>
	<?php include "../SCIMS/views/view_helpers/lab_result_forms.php"?>
<script type="text/javascript" src="../SCIMS/lib/jquery.min.js"></script>
<script>
//window.history.pushState("", "", "Admin");
window.history.replaceState("", "", "Lab_tech");
loadView("lab_requests_view");

function loadView(id) {
    var i;
    var x = document.getElementsByClassName("view");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    document.getElementById(id).style.display = "block";  
}

function load_patient_info_view(pat_id){

}

function submit_lab_result(lab_result_type){
	var input_fields = document.getElementsByClassName(lab_result_type);
	var session_id = $('#sessionid').val(); // staff id
	var pat_id = document.getElementById('session_pat_id').value;
	var data = {};
	for (i = 0; i < input_fields.length; i++) {
        data[input_fields[i].name] =  input_fields[i].value;
    }
    var result_json = JSON.stringify(data);
    $.post('/SCIMS/submit_lab_result',

          			{pat_id:pat_id,
          			 staff_id:session_id,
          			 result:result_json,
          			 request_type:lab_result_type},

          			function(data){
          				if(data=='0'){
          					alert('lab result submitted');
          				}else{
          					alert('lab result submittion failed!');
          				}
              			
           			});
}

function load_lab_result_submit_view(view_and_pat_id){
	var arg = JSON.parse(view_and_pat_id);
	document.getElementById('session_pat_id').value=arg.pat_id;  // for the lab result submittion
	loadView(arg.form_view);
}

</script>
</body>
</html>
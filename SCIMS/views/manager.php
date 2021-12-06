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
	    
  		<a  class="w3-bar-item w3-button" onclick="loadView('view_staff')"><img src="../SCIMS/res/doctor.png" alt="lab requests" width="30" height="30">Staffs</a>
  		<a  class="w3-bar-item w3-button" onclick="loadView('generate_report_view')"><img src="../SCIMS/res/prescription.png" alt="lab requests" width="30" height="30">Generate Report</a>
	  
	</div>
	<!--sidebar end -->
	<div class="w3-flat-asbestos w3-container w3-card" style="margin-left:20%; height:20%">
		<br><br>
		<div class="w3-flat-belize-holey w3-container w3-center">
			<h3 class="w3-monospace w3-wide">Hawasa University Student Clinic Information<br>Managment System</h3>
			
		</div>
	</div>

	<div class="w3-container" style="margin-left:20%">
		<div id="generate_report_view" class="w3-container view">
  			<h2>Generate Report</h2>
  			<div class="w3-row-padding">
  				  <div class="w3-third">
				    <input class="w3-input w3-border" name="doctor_id" id="doctor_id" type="text" placeholder="doctor id">
				  </div>
				  <div class="w3-third">
				    <button class="w3-btn w3-green" onclick="load_doctor_report()" value="send" name="send" id="send">doctor report</button>
				  </div>
			</div>
			<br>
			<div class="w3-row-padding">
				  <div class="w3-third">
				    <input class="w3-input w3-border" name="patient_id" id="patient_id" type="text" placeholder="patient id">
				  </div>
				  <div class="w3-third">
				    <button class="w3-btn w3-green" onclick="load_patient_report()" value="send" name="send" id="send">patient report</button>
				  </div>
			</div>
		</div>
	</div>

	<div class="w3-container" style="margin-left:20%">
		<div id="report_view" class="w3-container view">
  			<h2 id="report_view_header">Report</h2>
  			<table id="report_view_table" class="w3-table w3-striped w3-border">
				
				
			</table>
		</div>
	</div>


	
	<?php include "../SCIMS/views/view_helpers/staffs.php"?>
<script type="text/javascript" src="../SCIMS/lib/jquery.min.js"></script>
<script>
//window.history.pushState("", "", "Admin");
window.history.replaceState("", "", "Manager");
loadView("view_staff");

function loadView(id) {
    var i;
    var x = document.getElementsByClassName("view");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    document.getElementById(id).style.display = "block";  
}

function load_doctor_report(){
	var doc_id = document.getElementById('doctor_id').value;
	$.post('/SCIMS/generate_doctor_report',

          			{doctor_id:doc_id},

          			function(data){
          				var tbl = document.getElementById('report_view_table');
          				document.getElementById('report_view_header').innerHTML="Doctor Report";
          				tbl.innerHTML="<thead>\
										 <tr class='w3-grey'>\
											<th>       </th>\
											<th>       </th>\
										 </tr>\
			    					  </thead>";
			    	 	var resp = JSON.parse(data);
			    	 	tbl.innerHTML+='<tr><td>No Lab Requests: 	'+resp.number_of_lab_requests+'</td></tr>'+'<tr><td>No Diagnosed Patients: '+resp.number_of_diagnosed_patients+'</td></tr>';
			    	 	loadView('report_view');
           			});
}

function load_patient_report(){
	var pat_id = document.getElementById('patient_id').value;
	$.post('/SCIMS/generate_patient_report',

          			{pat_id:pat_id},

          			function(data){
          				var resp = JSON.parse(data);
          				document.getElementById('report_view_header').innerHTML="Patient Report";
          				tbl.innerHTML="<thead>\
										 <tr class='w3-grey'>\
											<th>       </th>\
											<th>       </th>\
										 </tr>\
			    					  </thead>";
			    	 	var resp = JSON.parse(data);
			    	 	tbl.innerHTML+='<tr><td>No Lab Requests: 	'+resp.req_to_lab+'</td></tr>';
			    	 	loadView('report_view');
           			});
}

</script>
</body>
</html>
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
	    <a  class="w3-bar-item w3-button" onclick="loadView('doc_info')"><img src="../SCIMS/res/doctor.png" alt="doctor" width="30" height="30"> Doctor Info</a>
  		<a  class="w3-bar-item w3-button" onclick="loadView('patients_view')"><img src="../SCIMS/res/patient.png" alt="doctor" width="30" height="30"> Patients</a>
  	
  		<a  class="w3-bar-item w3-button" onclick="loadView('pending_patients_view')"><img src="../SCIMS/res/pending.png" alt="doctor" width="30" height="30"> Pending Patients</a>

  		<a  class="w3-bar-item w3-button" onclick="show_sidebar_dropdown('prescription_dropdown')"><img src="../SCIMS/res/prescription.png" alt="doctor" width="30" height="30"> Prescription<i class="fa fa-caret-down"></i></a>
  		<div id="prescription_dropdown" class="w3-hide" style="margin-left: 10px">
		    <a onclick="loadView('prescribe_view')" class="w3-bar-item w3-button">Prescribe</a>
		    <a onclick="loadView('prescription_hist_view')" class="w3-bar-item w3-button">Prescriptions History</a>
  		</div>

  		<a  class="w3-bar-item w3-button" onclick="show_sidebar_dropdown('laboratory_dropdown')"><img src="../SCIMS/res/laboratory.png" alt="doctor" width="30" height="30"> Laboratory<i class="fa fa-caret-down"></i></a>
  		<div id="laboratory_dropdown" class="w3-hide" style="margin-left: 10px">
		    <a onclick="loadView('make_lab_req_view')" class="w3-bar-item w3-button">Make Lab Request</a>
		    <a onclick="loadView('lab_requests_view')" class="w3-bar-item w3-button">Lab Requests History</a>
		    <a onclick="get_lab_results_list()" class="w3-bar-item w3-button">Lab Results</a>
  		</div>

	  
	</div>
	<!--sidebar end -->
	<div class="w3-flat-asbestos w3-container w3-card" style="margin-left:20%; height:20%">
		<br><br>
		<div class="w3-flat-belize-holey w3-container w3-center">
			<h3 class="w3-monospace w3-wide">Hawasa University Student Clinic Information<br>Managment System</h3>
			
		</div>
	</div>


	<div class="w3-container" style="margin-left:21%">
		<div id="doc_info" class="w3-container view">
  			<h2>doctor info</h2>
  			
		</div>
	</div>
	<!--Prescription views -->
	<div class="w3-container" style="margin-left:21%">
		<div id="prescribe_view" class="w3-container view">
  			<h2>Prescribe</h2>
  			<form action="" id="prescribe_form">
  				<div class="w3-row-padding">
  					<div class="w3-third">
				    	<input class="w3-input w3-border" name="staff_id" id="staff_id" type="text" placeholder="staff id">
				  	</div>
				  	<div class="w3-third">
				    	<input class="w3-input w3-border" name="pat_id" id="pat_id" type="text" placeholder="patient id">
				    </div>
  				</div>
  				<br><br>
  				<div class="w3-row-padding">
  					<div class="w3-third">
				    	<input class="w3-input w3-border" name="medicine" id="medicine" type="text" placeholder="medicine">
				  	</div>
				  	<div class="w3-third">
				    	<input class="w3-input w3-border" name="strength" id="strength" type="text" placeholder="strength">
				  	</div>
  				</div>
  				<br><br>
  				<div class="w3-row-padding">
				  <div class="w3-third">
				    <button class="w3-btn w3-green" type="submit" value="send" name="send">Prescribe</button>
				  </div>
				</div>
  			</form>
		</div>
	</div>
	<!--Prescription views End-->

	<!--patients history view  -->
	<div class="w3-container" style="margin-left:21%">
		<div id="patients_hist_view" class="w3-container view">
  			<h2>Medical History of Patient</h2><p id="pat_hist_name"></p>
  			<table id="patient_hist_table" class="w3-table w3-striped w3-border">
				<thead>
					<tr class="w3-grey">
					  <th>Doctor id</th>
					  <th>Service</th>
					  <th>Diagnosis</th>
					  <th>Date of diagnosis</th>
					</tr>
					
				</thead>

				<!-- table data will be added using javascript -->
				
			</table>
		</div>
	</div>
	<!--patients history view end -->

	<!-- pending patients view  -->
	<div class="w3-container" style="margin-left:21%">
		<div id="pending_patients_view" class="w3-container view">
  			<h2>Pending Patients</h2>
  			<table id="pending_patients_table" class="w3-table w3-striped w3-border">
				<thead>
					<tr class="w3-grey">
					  <th>Patient id</th>
					  <th>Time of registration</th>
					  <th>	</th>
					</tr>
			    </thead>
				<?php
				$pend_pats = $pending_patients->get_all_appointments();
				foreach($pend_pats as $pend_pat){  ?>
					<tr>
					  <td><?php echo $pend_pat['stu_id'];?></td>
					  <td><?php echo $pend_pat['date'];?></td>
					  <td><?php echo "<a href='#' onclick=submit_patient_history_view('",$pend_pat['stu_id'], "')>", 'submit hist</a>'?></td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>

	<div class="w3-container" style="margin-left:21%">
		<div id="submit_patient_history_view" class="w3-container view">
  			<h2>Submit Patient History</h2>
  			<br><br>

  				<div class="w3-row-padding">

				  <div class="w3-third">
				    <input class="w3-input w3-border" id='pat_id_hist' name="pat_id_hist" type="text" placeholder="service">
				  </div>

				  <div class="w3-third">
				    <?php echo "<input class='w3-input w3-border' id='staff_id_hist' type='text' value='",$_SESSION['id'], "'>" ?>
				  </div>


				</div>

				<br>
	  			<div class="w3-row-padding">

				  <div class="w3-third">
				    <input class="w3-input w3-border" id='service' name="service" type="text" placeholder="service">
				  </div>

				  <div class="w3-third">
				    <input class="w3-input w3-border" id='diagnosis' name="diagnosis" type="text" placeholder="diagnosis">
				  </div>

				  <br>

				</div>

				<br>
				<div class="w3-row-padding">
				  <div class="w3-third">
				    <button class="w3-btn w3-green" onclick="submit_patient_history()" value="send" name="send">submit result</button>
				  </div>
				</div>
		</div>
	</div>
	<!-- pending patients view end -->

	<!--Laboratory views-->
	<div class="w3-container" style="margin-left:21%">
		<div id="lab_req_hist_view" class="w3-container view">
  			<h2>Laboratory Requests History</h2>
  			
		</div>
	</div>

	<div class="w3-container" style="margin-left:21%">
		<div id="lab_result_view" class="w3-container view">
  			<h2>Laboratory Results</h2>
  			<br>
  			<table id="lab_result_list_table" class="w3-table w3-striped w3-border">
				<thead>
					<tr class="w3-grey">
					  <th>Patient Id</th>
					  <th>Lab Tech Id</th>
					  <th>Request Type</th>
					</tr>
			    </thead>
				
			</table>
		</div>
	</div>

	<div class="w3-container" style="margin-left:21%">
		<div id="lab_result_detail_view" class="w3-container view">
  			<h2>Laboratory Result Detail</h2>
  			<br>
  			<table id="lab_request_detail_table" class="w3-table w3-striped w3-border">
				
				
			</table>
		</div>
	</div>


	<div class="w3-container" style="margin-left:21%">
		<div id="make_lab_req_view" class="w3-container view">
  			<h2>Make Request To The Laboratory</h2>
  			<form action="" id="lab_request_form">
  				<?php echo "<input id='sessionid' type='hidden' value='",$_SESSION['id'], "'>" ?>
				<br><br>

	  			<div class="w3-row-padding">

				  <div class="w3-third">
				    <input class="w3-input w3-border" name="pat_id_lab" id="pat_id_lab" type="text" placeholder="patient id">
				  </div>

				</div>

				<br>

				<div class="w3-row-padding">
				  <div class="w3-third">
				    <select class="w3-select" type ="text" id="request" name="request">
					  <option value="" disabled selected>Choose Test Type</option>
					  <option type="text" value="bemotology">Bemotology</option>
					  <option type="text" value="stool_examination">Stool Examination</option>
					  <option type="text" value="special_test">Special Test</option>
					  <option type="text" value="urinalysis">Urinalysis</option>
					  <option type="text" value="microscopy">Microscopy</option>
					  <option type="text" value="chemistry">Chemistry</option>
					  
					</select>
				  </div>
				</div>

				<br>

				<div class="w3-row-padding">
				  <div class="w3-third">
				    <button class="w3-btn w3-green" type="submit" value="send" name="send">submit request</button>
				  </div>
				</div>

			</form>
		</div>
	</div>
	<!--Laboratory views End-->

	<?php include "../SCIMS/views/view_helpers/patients_view.php"?>
	<?php include "../SCIMS/views/view_helpers/lab_requests.php"?>
	<?php include "../SCIMS/views/view_helpers/prescriptions_view.php"?>

<script type="text/javascript" src="../SCIMS/lib/jquery.min.js"></script>
<script>
//window.history.pushState("", "", "Admin");
window.history.replaceState("", "", "Doctor");
loadView("doc_info");

function loadView(id) {
    var i;
    var x = document.getElementsByClassName("view");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    document.getElementById(id).style.display = "block";  
}
// <a href='#' onclick='get_pat_hist('"+res.result['stu_id']+"')>"+res.result['']+"</a>"
// display returned search values
function display_search_result(data){
	const res = JSON.parse(data);
	if(res.status!=1){
		document.getElementById('search_results_table').innerHTML+='<td>'+res.result['stu_id']+'</td><td>'+res.result['first_name']+'</td><td>'+res.result['last_name']+'</td><td>'+res.result['gender']+'</td><td>'+res.result['age']+'</td><td>'+res.result['phone_num']+'</td><td>'+res.result['department']+'</td><td>'+res.result['date_of_reg']+'</td>';
		loadView('search_result');
		//alert(first_name);
	}
}

/*
 * ajax functions for handling form submittion
 */

 //search_form
$(function() {
        $("#search_form").bind('submit',function() {
          var patient_id = $('#pat_query').val();
          
          
          	$.post('/SCIMS/search_patient',

          			{patient_id:patient_id},

          			function(data){
          				display_search_result(data)
              			
           			});
          
           
           return false;
        });
});
// lab request form
$(function() {
        $("#lab_request_form").bind('submit',function() {
          var patient_id = $('#pat_id_lab').val();
          var request = $('#request').val();
          var session_id = $('#sessionid').val();
          	$.post('/SCIMS/make_lab_request',

          			{pat_id:patient_id,
          				request:request,
          				doc_id:session_id},

          			function(data){

              			if(data=='0'){
              				document.getElementById('lab_requests_table').innerHTML+='<td>'+session_id+'</td>'+'<td>'+patient_id+'</td>'+'<td>'+request+'</td>';
              				alert('request successfull');
              			}
           			});
          
           
           return false;
        });
});
// prescribe form
$(function() {
        $("#prescribe_form").bind('submit',function() {
          var pat_id = $('#pat_id').val();
          var staff_id = $('#staff_id').val();
          var medicine = $('#medicine').val();
          var strength = $('#strength').val();
          
          	$.post('/SCIMS/prescribe',

          			{pat_id:pat_id,
          			 staff_id:staff_id,
          			 medicine:medicine,
          			 strength:strength},

          			function(data){
          				if(data=="success"){
          					document.getElementById('prescriptions_hist_table').innerHTML+='<td>'+pat_id+'</td>'+'<td>'+staff_id+'</td>'+'<td>'+medicine+'</td>'+'<td>'+strength+'</td>';
          				}
              			
           			});
          
           
           return false;
        });
});

// get patient history, build the html and load the view.
function get_patient_hist(pat_id){
	$(function(){
		$.post('/SCIMS/patient_history',
				{pat_id:pat_id},
				function(data){
					const response = JSON.parse(data);
					// refresh the table, create the table headers(field names).
					document.getElementById('patient_hist_table').innerHTML="<thead><tr class='w3-grey'>\
					  																	<th>Doctor id</th>\
					  																	<th>Service</th>\
					  																	<th>Diagnosis</th>\
					  																	<th>Date of diagnosis</th>\
																					</tr>\
																			</thead>";
					if(response.count>0){

						for(i=0;i<response.count;i++){
							document.getElementById('patient_hist_table').innerHTML+='<tr><td>'+response.patient_histories[i]['staff_id']+'</td>'+'<td>'+response.patient_histories[i]['service']+'</td>'+'<td>'+response.patient_histories[i]['diagnosis']+'</td>'+'<td>'+response.patient_histories[i]['date']+'</td></tr>';

						}
						
						loadView('patients_hist_view');
					}else{
						document.getElementById('patient_hist_table').innerHTML+='<p>no history found</p>';
						loadView('patients_hist_view');
					}
				});
	});
}
// fetch new lab results and construct the table.
function load_lab_results(pat_id,request_type){
	$.post('/SCIMS/get_lab_results',

          			{pat_id:pat_id,
          			 request_type:request_type},

          			function(data){
          				if(data!='1'){
							var json_results = JSON.parse(data);
							var detail_table = document.getElementById('lab_request_detail_table');
							detail_table.innerHTML = "<thead>\
														<tr class='w3-grey'>\
															<th>Test Name</th>\
															<th>Result</th>\
														</tr>\
			    									 </thead>";

							for(var key in json_results){
								detail_table.innerHTML+= '<tr><td>'+key+'		</td><td>'+json_results[key]+'</td></tr>';
							}
							loadView('lab_result_detail_view');
						}
          				
           			});
}

function get_lab_results_list(){
	$.post('/SCIMS/get_lab_results_list',

          			{},

          			function(data){
          				var json_results = JSON.parse(data);
          				for(x in json_results){
          					var result = json_results[x];
          					var lab_tech_id = result.lab_tech_id;
          					var pat_id = result.pat_id;
          					var request_type = result.request_type;

          					var tbl=document.getElementById('lab_result_list_table');
			    			tbl.innerHTML=innerHTML="<thead>\
														<tr class='w3-grey'>\
															<th>Patient Id</th>\
															<th>Lab Tech Id</th>\
															<th>Request Type</th>\
															<th>	</th>\
														</tr>\
			    									</thead>";
			    			tbl.innerHTML+='<tr><td>'+pat_id+'</td><td>'+lab_tech_id+'</td><td>'+request_type+"</td><td><a href='#' onclick=load_lab_results(\'"+pat_id+"'\,'"+request_type+"')>View Result</a></td></tr>";
			    			loadView('lab_result_view');												
          				}
              			
           			});
}
function submit_patient_history_view(pat_id){
	document.getElementById('pat_id_hist').value = pat_id;
	loadView('submit_patient_history_view');
}

function submit_patient_history(){
	var pat_id=document.getElementById('pat_id_hist').value;
	var staff_id = document.getElementById('staff_id_hist').value;
	var service = document.getElementById('service').value;
	var diagnosis = document.getElementById('diagnosis').value;
	$.post('/SCIMS/add_patient_history',

          			{pat_id:pat_id,
          			 staff_id:staff_id,
          			 service:service,
          			 diagnosis:diagnosis},

          			function(data){
          				if(data=="1"){
          					alert('patient history submitted successfully.');
          				}
              			
           			});
}

function show_sidebar_dropdown(dropdown) {
  var x = document.getElementById(dropdown);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-green";
  } else { 
    x.className = x.className.replace(" w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-green", "");
  }
}
</script>
</body>
</html>
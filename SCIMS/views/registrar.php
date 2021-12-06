<html>
<title>HUSCIMS</title>
<meta name="viewport">
<link rel="stylesheet" href="../SCIMS/lib/w3.css">
<link rel="stylesheet" href="../SCIMS/lib/w3-colors-flat.css">
<body>

	<!--sidebar-->
	<div class="w3-sidebar w3-bar-block w3-card w3-flat-asbestos" style="width:20%">
	    <div style="height:20%"></div>
	    <br><br>
	    <a  class="w3-bar-item w3-button" onclick="loadView('add_patient')">Register Patient</a>
  		<a  class="w3-bar-item w3-button" onclick="loadView('patients_view')">View Patients</a>
	</div>
	<!--sidebar end -->

	<div class="w3-flat-asbestos w3-container w3-card" style="margin-left:20%; height:20%">
		<br><br>
		<div class="w3-flat-belize-holey w3-container w3-center">
			<h3 class="w3-monospace w3-wide">Hawasa University Student Clinic Information<br>Managment System</h3>
			
		</div>
	</div>

	<div class="w3-container" style="margin-left:21%">
		<div id="add_patient" class="w3-container view">
  			
			<form action="" id="add_patient_form">
				<br>
				<div class="w3-container w3-grey">
  					<h2>Add Patient</h2>
				</div>

				<br><br>

	  			<div class="w3-row-padding">

	  			  <div class="w3-third">
				    <input class="w3-input w3-border" name="stu_id" id="stu_id" type="text" placeholder="Student_id">
				  </div>

				  <div class="w3-third">
				    <input class="w3-input w3-border" name="first_name" id="first_name" type="text" placeholder="first name">
				  </div>

				  <div class="w3-third">
				    <input class="w3-input w3-border" name="last_name" id="last_name" type="text" placeholder="last name">
				  </div>

				</div>

				<br>

				<div class="w3-row-padding">
				  <div class="w3-third">
				    <input class="w3-input w3-border" name="phone_num" id="phone_num" type="text" placeholder="phone no">
				  </div>

				  <div class="w3-third">
				    <input class="w3-input w3-border" name="age" id="age" type="text" placeholder="Age">
				  </div>

				  <div class="w3-third">
				    <input class="w3-input w3-border" name="dep" id="dep" type="text" placeholder="Department">
				  </div>
				  
				</div>

				<br>

				<div class="w3-row-padding">
				  <div class="w3-third">
				  	<select class="w3-select" name="gender" id="gender">
					  <option value="" disabled selected>Choose gender</option>
					  <option value="male">male</option>
					  <option value="female">female</option>
					</select>
				  </div>
				</div>

				<br>

				<div class="w3-row-padding">
				  <div class="w3-third">
				    <button class="w3-btn w3-green" type="submit" value="send" name="send" id="send">Add Patient</button>
				  </div>
				</div>

			</form>

		</div>
	</div>

	<!-- update patient view -->
	<div class="w3-container" style="margin-left:21%">
		<div id="edit_patient_info_view" class="w3-container view">
  			
			<form action="" id="edit_patient_form">
				<br>
				<div class="w3-container w3-grey">
  					<h2>Edit Patient information</h2>
				</div>

				<br><br>

	  			<div class="w3-row-padding">

	  			  <div class="w3-third">
				    <input class="w3-input w3-border" name="stu_id" id="stu_id_update" type="text" placeholder="Student_id">
				  </div>

				  <div class="w3-third">
				    <input class="w3-input w3-border" name="first_name" id="first_name_update" type="text" placeholder="first name">
				  </div>

				  <div class="w3-third">
				    <input class="w3-input w3-border" name="last_name" id="last_name_update" type="text" placeholder="last name">
				  </div>

				</div>

				<br>

				<div class="w3-row-padding">
				  <div class="w3-third">
				    <input class="w3-input w3-border" name="phone_num" id="phone_num_update" type="text" placeholder="phone no">
				  </div>

				  <div class="w3-third">
				    <input class="w3-input w3-border" name="age" id="age_update" type="text" placeholder="Age">
				  </div>

				  <div class="w3-third">
				    <input class="w3-input w3-border" name="dep" id="dep_update" type="text" placeholder="Department">
				  </div>
				  
				</div>

				<br>

				<div class="w3-row-padding">
				  <div class="w3-third">
				  	<select class="w3-select" name="gender" id="gender_update">
					  <option value="" disabled selected>Choose gender</option>
					  <option value="male">male</option>
					  <option value="female">female</option>
					</select>
				  </div>
				</div>

				<br>

				<div class="w3-row-padding">
				  <div class="w3-third">
				    <button class="w3-btn w3-green" type="submit" value="send" name="send" id="send">Update Patient</button>
				  </div>
				</div>

			</form>

		</div>
	</div>
	<!-- update patient view end -->
<?php include_once "../SCIMS/views/view_helpers/patients_view.php"?>

<script type="text/javascript" src="../SCIMS/lib/jquery.min.js"></script>
<script>
//window.history.pushState("", "", "Admin");
window.history.replaceState("", "", "Registrar");
loadView("add_patient");

function loadView(id) {
    var i;
    var x = document.getElementsByClassName("view");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    document.getElementById(id).style.display = "block";  
}

//ajax function for handling add patient.
$(function() {
        $("#add_patient_form").bind('submit',function() {
          var stu_id = $('#stu_id').val();
          var first_name = $('#first_name').val();
          var last_name = $('#last_name').val();
          var phone_num = $('#phone_num').val();
          var age = $('#age').val();
          var gender = $('#gender').val();
          var dep = $('#dep').val();
          
          	$.post('/SCIMS/add_patient',

          			{	stu_id:stu_id,
          				first_name:first_name,
          				last_name:last_name,
          				department:dep,
          				phone_num:phone_num,
          				gender:gender,
          				age:age
          			},

          			function(data){
          				var resp = JSON.parse(data);
              			if(resp.status=='0'){
              				document.getElementById('patients_view_table').innerHTML+="<tr id='"+stu_id+"'><td>"+stu_id+'</td><td>'+first_name+'</td><td>'+last_name+'</td><td>'+gender+'</td><td>'+age+'</td><td>'+phone_num+'</td><td>'+dep+'</td><td>'+resp.date_of_reg+'</td>'+"<td><a href='#' onclick='load_update_patient_view('"+resp.stu_id+"')'><img src='../SCIMS/res/edit.png' alt='update' width='17' height='17'></a>\
					  <a href='#' onclick='remove_patient('"+resp.stu_id+"')'><img src='../SCIMS/res/remove.png' alt='remove' width='17' height='17'></a></td></tr>";
					  alert('patient was registered successuflly');
              			}else{
              				alert('an error occured while registering the patient!');
              			}
              			
           			});
          
           
           return false;
        });
});
// edit patient 
$(function() {
        $("#edit_patient_form").bind('submit',function() {
          var stu_id = $('#stu_id_update').val();
          var first_name = $('#first_name_update').val();
          var last_name = $('#last_name_update').val();
          var phone_num = $('#phone_num_update').val();
          var age = $('#age_update').val();
          var gender = $('#gender_update').val();
          var dep = $('#dep_update').val();
          
          	$.post('/SCIMS/edit_patient',

          			{	stu_id:stu_id,
          				first_name:first_name,
          				last_name:last_name,
          				department:dep,
          				phone_num:phone_num,
          				gender:gender,
          				age:age
          			},

          			function(data){

              			if(data=='0'){
              				alert('patient information successuflly updated');
              			}else{
              				alert('there was an error while updating patient info!');
              			}
              			
           			});
          
           
           return false;
        });
});
// display returned search values
function display_search_result(data){
	const res = JSON.parse(data);
	if(res.status!=1){
		document.getElementById('search_results_table').innerHTML+='<td>'+res.result['stu_id']+'</td><td>'+res.result['first_name']+'</td><td>'+res.result['last_name']+'</td><td>'+res.result['gender']+'</td><td>'+res.result['age']+'</td><td>'+res.result['phone_num']+'</td><td>'+res.result['department']+'</td><td>'+res.result['date_of_reg']+'</td>';
		loadView('search_result');
		//alert(first_name);
	}
}
$(function() {
        $("#search_form").bind('submit',function() {
          var patient_id = $('#pat_query').val();
          
          
          	$.post('/SCIMS/search_patient',

          			{patient_id:patient_id},

          			function(data){
          				display_search_result(data);
              			
           			});
          
           
           return false;
        });
});

function load_update_patient_view(patient_id){
	document.getElementById('stu_id_update').value=patient_id;
	loadView('edit_patient_info_view');
}

function remove_patient(patient_id){
	if(confirm('Are you sure you want to delete the patient '+patient_id+' !')){
		$.post('/SCIMS/delete_patient',

          			{patient_id:patient_id},

          			function(data){
          				if(data=='0'){
          					var rem_val=document.getElementById(patient_id);
          					rem_val.remove();
          					alert('patient was successfully deleteted');
          				}else{
          					alert('an error occured while deleting pating!');
          				}
           			});
	}
}
// start pending patient
function start_pending_patient(pat_id){
	$.post('/SCIMS/set_appointment',

          			{stu_id:pat_id},

          			function(data){
          				if(data=='0'){
          					alert('patient added to pending');
          				}else{
          					alert('adding patient to pending failed!');
          				}
           			});
}
</script>
</body>
</html>
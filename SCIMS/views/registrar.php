<html>
<title>HUSCIMS</title>
<meta name="viewport">
<link rel="stylesheet" href="../SCIMS/lib/w3.css">
<body>

	<header class="w3-container w3-blue-grey" style="width:100%; height:20%">
		<br><br>
		<div class="w3-container w3-center">
			<h3>Hawasa University Student Clinic Information<br>Managment System</h3>
			
		</div>
	</header>

	<nav class="w3-sidenav w3-light-grey w3-card-2" style="width:17%">
	  <br>
	  <h4 style="padding-left:10%">  Registrar Panel</h4>
	  <ul>
  		<a onclick="loadView('add_patient')">Add Patient</a>
  		<a onclick="loadView('patients_view')">Patients</a>
	  </ul>
	</nav>

	<div class="w3-container" style="padding-left: 17%">
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

//ajax function for handling add_user_form.
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

              			alert(data);
              			// todo :- update the html with the new patient info(in patients view)
              			
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
          				display_search_result(data)
              			
           			});
          
           
           return false;
        });
});

</script>
</body>
</html>
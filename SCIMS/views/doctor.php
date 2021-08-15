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
	  <h4 style="padding-left:10%">  Admin Panel</h4>
	  <ul>
  		<a onclick="loadView('patients_view')">Patients</a>
  		
	  </ul>
	</nav>

	<div class="w3-container" style="padding-left: 17%">
		<div id="doc_info" class="w3-container view">
  			<h2>doctor info</h2>
  			
		</div>
	</div>

	<?php include_once "../SCIMS/views/view_helpers/patients_view.php"?>	

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

// display returned search values
function display_search_result(data){
	const res = JSON.parse(data);
	if(res.status!=1){
		document.getElementById('search_results_table').innerHTML+='<td>'+res.result['stu_id']+'</td><td>'+res.result['first_name']+'</td><td>'+res.result['last_name']+'</td><td>'+res.result['gender']+'</td><td>'+res.result['age']+'</td><td>'+res.result['phone_num']+'</td><td>'+res.result['department']+'</td><td>'+res.result['date_of_reg']+'</td>';
		loadView('search_result');
		//alert(first_name);
	}
}
// ajax function for handling search_form
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
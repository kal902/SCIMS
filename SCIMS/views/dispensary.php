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
	    
  		<a  class="w3-bar-item w3-button" onclick="loadView('prescription_hist_view')"><img src="../SCIMS/res/prescription.png" alt="prescription" width="30" height="30"> Prescriptions</a>
  	
  		<a  class="w3-bar-item w3-button" onclick="loadView('drugs_view')"><img src="../SCIMS/res/drugs.png" alt="drugs" width="30" height="30">Drugs</a>
  		<a  class="w3-bar-item w3-button" onclick="loadView('request_drug_view')"><img src="../SCIMS/res/drugs.png" alt="drugs" width="30" height="30">Request Drug</a>
	  
	</div>
	<!--sidebar end -->
	<div class="w3-flat-asbestos w3-container w3-card" style="margin-left:20%; height:20%">
		<br><br>
		<div class="w3-flat-belize-holey w3-container w3-center">
			<h3 class="w3-monospace w3-wide">Hawasa University Student Clinic Information<br>Managment System</h3>
			
		</div>
	</div>

	<div class="w3-container" style="margin-left:21%;margin-top:7px;margin-right:7px">
		<div id="request_drug_view" class="w3-container view">
  			<h2>Request Drug</h2>
  			
  			<div class="w3-row-padding">
  				  <div class="w3-third">
				    <input class="w3-input w3-border" name="staff_id" id="staff_id" type="text" placeholder="staff id">
				  </div>
				  <div class="w3-third">
				    <input class="w3-input w3-border" name="drug_name" id="drug_name" type="text" placeholder="drug name">
				  </div>
				  <div class="w3-third">
				    <input class="w3-input w3-border" name="ammount" id="ammount" type="text" placeholder="ammount">
				  </div>
			</div>
			<br>
			<div class="w3-row-padding">
				  
				  <div class="w3-third">
				    <button class="w3-btn w3-green" onclick="request_drug()" value="send" name="send" id="send">Request drug</button>
				  </div>
			</div>
		</div>
</div>	

	<?php include "../SCIMS/views/view_helpers/prescriptions_view.php"?>
	<?php include "../SCIMS/views/view_helpers/drugs_view.php"?>

<script type="text/javascript" src="../SCIMS/lib/jquery.min.js"></script>
<script>
//window.history.pushState("", "", "Admin");
window.history.replaceState("", "", "Dispensary");
loadView("prescription_hist_view");

function loadView(id) {
    var i;
    var x = document.getElementsByClassName("view");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    document.getElementById(id).style.display = "block";  
}

function request_drug(){
	var staff_id = document.getElementById('staff_id').value;
	var drug_name = document.getElementById('drug_name').value;
	var ammount = document.getElementById('ammount').value;

	$.post('/SCIMS/request_drug',

          			{staff_id:staff_id,
          			 drug_name:drug_name,
          			 ammount:ammount},

          			function(data){
          				if(data=="1"){
          					alert('request successfull');
          				}
              			
           			});
}
</script>
</body>
</html>
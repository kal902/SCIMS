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
  	
  		<a  class="w3-bar-item w3-button" onclick="loadView('add_drugs_view')"><img src="../SCIMS/res/add_drugs.png" alt="drugs" width="30" height="30"> Add Drugs</a>
  		<a  class="w3-bar-item w3-button" onclick="loadView('drugs_view')"><img src="../SCIMS/res/drugs.png" alt="drugs" width="30" height="30"> Drugs</a>
  		<a  class="w3-bar-item w3-button" onclick="loadView('drug_requests_view')"><img src="../SCIMS/res/pending.png" alt="doctor" width="30" height="30"> Drug Requests</a>
	  
	</div>
	<!--sidebar end -->
	<div class="w3-flat-asbestos w3-container w3-card" style="margin-left:20%; height:20%">
		<br><br>
		<div class="w3-flat-belize-holey w3-container w3-center">
			<h3 class="w3-monospace w3-wide">Hawasa University Student Clinic Information<br>Managment System</h3>
			
		</div>
	</div>
	<!--add drugs view -->
	<div class="w3-container" style="margin-left:20%">
		<div id="add_drugs_view" class="w3-container view">
  			
			<form action="" id="add_drug_form">
				<br>
				<div class="w3-container w3-grey">
  					<h2>Add Drug</h2>
				</div>

				<br><br>

	  			<div class="w3-row-padding">

					  <div class="w3-third">
					    <input class="w3-input w3-border" name="drug_name" id="drug_name" type="text" placeholder="drug name">
					  </div>

					  <div class="w3-third">
					    <input class="w3-input w3-border" name="category" id="category" type="text" placeholder="drug category">
					  </div>

					  <div class="w3-third">
					    <input class="w3-input w3-border" name="company" id="company" type="text" placeholder="company">
					  </div>

				</div>

				<br>

				<div class="w3-row-padding">
				  

					  <div class="w3-third">
					    <input class="w3-input w3-border" name="description" id="description" type="text" placeholder="description">
					  </div>

					  <div class="w3-third">
					    <input class="w3-input w3-border" name="quantity" id="quantity" type="text" placeholder="quantity">
					  </div>

					  <div class="w3-third">
					    <input class="w3-input w3-border" name="manu_date" id="manu_date" type="date" placeholder="date of manufacture">
					  </div>

				</div>

				<div class="w3-row-padding">
				  

					  <div class="w3-third">
					    <input class="w3-input w3-border" name="exp_date" id="exp_date" type="date" placeholder="expiration date">
					  </div>

					  <div class="w3-third">
					    <input class="w3-input w3-border" name="desc_no" id="desc_no" type="text" placeholder="desk no">
					  </div>

				</div>

				<br>

				<div class="w3-row-padding">
				  <div class="w3-third">
				    <button class="w3-btn w3-green" type="submit" value="send" name="send" id="send">Add drug</button>
				  </div>
				</div>

			</form>

		</div>
	</div>
	<!--add drugs view end-->
	<?php include "../SCIMS/views/view_helpers/drugs_view.php"?>
	<?php include "../SCIMS/views/view_helpers/drug_requests_view.php"?>

<script type="text/javascript" src="../SCIMS/lib/jquery.min.js"></script>
<script>
//window.history.pushState("", "", "Admin");
window.history.replaceState("", "", "Doctor");
loadView("drugs_view");

function loadView(id) {
    var i;
    var x = document.getElementsByClassName("view");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    document.getElementById(id).style.display = "block";  
}
// add drug ajax function
$(function() {
        $("#add_drug_form").bind('submit',function() {
          var drug_name = $('#drug_name').val();
          var category = $('#category').val();
          var description = $('#description').val();
          var company = $('#company').val();
          var manu_date = $('#manu_date').val();
          var exp_date = $('#exp_date').val();
          var desc_no = $('#desc_no').val();
          var quantity = $('#quantity').val();
          	$.post('/SCIMS/add_drug',

          			{drug_name:drug_name,
          			 category:category,
          			 desc:description,
          			 company:company,
          			 quantity:quantity,
          			 manu_date:manu_date,
          			 exp_date:exp_date,
          			 desc_no:desc_no},

          			function(data){
          				alert(data);
              			
           			});
          
           
           return false;
        });
});


function remove_drug(drug_name){

}

function update_drug(drug_name){

}

</script>
</body>
</html>
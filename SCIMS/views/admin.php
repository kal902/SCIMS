<html>
<title>HUSCIMS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../SCIMS/lib/w3.css">
<link rel="stylesheet" href="../SCIMS/lib/w3-colors-flat.css">
<body>

	<div class="w3-sidebar w3-bar-block w3-card w3-flat-asbestos" style="width:20%">
	    <div style="height:20%"></div>
	    <br><br>
	    <a  class="w3-bar-item w3-button" onclick="loadView('add_staff')">Add Staff</a>
  		<a  class="w3-bar-item w3-button" onclick="loadView('view_staff')">View Staffs</a>

	</div>

	<div class="w3-flat-asbestos w3-container w3-card" style="margin-left:20%; height:20%">
		<br><br>
		<div class="w3-flat-belize-holey w3-container w3-center">
			<h3 class="w3-monospace w3-wide">Hawasa University Student Clinic Information<br>Managment System</h3>
			
		</div>
	</div>

	<div class="w3-container" style="margin-left:20%">
		<div id="view_staff" class="w3-container view">
  			<h2>Staffs</h2>
  			<table id='view_staffs_table' list of current table in thclass="w3-table w3-striped w3-border">
				<thead>
					<tr class="w3-grey">
					  <th>Staff id</th>
					  <th>First Name</th>
					  <th>Last Name</th>
					  <th>Work Position</th>
					  <th>Phone no</th>
					  <th>Date of reg</th>
					  <th>Action</th>
					</tr>
				</thead>
				<?php
				$staffs = $acc->get_all_accounts();
				foreach($staffs as $staff){  ?>
					<tr>
					  <td><?php echo $staff['staff_id'];?></td>
					  <td><?php echo $staff['first_name'];?></td>
					  <td><?php echo $staff['last_name'];?></td>
					  <td><?php echo $staff['work_position'];?></td>
					  <td><?php echo $staff['phone_num'];?></td>
					  <td><?php echo $staff['date_of_reg'];?></td>
					  <td>
					  	  <a href='#' onclick=<?php echo "update_staff('",$staff['staff_id'],"')";?>><img src='../SCIMS/res/edit.png' alt='update' width='17' height='17'></a>
					      <a href='#' onclick=<?php echo "remove_staff('",$staff['staff_id'],"')";?>><img src='../SCIMS/res/remove.png' alt='remove' width='17' height='17'></a>
					  </td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>

	<div class="w3-container" style="margin-left:20%">
		<div id="add_staff" class="w3-container view">
  			
			<form action="" id="add_user_form">
				<br>
				<div class="w3-container w3-grey">
  					<h2>Add Staff Account</h2>
				</div>

				<br><br>

	  			<div class="w3-row-padding">

				  <div class="w3-third">
				    <input class="w3-input w3-border" name="first_name" id="first_name" type="text" placeholder="first name">
				  </div>

				  <div class="w3-third">
				    <input class="w3-input w3-border" name="last_name" id="last_name" type="text" placeholder="last name">
				  </div>

				  <div class="w3-third">
				    <select class="w3-select" type ="text" id="account_type" name="account_type">
					  <option value="" disabled selected>Choose Account Type</option>
					  <option type="text" value="admin">Admin</option>
					  <option type="text" value="manager">Manager</option>
					  <option type="text" value="doctor">Doctor</option>
					  <option type="text" value="lab_tech">Lab Tech</option>
					  <option type="text" value="registrar">Registrar</option>
					  <option type="text" value="dispensary">Dispensary</option>
					  <option type="text" value="drug_store_man">Drug Store man</option>
					  
					</select>
				  </div>

				</div>

				<br>

				<div class="w3-row-padding">
				  <div class="w3-third">
				    <input class="w3-input w3-border" name="phone_num" id="phone_num" type="text" placeholder="phone no">
				  </div>

				  <div class="w3-third">
				    <input class="w3-input w3-border" name="password" id="password" type="text" placeholder="password">
				  </div>

				  <div class="w3-third">
				    <input class="w3-input w3-border" name="c_password" id="c_password" type="text" placeholder="confirm password">
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
				    <button class="w3-btn w3-green" type="submit" value="send" name="send" id="send">register</button>
				  </div>
				</div>

			</form>

		</div>
	</div>

	<div class="w3-container" style="margin-left:20%">
		<div id="update_staff" class="w3-container view">
  			<h2>Update Staff</h2>
		</div>
	</div>

	<div class="w3-container" style="margin-left:20%">
		<div id="delete_staff" class="w3-container view">
  			<h2>Delete Staff</h2>
		</div>
	</div>	

<script type="text/javascript" src="../SCIMS/lib/jquery.min.js"></script>
<script>
//window.history.pushState("", "", "Admin");
window.history.replaceState("", "", "Admin");
loadView("view_staff");

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
        $("#add_user_form").bind('submit',function() {
          var first_name = $('#first_name').val();
          var last_name = $('#last_name').val();
          var account_type = $('#account_type').val();
          var phone_num = $('#phone_num').val();
          var password = $('#password').val();
          var c_password = $('#c_password').val();
          var gender = $('#gender').val();
          if(password!=c_password){
          	alert("password must be simillar");
          }else{
          	$.post('/SCIMS/add_user',

          			{first_name:first_name,
          			last_name:last_name,
          			account_type:account_type,
          			phone_num:phone_num,
          			password:password,
          			gender:gender},

          			function(data){

              			var resp=JSON.parse(data);
              			if(resp.status=='0'){
              				document.getElementById('view_staffs_table')+='<tr><td>'+resp.id+'</td><td>'+first_name+'</td><td>'+last_name+'</td><td>'+account_type+'</td><td>'+phone_num+'</td><td>'+resp.date_of_reg+"</td>\
              				<td>\
					  	  		<a href='#' onclick=\'update_staff(\'"+resp.id+"\')\'><img src='../SCIMS/res/edit.png' alt='update' width='17' height='17'></a>\
					      		<a href='#' onclick=\'remove_staff(\'"+resp.id+"\')\'><img src='../SCIMS/res/remove.png' alt='remove' width='17' height='17'></a>\
					 		</td></tr>";
              			}
              			
           			});
          }
           
           return false;
        });
});

function update_staff(staff_id){

}

function remove_staff(staff_id){

}

</script>
</body>
</html>
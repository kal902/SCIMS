<div class="w3-container" style="padding-left: 17%">
		<div id="search_result" class="w3-container view">
  			<h2>Patients</h2>
  			
  			<table id="search_results_table" class="w3-table w3-striped w3-border">
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

	<div class="w3-container" style="padding-left: 17%">
		<div id="patients_view" class="w3-container view">
  			<h2>Patients</h2>
  			<form action="" id="search_form">

				<div class="w3-row-padding">
					<div class="w3-third">
				    <input class="w3-input w3-border" name="pat_query" id="pat_query" type="text" placeholder="patient id">
				  </div>
				  <div class="w3-third">
				    <button class="w3-btn w3-green" type="submit" value="search" name="search" id="search">register</button>
				  </div>
				</div>

			</form>
  			<table class="w3-table w3-striped w3-border">
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
				<?php
				$patients = $pat->get_all_patients();
				foreach($patients as $patient){  ?>
					<tr>
					  <td><?php echo $patient['stu_id'];?></td>
					  <td><?php echo $patient['first_name'];?></td>
					  <td><?php echo $patient['last_name'];?></td>
					  <td><?php echo $patient['gender'];?></td>
					  <td><?php echo $patient['age'];?></td>
					  <td><?php echo $patient['phone_num'];?></td>
					  <td><?php echo $patient['department'];?></td>
					  <td><?php echo $patient['date_of_reg'];?></td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>
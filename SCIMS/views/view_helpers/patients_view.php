<div class="w3-container" style="margin-left:21%;margin-top:7px;margin-right:7px">
		<div id="search_result" class="w3-container view">
  			<h2>Search Results</h2>
  			
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

	<div class="w3-container" style="margin-left:21%;margin-top:7px;margin-right:7px">
		<div id="patients_view" class="w3-container view ">
  			<h2>Patients</h2>
  			<form action="" id="search_form">

				<div class="w3-row-padding">
					<div class="w3-third">
				    <input class="w3-input w3-border" name="pat_query" id="pat_query" type="text" placeholder="patient id">
				  </div>
				  <div class="w3-third">
				    <button class="w3-btn w3-green" type="submit" value="search" name="search" id="search">Search</button>
				  </div>
				</div>

			</form>
  			<table id='patients_view_table' class="w3-flat-clouds w3-table w3-striped w3-border-top">
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
					  <?php if($_SESSION['account_type']=='registrar') echo '<th>Actions</th>';?>
					</tr>
				</thead>
				<?php
				$all_patients = $patients->get_all_patients();
				foreach($all_patients as $patient){  ?>
					<tr id=<?php $id=$patient['stu_id']; echo "$id";?>>
					  <td><a href='#' onclick=<?php echo "get_patient_hist('",$patient['stu_id'],"')";?>><?php echo $patient['stu_id'];?></a></td>
					  <td><?php echo $patient['first_name'];?></td>
					  <td><?php echo $patient['last_name'];?></td>
					  <td><?php echo $patient['gender'];?></td>
					  <td><?php echo $patient['age'];?></td>
					  <td><?php echo $patient['phone_num'];?></td>
					  <td><?php echo $patient['department'];?></td>
					  <td><?php echo $patient['date_of_reg'];?></td>
					  <?php if($_SESSION['account_type']=='registrar'){?>
					  <td>
					    <a href='#' onclick=<?php echo "start_pending_patient('",$patient['stu_id'],"')";?>><img src='../SCIMS/res/pending.png' alt='set appointment' width='17' height='17'></a>
					    <a href='#' onclick=<?php echo "load_update_patient_view('",$patient['stu_id'],"')";?>><img src='../SCIMS/res/edit.png' alt='set appointment' width='17' height='17'></a>
					  </td>
					  <?php } ?>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>
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
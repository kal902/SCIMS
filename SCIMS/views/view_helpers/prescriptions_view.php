<div class="w3-container" style="margin-left:21%">
		<div id="prescription_hist_view" class="w3-container view">
  			<h2>Prescriptions</h2>
  			<table id="prescriptions_hist_table" class="w3-table w3-striped w3-border">
				<thead>
					<tr class="w3-grey">
					  <th>Patient id</th>
					  <th>Staff id</th>
					  <th>Medicine</th>
					  <th>Strength</th>
					</tr>
				</thead>
				<?php
				$prescr = $prescriptions->get_all_prescriptions();
				foreach($prescr as $prescription){  ?>
					<tr>
					  <td><?php echo $prescription['pat_id'];?></td>
					  <td><?php echo $prescription['staff_id'];?></td>
					  <td><?php echo $prescription['medicine'];?></td>
					  <td><?php echo $prescription['strength'];?></td>
					</tr>
				<?php } ?>
			</table>
		</div>
</div>
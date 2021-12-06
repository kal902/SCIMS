<div class="w3-container" style="margin-left:21%;margin-top:7px;margin-right:7px">
		<div id="lab_requests_view" class="w3-container view ">
  			<h2>Lab Requests</h2>
  			
  			<table id='lab_requests_table' class="w3-flat-clouds w3-table w3-striped w3-border-top">
				<thead>
					<tr class="w3-grey">
					  <th>Doctor id</th>
					  <th>Patient id</th>
					  <th>Request</th>
					  <?php if($_SESSION['account_type']=='lab_tech') echo '<th>Actions</th>';?>
					</tr>
				</thead>
				<?php
				$pen_requests = $lab_request->get_pending_requests();
				foreach($pen_requests as $pen_request){  ?>
					<tr>

					  <td><?php echo $pen_request['doctor_id'];?></td>
					  <td><a href='#' onclick=<?php echo "load_patient_info_view('",$pen_request['pat_id'],"')";?>><?php echo $pen_request['pat_id'];?></a></td>
					  
					  <td><?php echo $pen_request['request'];?></td>
					
					  <?php if($_SESSION['account_type']=='lab_tech'){ $arg = array('form_view'=>$pen_request['request']."_result_form_view",'pat_id'=>$pen_request['pat_id']);  ?>
					  <td><a href='#' onclick=<?php echo "load_lab_result_submit_view('",json_encode($arg),"')";?>>submit</a>
					  </td>
					  <?php } ?>
					</tr>
				<?php } ?>
			</table>
		</div>
</div>

<div class="w3-container" style="margin-left:21%">
		<div id="drugs_view" class="w3-container view">
  			<h2>Drugs</h2>
  			<table id="drugs_table" class="w3-table w3-striped w3-border">
				<thead>
					<tr class="w3-grey">
					  <th>Drug Name</th>
					  <th>Category</th>
					  <th>Desc</th>
					  <th>Company</th>
					  <th>Quantity</th>
					  <th>Date Supplied</th>
					  <th>Manuf Date</th>
					  <th>Exp Date</th>
					  <th>Desk no</th>
					  <th>Actions</th>
					</tr>
				</thead>
				<?php
				$drugs = $drugstore->get_all_drugs();
				foreach($drugs as $drug){  ?>
					<tr id=<?php $id=$drug['drug_name']; echo "'$id'";?> >

					  <td><?php echo $drug['drug_name'];?></td>
					  <td><?php echo $drug['category'];?></td>
					  <td><?php echo $drug['desc'];?></td>
					  <td><?php echo $drug['company'];?></td>
					  <td><?php echo $drug['quantity'];?></td>
					  <td><?php echo $drug['date_supplied'];?></td>
					  <td><?php echo $drug['manu_date'];?></td>
					  <td><?php echo $drug['exp_date'];?></td>
					  <td><?php echo $drug['desc_no'];?></td>
					  <?php if($_SESSION['account_type']=='dispensary'){?>
					  	<td><a href='#' onclick=<?php echo "request_drug('",$drug['drug_name'],"')";?>><img src='../SCIMS/res/request.png' alt='request' width='17' height='17'></a></td>
					  <?php }else{?>
					  	<td><a href='#' onclick=<?php echo "update_drug('",$drug['drug_name'],"')";?>><img src='../SCIMS/res/edit.png' alt='update' width='17' height='17'></a>
					  <a href='#' onclick=<?php echo "remove_drug('",$drug['drug_name'],"')";?>><img src='../SCIMS/res/remove.png' alt='update' width='17' height='17'></a></td>
					  <?php }?>

					</tr>
				<?php } ?>
			</table>
		</div>
</div>
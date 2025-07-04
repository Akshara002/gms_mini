<?php
include_once('Header.php');
?>


<style>
	table, th, td {
		border-collapse:collapse;
		padding:10px;
	}

	.adjustloc{
		margin-left: 20px;width: 80%;
	}
	.adjustloctable{
		margin-left: 20px;width:80%;
	}
</style>



<div class="page-header">
	<table>
		<tr>
			<td><h2 class="adjustloc">Workers</h2></td>
			<td><button type="button" class="btn btn-info"  onClick="window.print()"> <span class="glyphicon glyphicon-print"></span>  Save as pdf </button></td>
		</tr>
	</table>
	
	
</div> 


<table class="table table-hover table-bordered adjustloctable">
	<thead>
		<tr>
			<th>Name</th>
			<th>Date Of Bith</th>
			<th>Gender</th>
			<th>AddressLine 1</th>
			<th>AddressLine 2</th>
			<th>Street</th>
			<th>District</th>
			<th>City</th>
			<th>State</th>
			<th>Country</th>
			<th>Pincode</th>
			<th>Mobile</th>
		</tr>
	</thead>
	<tbody>

		<?php
		$con = new mysqli('localhost', 'root', '', 'gms_test');
		if($con->connect_error)
		{
			die('Connection failed :' . $con->connect_error);
		}
		else
		{
			$stmt = $con->prepare("SELECT userDetailsId, name, dob, gender, addressline1, addressline22, street, district, city, state, country, pincode, mobile FROM user_details WHERE userTypeId = 3 AND  user_details.isDeleted = 0 ");
			$stmt->execute();
			$stmt_result = $stmt->get_result();
			while($row = $stmt_result->fetch_assoc()) 
			{
				?>
				<tr>
					<td style="display:none" ><?php echo $row["userDetailsId"]; ?></td>
					<td><?php echo $row["name"]; ?></td>
					<td><?php echo $row["dob"]; ?></td>
					<td><?php echo $row["gender"]; ?></td>
					<td><?php echo $row["addressline1"]; ?></td>
					<td><?php echo $row["addressline22"]; ?></td>
					<td><?php echo $row["street"]; ?></td>
					<td><?php echo $row["district"]; ?></td>
					<td><?php echo $row["city"]; ?></td>
					<td><?php echo $row["state"]; ?></td>
					<td><?php echo $row["country"]; ?></td>
					<td><?php echo $row["pincode"]; ?></td>
					<td><?php echo $row["mobile"]; ?></td>
					<?php if(isset($_SESSION['USERTYPEID']) and $_SESSION['USERTYPEID'] == 1) { ?>
						<td>
							
							
							<form method="post">
								<a  id="edit" name="edit" class="btn btn-info" href='EditUsers.php?REQID=<?php echo $row["userDetailsId"]; ?>'> Edit </a>
							</form>
						</td>
						<td>
							
							<a  id="delete" name="delete" class="btn btn-info" href='EditUsers.php?DELREQID=<?php echo $row["userDetailsId"]; ?>'> Delete </a>
						</form>
						
					</td>
				<?php } ?>
				
			</tr>
			<?php
		}

	}
	?>
</tbody>
</table>







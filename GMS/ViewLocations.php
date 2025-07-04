<?php
include_once('Header.php');
?>


<style>
	table, th, td {
		border-collapse:collapse;
		padding:10px;
	}

	.adjustloc{
		margin-left: 20px;width: 300px;
	}
	.adjustloctable{
		margin-left: 20px;width:80%;
	}
</style>

<div class="page-header">
	<table>
		<tr>
			<td><h2 class="adjustloc">Service Locations</h2></td>
			<td><button type="button" class="btn btn-info"  onClick="window.print()"> <span class="glyphicon glyphicon-print"></span>  Save as pdf </button></td>
		</tr>
	</table>
	
	
</div> 



<table class="table table-hover table-bordered adjustloctable">
	<thead>
		<tr>
			<th>Street</th>
			<th>City</th>
			<th>District</th>
			<th>State</th>
			<th>Country</th>
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
			$stmt = $con->prepare("select locationId,street, city, district, state, country from locations");
			$stmt->execute();
			$stmt_result = $stmt->get_result();
			while($row = $stmt_result->fetch_assoc()) 
			{
				?>
				<tr>
					<td style="display:none"><?php echo $row["locationId"]; ?></td>
					<td><?php echo $row["street"]; ?></td>
					<td><?php echo $row["city"]; ?></td>
					<td><?php echo $row["district"]; ?></td>
					<td><?php echo $row["state"]; ?></td>
					<td><?php echo $row["country"]; ?></td>
					<?php if(isset($_SESSION['USERTYPEID']) and $_SESSION['USERTYPEID'] == 1) { ?>
						<td>
							
							
							<form method="post">
								<a  id="edit" name="edit" class="btn btn-info" href='EditLocations.php?REQID=<?php echo $row["locationId"]; ?>'> Edit </a>
							</form>
						</td>
						<td>
							
							<a  id="delete" name="delete" class="btn btn-info" href='EditLocations.php?DELREQID=<?php echo $row["locationId"]; ?>'> Delete </a>
						</form>
					<?php } ?>
				</td>
			</tr>
			<?php
		}

	}
	?>
</tbody>
</table>





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
			<td><h2 class="adjustloc">View Complaints</h2></td>
			<td><button type="button" class="btn btn-info"  onClick="window.print()"> <span class="glyphicon glyphicon-print"></span>  Save as pdf </button></td>
		</tr>
	</table>
	
	
</div> 


<table class="table table-hover table-bordered adjustloctable">
	<thead>
		<tr>
			<th>House Owner </th>
			<th>Complaint Details</th>
			<th>House Owner Remark</th>
			<th>Admin Remark</th>
			<th>Complaint Status</th>
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
			$stmt = '';
			if(isset($_SESSION['USERTYPEID']) && $_SESSION['USERTYPEID'] == 1)
			{
				$stmt = $con->prepare("SELECT complaints.complaintId, user_details.name,complaint_status.status,complaints.complaintDetails, complaints.requesterRemark,complaints.adminRemark FROM complaints INNER JOIN complaint_status ON complaint_status.complaintStatusId = complaints.complaintStatusId INNER JOIN user_details ON user_details.userDetailsId = complaints.userDetailsId WHERE complaints.isDeleted = 0");
			}
			else
			{
				$stmt = $con->prepare("SELECT complaints.complaintId,user_details.name,complaint_status.status,complaints.complaintDetails, complaints.requesterRemark,complaints.adminRemark FROM complaints INNER JOIN complaint_status ON complaint_status.complaintStatusId = complaints.complaintStatusId INNER JOIN user_details ON user_details.userDetailsId = complaints.userDetailsId WHERE complaints.isDeleted = 0 and user_details.userDetailsId = ?");
				$stmt->bind_param("i", $_SESSION['USERID']);

			}


			
			$stmt->execute();
			$stmt_result = $stmt->get_result();
			while($row = $stmt_result->fetch_assoc()) 
			{
				?>
				<tr>
					<td style="display:none" ><?php echo $row["complaintId"]; ?></td>
					<td><?php echo $row["name"]; ?></td>
					<td><?php echo $row["complaintDetails"]; ?></td>
					<td><?php echo $row["requesterRemark"]; ?></td>
					<td><?php echo $row["adminRemark"]; ?></td>
					<td><?php echo $row["status"]; ?></td>
					<td><a id="edit" class="btn btn-info" href='Complaints.php?REQID=<?php echo $row["complaintId"]; ?>'>Edit</a></td>
					<?php if(isset($_SESSION['USERTYPEID']) and $_SESSION['USERTYPEID'] == 1) { ?>
						<td><a id="delete" class="btn btn-info" href='Complaints.php?DELREQID=<?php echo $row["complaintId"]; ?>'>Delete</a></td>
					<?php } ?>
				</tr>
				<?php
			}

		}
		?>
	</tbody>
</table>





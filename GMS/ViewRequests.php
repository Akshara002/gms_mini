<?php
include_once('Header.php');


?>


<style>
	table, th, td {
		border-collapse:collapse;
		padding:10px;
	}

	.adjustloc{
		margin-left: 20px;width: 350px;
	}
	.adjustloctable{
		margin-left: 20px;width:80%;
	}
</style>
</style>


<div class="page-header">
	<table>
		<tr>
			<td><h2 class="adjustloc">View Collection Requests</h2></td>
			<td><button type="button" class="btn btn-info"  onClick="window.print()"> <span class="glyphicon glyphicon-print"></span>  Save as pdf </button></td>
		</tr>
	</table>
	
	
</div> 

<table class="table table-hover table-bordered adjustloctable">
	<thead>
		<tr>
			<th>Request#</th>
			<th>House Owner</th>
			<th>Garbage Type</th>
			<th>Assigned Worker</th>
			<th>House Owner Remark</th>
			<th>Admin Remark</th>
			<th>Request Status</th>
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
			if(isset($_SESSION['USERTYPEID']) && ($_SESSION['USERTYPEID'] == 1 ))
			{
				$stmt = $con->prepare("SELECT
					request.requestId,
					user_details.name, 
					garbage_types.garbageType, 
					(SELECT name  FROM user_details where user_details.userDetailsId = request.assignedWorkerId) as `assignedWorker`,
					request.requesterRemark,
					request.adminRemark,
					request_status.status
					FROM garbage_types INNER JOIN request ON garbage_types.garbageTypeId = request.garbageTypeId
					INNER JOIN user_details ON request.userDetailsId = user_details.userDetailsId
					INNER JOIN request_status ON request.statusId = request_status.statusId WHERE request.isDeleted = 0");
			}
			else if(isset($_SESSION['USERTYPEID']) && ($_SESSION['USERTYPEID'] == 3 ))
			{
				$stmt = $con->prepare("SELECT
					request.requestId,
					user_details.name, 
					garbage_types.garbageType, 
					(SELECT name  FROM user_details where user_details.userDetailsId = request.assignedWorkerId) as `assignedWorker`,
					request.requesterRemark,
					request.adminRemark,
					request_status.status
					FROM garbage_types INNER JOIN request ON garbage_types.garbageTypeId = request.garbageTypeId
					INNER JOIN user_details ON request.userDetailsId = user_details.userDetailsId
					INNER JOIN request_status ON request.statusId = request_status.statusId WHERE request.assignedWorkerId = ? AND request.isDeleted = 0");
				$stmt->bind_param("i", $_SESSION['USERID']);
			}
			else
			{

				$stmt = $con->prepare("SELECT
					request.requestId,
					user_details.name, 
					garbage_types.garbageType, 
					(SELECT name  FROM user_details where user_details.userDetailsId = request.assignedWorkerId) as `assignedWorker`,
					request.requesterRemark,
					request.adminRemark,
					request_status.status
					FROM garbage_types INNER JOIN request ON garbage_types.garbageTypeId = request.garbageTypeId
					INNER JOIN user_details ON request.userDetailsId = user_details.userDetailsId
					INNER JOIN request_status ON request.statusId = request_status.statusId WHERE user_details.userDetailsId = ? AND request.isDeleted = 0");
				$stmt->bind_param("i", $_SESSION['USERID']);

			}
			$stmt->execute();
			$stmt_result = $stmt->get_result();
			while($row = $stmt_result->fetch_assoc()) 
			{
				?>
				<tr>
					<td><?php echo $row["requestId"]; ?></td>
					<td><?php echo $row["name"]; ?></td>
					<td><?php echo $row["garbageType"]; ?></td>
					<td><?php echo $row["assignedWorker"]; ?></td>
					<td><?php echo $row["requesterRemark"]; ?></td>
					<td><?php echo $row["adminRemark"]; ?></td>
					<td><?php echo $row["status"]; ?></td>
					<td>
						<a class="btn btn-info" id="edit" href='Request.php?REQID=<?php echo $row["requestId"]; ?>' >Edit</a>
					</td>
					<?php if(isset($_SESSION['USERTYPEID']) and $_SESSION['USERTYPEID'] == 1) { ?>
						<td>
							<a class="btn btn-info" id="delete" href='Request.php?DELREQID=<?php echo $row["requestId"]; ?>'>Delete</a>
						</td>
					<?php } ?>
				</tr>
				<?php
			}

		}
		?>
	</tbody>
</table>







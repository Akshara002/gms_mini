	<?php
	include_once('Header.php');

	$con = new mysqli('localhost', 'root', '', 'gms_test');
	if(isset($_GET['DELREQID']) && $_GET['DELREQID'] != "")
	{
		$stmt = $con->prepare("UPDATE request SET request.isDeleted = 1 WHERE request.requestId = ?");
		$stmt->bind_param("i",  $_GET['DELREQID']);
		$stmt->execute();
		$stmt->close();
		$con->close();

		echo "<script>alert('Collection request deleted successfully !');</script>";
		echo "<script> location.href='http://localhost/GMS/ViewRequests.php'; </script>";
		exit;
	}


	$eGarbageTypeId = null;
	$eStatusId = null;
	$eAssignedWorkerId = null;
	$eRequesterRemark = null;
	$eAdminRemark = null;
	$isAdmin = null;

	if( isset($_GET['REQID']) && $_GET['REQID'] != "")
	{
		$_SESSION['REQID'] = $_GET['REQID'];
		$isAdmin = true;
	}
	else
	{
		$_SESSION['REQID'] = "";
		$isAdmin = false;
	}

	$con = new mysqli('localhost', 'root', '', 'gms_test');
	if(isset($_GET['REQID']) && $_GET['REQID'] != "")
	{



		$stmt = $con->prepare("SELECT garbage_types.garbageTypeId,request_status.statusId,request.assignedWorkerId,request.requesterRemark,request.adminRemark FROM garbage_types INNER JOIN request ON garbage_types.garbageTypeId = request.garbageTypeId INNER JOIN user_details ON request.userDetailsId = user_details.userDetailsId INNER JOIN request_status ON request.statusId = request_status.statusId WHERE request.requestId = ?");
		$stmt->bind_param("i",$_SESSION['REQID']);
		$stmt->execute();
		$stmt_result = $stmt->get_result();
		$value = $stmt_result->fetch_object();
		if (!is_null($value)) 
		{
			$eGarbageTypeId = $value->garbageTypeId;
			$eStatusId = $value->statusId;
			$eAssignedWorkerId = $value->assignedWorkerId;
			$eRequesterRemark = $value->requesterRemark;
			$eAdminRemark = $value->adminRemark;
		} 
		


	}

	?>


	<style>
		table, th, td {
			border-collapse:collapse;
			padding:10px;
		}

		table{
			margin-left:30%;
			margin-top:5%
		}

		h2{
			margin-left:30%;
			margin-top:5%
		}
	</style>


	<div class="page-header">

		<h2> Create/Edit Collection Request</h2>
	</div> 

	<form class="form-inline" method="post">

		<table>

			<tr style="padding-top:10px">
				<td> <label>Garbage Type:</label> </td>
				<td>
					<div class="form-group">
						<select style="width:450px;" class="form-control" name="garbageType">
							<?php

							$stmt = $con->prepare("SELECT garbage_types.garbageTypeId, garbage_types.garbageType FROM garbage_types");
							$stmt->execute();
							$stmt_result = $stmt->get_result();
							while($row = $stmt_result->fetch_assoc()) 
							{
								?>
								<option 
								<?= $eGarbageTypeId == $row["garbageTypeId"] ? ' selected="selected"' : '';?>
								value="<?php echo $row["garbageTypeId"]; ?>"><?php echo $row["garbageType"];
							?></option>
							<?php

						}

						?>
					</select>
				</div>
			</td>
		</tr>


		<tr style="padding-top:10px">
			<td> <label>Request Status:</label> </td>
			<td>
				<div class="form-group">
					<select style="width:450px" class="form-control" name="drpRequestStatus">
						<?php

						$stmt = $con->prepare("SELECT request_status.statusId, request_status.status FROM request_status");
						$stmt->execute();
						$stmt_result = $stmt->get_result();
						while($row = $stmt_result->fetch_assoc()) 
						{
							?>
							<option
							<?= $eStatusId == $row["statusId"] ? ' selected="selected"' : '';?>
							value="<?php echo $row["statusId"]; ?>"><?php echo $row["status"]; ?></option>
							<?php
						}

						?>
					</select>
				</div>
			</td>
		</tr>

		<tr style="padding-top:10px">
			<td> <label>Assigned Worker:</label> </td>
			<td>
				<div class="form-group">
					<select style="width:450px" class="form-control" name="drpAssignedWorker"
					>
					<?php

					$stmt = $con->prepare("SELECT user_details.name, user_details.userDetailsId FROM user_details WHERE user_details.userTypeId = 3");
					$stmt->execute();
					$stmt_result = $stmt->get_result();
					while($row = $stmt_result->fetch_assoc()) 
					{
						?>
						<option
						<?= $eAssignedWorkerId == $row["userDetailsId"] ? ' selected="selected"' : '';?>
						value="<?php echo $row["userDetailsId"]; ?>"><?php echo $row["name"]; ?></option>
						<?php
					}

					?>
				</select>
			</div>
		</td>
	</tr>


	<tr style="padding-top:10px">
		<td> <label>House Owner Remark:</label> </td>
		<td>
			<div class="form-group">
				<input style="width:450px" type="text" class="form-control"  name="houseOwnerRemark" 
				value=" <?php if(!is_null($eRequesterRemark)) { echo $eRequesterRemark; } ?> ">

			</div>
		</td>
	</tr>

	<tr style="padding-top:10px">
		<td> <label>Admin Remark:</label> </td>
		<td>
			<div class="form-group">
				<input 
				style="width:450px" type="text" class="form-control"  name="adminRemark" 
				value=" <?php if(!is_null($eAdminRemark)) { echo $eAdminRemark; } ?> ">

			</div>
		</td>
	</tr>


	<tr>
		<td>
			<button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>
		</td>
	</tr>
</table>
</form>




<?php

if(array_key_exists('btnSubmit', $_POST)) {
	CreateRequest();
}

function CreateRequest()
{
	$garbageType = $_POST['garbageType'];
	$drpRequestStatus = $_POST['drpRequestStatus'];
	$drpAssignedWorker = $_POST['drpAssignedWorker'];
	$houseOwnerRemark = $_POST['houseOwnerRemark'];
	$adminRemark = $_POST['adminRemark'];
	$time  = date('Y-m-d H:i:s');
	$defaultUserDetailsId = 1;
	if(isset($_SESSION['USERID']))
	{
		$defaultUserDetailsId = $_SESSION['USERID'];
	}


	//Dtabase Connection
	$con = new mysqli('localhost', 'root', '', 'gms_test');

		//user_details insertion
	$stmt = '';
	if( isset($_GET['REQID']) && $_GET['REQID'] != "")
	{
		$stmt = $con->prepare("UPDATE request SET request.garbageTypeId = ?,request.assignedWorkerId = ?,request.statusId = ?,request.requesterRemark = ?,request.adminRemark = ? WHERE request.requestId = ?");
		$stmt->bind_param("iiissi",  $garbageType, $drpAssignedWorker, $drpRequestStatus, $houseOwnerRemark, $adminRemark,   $_SESSION['REQID'], );
	}
	else
	{

		$stmt = $con->prepare("insert into request(adminRemark, assignedWorkerId, createdDateTime, garbageTypeId, requesterRemark, statusId,  updatedDateTime, userDetailsId ) values (?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sisisisi", $adminRemark, $drpAssignedWorker, $time, $garbageType, $houseOwnerRemark, $drpRequestStatus, $time, 
			$_SESSION['USERID'] );
	}
	$stmt->execute();

	$stmt->close();
	$con->close();

	echo "<script>alert('Collection request created successfully !');</script>";
	echo "<script> location.href='http://localhost/GMS/ViewRequests.php'; </script>";
	exit;


}
?>


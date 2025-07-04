<?php
include_once('Header.php'); //used to embed php code from another file
$con = new mysqli('localhost', 'root', '', 'gms_test');
if(isset($_GET['DELREQID']) && $_GET['DELREQID'] != "")
{
	$stmt = $con->prepare("UPDATE complaints SET complaints.isDeleted = 1 WHERE complaints.complaintId = ?");
	$stmt->bind_param("i",  $_GET['DELREQID']);
	$stmt->execute();
	$stmt->close();
	$con->close();

	echo "<script>alert('Complaint deleted successfully !');</script>";
	echo "<script> location.href='http://localhost/GMS/ViewComplaints.php'; </script>";
	exit;
}
if( isset($_GET['REQID']) && $_GET['REQID'] != "")
{
	$_SESSION['REQID'] = $_GET['REQID'];
}
else
{
	$_SESSION['REQID'] = "";
}

$cDetails = null;
$rRemark = null;
$aRemark = null;
$userDetailsId = null;
if(isset($_SESSION['REQID']))
{

	
	$stmt = $con->prepare("SELECT complaints.complaintDetails, complaints.requesterRemark, complaints.adminRemark, complaints.userDetailsId FROM complaints  WHERE complaints.complaintId = ?");
	$stmt->bind_param("i",$_SESSION['REQID']);
	$stmt->execute();
	$stmt_result = $stmt->get_result();
	$value = $stmt_result->fetch_object();
	if (isset($value) ) 
	{
		$cDetails = $value->complaintDetails;
		$rRemark = $value->requesterRemark;
		$aRemark = $value->adminRemark;
		$userDetailsId = $value->userDetailsId;
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
	<h2>Create/Edit Complaints</h2>
</div>   

<form class="form-inline" method="post">

	<table>

		<tr style="padding-top:10px">
			<td> <label>Complaint:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter complaint details"  name="complaintDetails"
					value=" <?php if(!is_null($cDetails)) { echo $cDetails; } ?> ">
				</div>
			</td>
		</tr>

		<tr style="padding-top:10px">
			<td> <label>User remark:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter user remark"  name="userRemark"
					value=" <?php if(!is_null($rRemark)) { echo $rRemark; } ?> ">
				</div>
			</td>
		</tr>

		<tr style="padding-top:10px">
			<td> <label>Admin remark:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter admin remark"  name="adminRemark"
					value=" <?php if(!is_null($aRemark)) { echo $aRemark; } ?> ">
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
	SaveComplaints();
}

function SaveComplaints()
{
	$complaintDetails = $_POST['complaintDetails'];
	$userRemark = $_POST['userRemark'];
	$adminRemark = $_POST['adminRemark'];
	$defaultComplaintStatus = 1;
	$defaultUserDetailsId = 1;

	if(isset($_SESSION['USERID']))
	{
		$defaultUserDetailsId = $_SESSION['USERID'];
	}

	$time  = date('Y-m-d H:i:s');

//Dtabase Connection
	$con = new mysqli('localhost', 'root', '', 'gms_test');
	//complaints insertion
	
	if(isset($_SESSION['REQID']) && $_SESSION['REQID'] != '')
	{
		$stmt = $con->prepare("UPDATE complaints SET complaints.complaintDetails = ?,complaints.requesterRemark = ?,complaints.adminRemark = ? WHERE complaints.complaintId = ?");
		$stmt->bind_param("sssi",  $complaintDetails, $userRemark, $adminRemark, $_SESSION['REQID']);
	}
	else{
		//echo 'inside insert';
		$stmt = $con->prepare("insert into complaints(complaintStatusId, complaintDetails, requesterRemark, adminRemark, userDetailsId, createdDateTime, updatedDateTime) values (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("isssiss", $defaultComplaintStatus, $complaintDetails, $userRemark, $adminRemark, $defaultUserDetailsId, $time, $time);
	}
	$stmt->execute();

	$stmt->close();
	$con->close();

	echo "<script>alert('Complaint submitted successfully !');</script>";
	echo "<script> location.href='http://localhost/GMS/ViewComplaints.php'; </script>";
	exit;


}


?>
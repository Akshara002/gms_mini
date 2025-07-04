<?php
include_once('Header.php');
$con = new mysqli('localhost', 'root', '', 'gms_test');
if(isset($_GET['DELREQID']) && $_GET['DELREQID'] != "")
{
	$stmt = $con->prepare("UPDATE payment_details SET payment_details.isDeleted = 1 WHERE payment_details.paymentDetailsId = ?");
	$stmt->bind_param("i",  $_GET['DELREQID']);
	$stmt->execute();
	$stmt->close();
	$con->close();

	echo "<script>alert('Payment deleted successfully !');</script>";
	echo "<script> location.href='http://localhost/GMS/ViewPayments.php'; </script>";
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
$con = new mysqli('localhost', 'root', '', 'gms_test');
$pType = 1;
$user = null;
$pPeriod = null;
$pAmount = null;
if(isset($_SESSION['REQID']))
{
	
	$stmt = $con->prepare("SELECT payment_details.paymentDetailsId, payment_details.paymentTypeId, payment_details.userDetailsId,payment_details.amountPaid, payment_details.PaymentPeriod FROM payment_type INNER JOIN payment_details ON payment_details.paymentTypeId = payment_type.paymentTypeId INNER JOIN user_details ON user_details.userDetailsId = payment_details.userDetailsId WHERE payment_details.paymentDetailsId = ?");
	$stmt->bind_param("i", $_SESSION['REQID']);
	$stmt->execute();
	$stmt_result = $stmt->get_result();
	$value = $stmt_result->fetch_object();
	if (isset($value) ) 
	{
		$pType = $value->paymentTypeId;
		$user = $value->userDetailsId;
		$pPeriod = $value->PaymentPeriod;
		$pAmount = $value->amountPaid;

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
	<h2>Create/Edit Payment</h2>
</div> 

<form class="form-inline"  method="post">

	<table>

		<tr style="padding-top:15px">
			<td> <label>Payment Type:</label> </td>

			<td>
				<div class="form-group">
					<select style="width:450px" class="form-control" name="paymentType">
						<option <?= $pType == 1 ? ' selected="selected"' : '';?> value="1">Weekly</option>
						<option <?= $pType == 2 ? ' selected="selected"' : '';?> value="2">Monthly</option>
						<option <?= $pType == 3 ? ' selected="selected"' : '';?> value="3">Yearly</option>
					</select>
				</div>
			</td>
		</tr>

		<tr style="padding-top:15px">
			<td> <label>User</label> </td>
			<td>
				<div class="form-group">
					<select style="width:450px" class="form-control" name="user">
						<?php
						$con = new mysqli('localhost', 'root', '', 'gms_test');
						if($con->connect_error)
						{
							die('Connection failed :' . $con->connect_error);
						}
						else
						{
							$stmt = $con->prepare("SELECT user_details.userDetailsId, user_details.name FROM user_details;");
							$stmt->execute();
							$stmt_result = $stmt->get_result();
							while($row = $stmt_result->fetch_assoc()) 
							{
								?>
								<option 
								<?= $user == $row["userDetailsId"] ? ' selected="selected"' : '';?>
								value="<?php echo $row["userDetailsId"]; ?>"><?php echo $row["name"]; ?></option>
								<?php

							}


						}
						?>
					</select>
				</div>
			</td>
		</tr>

		<tr style="padding-top:15px">
			<td> <label>Payment Period:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter payment period"  name="paymentPeriod"
					value=" <?php if(!is_null($pPeriod)) { echo $pPeriod; } ?> ">
				</div>
			</td>
		</tr>

		<tr style="padding-top:10px">
			<td> <label>Amount Paid:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter amount paid"  name="amountPaid"
					value=" <?php if(!is_null($pAmount)) { echo $pAmount; } ?> ">
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
	SavePayment();
}

function SavePayment()
{
	$paymentType = $_POST['paymentType'];
	$user = $_POST['user'];
	$paymentPeriod = $_POST['paymentPeriod'];
	$amountPaid = $_POST['amountPaid'];
	$time  = date('Y-m-d H:i:s');

//Dtabase Connection
	$con = new mysqli('localhost', 'root', '', 'gms_test');

	if(isset($_SESSION['REQID']) && $_SESSION['REQID'] != "")
	{
		//echo 'inside update';
		$stmt = $con->prepare("UPDATE payment_details SET payment_details.paymentTypeId = ?,payment_details.userDetailsId = ?,payment_details.paymentPeriod = ?,payment_details.amountPaid = ? WHERE payment_details.paymentDetailsId = ?");
		$stmt->bind_param("iissi",  $paymentType, $user, $paymentPeriod, $amountPaid,   $_SESSION['REQID'], );
	}
	else
	{
		//echo 'inside insert';
		$stmt = $con->prepare("insert into payment_details(paymentTypeId, userDetailsId, paymentPeriod, amountPaid, createdDateTime, updatedDateTime) 
			values (?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("iisdss", $paymentType, $user, $paymentPeriod, $amountPaid, $time, $time);
	}

	$stmt->execute();

	$stmt->close();
	$con->close();

	echo "<script>alert('Payment created successfully !');</script>";
	echo "<script> location.href='http://localhost/GMS/ViewPayments.php'; </script>";
	exit;

}
?>
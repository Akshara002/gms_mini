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
			<td><h2 class="adjustloc">View Payments</h2></td>
			<td><button type="button" class="btn btn-info"  onClick="window.print()"> <span class="glyphicon glyphicon-print"></span>  Save as pdf </button></td>
		</tr>
	</table>
	
	
</div> 



<table class="table table-hover table-bordered adjustloctable">
	<thead>
		<tr>
			<th>Payment Type</th>
			<th>User</th>
			<th>UserId</th>
			<th>Amount Paid</th>
			<th>Payment Period</th>
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
				$stmt = $con->prepare("SELECT payment_details.paymentDetailsId, payment_type.paymentType, user_details.name,user_details.userDetailsId, payment_details.amountPaid, payment_details.PaymentPeriod FROM payment_type INNER JOIN payment_details ON payment_details.paymentTypeId = payment_type.paymentTypeId INNER JOIN user_details ON user_details.userDetailsId = payment_details.userDetailsId WHERE payment_details.isDeleted = 0");
			}
			else
			{
				$stmt = $con->prepare("SELECT payment_details.paymentDetailsId, payment_type.paymentType, user_details.name,user_details.userDetailsId, payment_details.amountPaid, payment_details.PaymentPeriod FROM payment_type INNER JOIN payment_details ON payment_details.paymentTypeId = payment_type.paymentTypeId INNER JOIN user_details ON user_details.userDetailsId = payment_details.userDetailsId WHERE payment_details.userDetailsId = ? AND  payment_details.isDeleted = 0");
				$stmt->bind_param("i", $_SESSION['USERID']);

			}

			$stmt->execute();
			$stmt_result = $stmt->get_result();
			while($row = $stmt_result->fetch_assoc()) 
			{
				?>
				<tr>
					<td style="display:none;" ><?php echo $row["paymentDetailsId"]; ?></td>
					<td><?php echo $row["paymentType"]; ?></td>
					<td><?php echo $row["name"]; ?></td>
					<td><?php echo $row["userDetailsId"]; ?></td>
					<td><?php echo $row["amountPaid"]; ?></td>
					<td><?php echo $row["PaymentPeriod"]; ?></td>
					<?php if(isset($_SESSION['USERTYPEID']) and $_SESSION['USERTYPEID'] == 1) { ?>
						<td><a class="btn btn-info" id="edit" href='Payment.php?REQID=<?php echo $row["paymentDetailsId"]; ?>'>Edit</a></td>
						
						<td><a  class="btn btn-info" id="delete" href='Payment.php?DELREQID=<?php echo $row["paymentDetailsId"]; ?>'>Delete</a></td>
					<?php } ?>
				</tr>
				<?php
			}

		}
		?>
	</tbody>
</table>





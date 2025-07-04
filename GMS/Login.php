<?php
include_once('Header.php');
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
	<h2>Login</h2>
</div>  

<form class="form-inline"  method="post">

	<table>
		<tr style="padding-top:10px">
			<td>
				<label>Email:</label>
			</td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="email" class="form-control" id="email" placeholder="Enter email"  name="email">
				</div>
			</td>
		</tr>
		<tr style="margin-top:10px">
			<td>
				<label>Password:</label>
			</td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="password" class="form-control" id="password" placeholder="Enter password"  name="password">
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>
			</td>
		</tr>
	</table>
	




	<?php

	if(array_key_exists('btnSubmit', $_POST)) {
		Login();
	}

	
	function Login()
	{
		$email = $_POST['email'];
		$password = $_POST['password'];

//Dtabase Connection
		$con = new mysqli('localhost', 'root', '', 'gms_test');
		if($con->connect_error)
		{
			die('Connection failed :' . $con->connect_error);
		}
		else
		{

			$stmt = $con->prepare("SELECT user_details.userDetailsId, user_details.userTypeId FROM user_details INNER JOIN user_access ON user_details.userDetailsId =user_access.userDetailsId WHERE  user_access.username = ? AND  user_access.password = ?");
			$stmt->bind_param("ss", $email, $password);
			$stmt->execute();
			$stmt_result = $stmt->get_result();
			$value = $stmt_result->fetch_object();
			if ( is_null($value) || $value->userDetailsId == 0) 
			{
				echo "<script>alert('Incorrect username or password !');</script>";
			} 
			else 
			{
			// Start the session
				session_start();
			// Set session variables
				$_SESSION["USERID"] = $value->userDetailsId;
				$_SESSION["USERTYPEID"] = $value->userTypeId;
				echo "<script> location.href='http://localhost/GMS/Home.php'; </script>";
				exit;
			}
			
			$stmt->close();
			$con->close();
		}
	}

?>
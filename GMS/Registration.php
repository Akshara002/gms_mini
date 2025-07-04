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
	<h2>Registration</h2>
</div> 

<form class="form-inline"  method="post">

	<table>

		<tr style="padding-top:10px">
			<td> <label>User Type:</label> </td>
			<td>
				<div class="form-group">
					<select style="width:450px" class="form-control" name="userType">
						<option value="2">House Owner</option>
						<option value="3">Worker</option>
					</select>
				</div>
			</td>
		</tr>

		<tr style="padding-top:10px">
			<td> <label>Name</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter Name"  name="name">
				</div>
			</td>
		</tr>

		<tr style="padding-top:10px">
			<td> <label>Date Of Birth:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter date of bith in dd/mm/yyyy format"  name="dob">
				</div>
			</td>
		</tr>

		<tr style="padding-top:10px">
			<td> <label>Gender:</label> </td>
			<td>
				<div class="form-group">
					<label>Male </label>
					<input type="radio"  name="rbtnGender" value="male" checked>
					<label>Female </label>
					<input type="radio"  name="rbtnGender" value="female">
				</div>
			</td>
		</tr>

		<tr style="padding-top:10px">
			<td> <label>AddressLine1:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter AddressLine1"  name="addressline1">
				</div>
			</td>
		</tr>
		<tr style="padding-top:10px">
			<td> <label>AddressLine2:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter AddressLine2"  name="addressline2">
				</div>
			</td>
		</tr>
		<tr style="padding-top:10px">
			<td> <label>Street:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter Street"  name="street">
				</div>
			</td>
		</tr>
		<tr style="padding-top:10px">
			<td> <label>City:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter City"  name="city">
				</div>
			</td>
		</tr>
		<tr style="padding-top:10px">
			<td> <label>District:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter District"  name="district">
				</div>
			</td>
		</tr>
		<tr style="padding-top:10px">
			<td> <label>State:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter State"  name="state">
				</div>
			</td>
		</tr>
		<tr style="padding-top:10px">
			<td> <label>Country:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter Country"  name="country">
				</div>
			</td>
		</tr>
		<tr style="padding-top:10px">
			<td> <label>Pincode:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter Pincode"  name="pincode">
				</div>
			</td>
		</tr>
		<tr style="padding-top:10px">
			<td> <label>Landmark:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter Landmark"  name="landmark">
				</div>
			</td>
		</tr>
		<tr style="padding-top:10px">
			<td> <label>Landline:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter Landline"  name="landline">
				</div>
			</td>
		</tr>
		<tr style="padding-top:10px">
			<td> <label>Mobile:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter Mobile"  name="mobile">
				</div>
			</td>
		</tr>

		<tr style="padding-top:10px">
			<td> <label>Email:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter email"  name="username">
				</div>
			</td>
		</tr>
		<tr style="padding-top:10px">
			<td> <label>Password:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="password" class="form-control" placeholder="Enter Password"  name="password">
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
	Register();
}


function Register()
{
	$usertype = $_POST['userType'];
	$name = $_POST['name'];
	$dob = $_POST['dob'];
	$gender = $_POST['rbtnGender'];
	$addr1 = $_POST['addressline1'];
	$addr2 = $_POST['addressline2'];
	$street = $_POST['street'];
	$city = $_POST['city'];
	$district = $_POST['district'];
	$state = $_POST['state'];
	$country = $_POST['country'];
	$pincode = $_POST['pincode'];
	$landmark = $_POST['landmark'];
	$landline = $_POST['landline'];
	$mobile = $_POST['mobile'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$time  = date('Y-m-d H:i:s');

//Dtabase Connection
	$con = new mysqli('localhost', 'root', '', 'gms_test');
	if($con->connect_error)
	{
		die('Connection failed :' . $con->connect_error);
	}
	else
	{
	//Checking username & password already exists or not
		$stmt = $con->prepare("SELECT user_access.userDetailsId FROM user_access WHERE user_access.username = ? and user_access.password = ?");
		$stmt->bind_param("ss", $username, $password);
		$stmt->execute();
		$stmt_result = $stmt->get_result();
		$value = $stmt_result->fetch_object();
		if ( !is_null($value) || $value->userDetailsId != 0) 
		{
			echo "<script>alert('Emai / Username already exist !');</script>";
			echo "<script> location.href='http://localhost/GMS/Registration.php'; </script>";
			exit;
		} 
		else 
		{
			//user_details insertion
			$stmt = $con->prepare("insert into user_details(userTypeId, name, dob, gender, addressline1, addressline22, street, city, district, state, country, pincode, landmark, landlineNo, mobile, createdDateTime, updatedDateTime) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("issssssssssssssss", $usertype, $name, $dob, $gender, $addr1, $addr2, $street, $city, $district, $state, $country, $pincode, $landmark, $landline,$mobile, $time, $time);
			$stmt->execute();

			
			
	//userDetailsId fetch from user_access
			$stmt = $con->prepare("select userDetailsId from user_details where name = ? and mobile = ?");
			$stmt->bind_param("ss", $name, $mobile);
			$stmt->execute();
			$stmt_result = $stmt->get_result();
			$value = $stmt_result->fetch_object();





	//user_access insertion
			$stmt = $con->prepare("insert into user_access(username, password, userDetailsId, createdDateTime, updatedDateTime) values (?, ?, ?, ?, ?)");
			$stmt->bind_param("ssiss", $username, $password, $value->userDetailsId, $time, $time);
			$stmt->execute();
			
			


			$stmt->close();
			$con->close();
			echo "<script>alert('User registration successfull !');</script>";
			echo "<script> location.href='http://localhost/GMS/Home.php'; </script>";
			exit;

		}





	}

}
?>
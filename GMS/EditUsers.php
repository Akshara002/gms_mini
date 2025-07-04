<?php
include_once('Header.php');

$con = new mysqli('localhost', 'root', '', 'gms_test');
if(isset($_GET['DELREQID']) && $_GET['DELREQID'] != "")
{
	$stmt = $con->prepare("UPDATE user_details SET user_details.isDeleted = 1 WHERE user_details.userDetailsId = ?");
	$stmt->bind_param("i",  $_GET['DELREQID']);
	$stmt->execute();
	$stmt->close();
	$con->close();

	echo "<script>alert('User deleted successfully !');</script>";
	echo "<script> location.href='http://localhost/GMS/Home.php'; </script>";
	exit;
}


$userTypeId = '';
$name = '';
$dob = '';
$gender = '';
$addressline1 = '';
$addressline22 = ''; 
$street = ''; 
$district = '';
$city = ''; 
$state = ''; 
$country = ''; 
$pincode = '';
$mobile = ''; 
$landmark = ''; 
$landlineNo = '';

if( isset($_GET['REQID']) && $_GET['REQID'] != "")
{
	$_SESSION['REQID'] = $_GET['REQID'];
}
else
{
	$_SESSION['REQID'] = "";
}

$con = new mysqli('localhost', 'root', '', 'gms_test');
if(isset($_SESSION['REQID']))
{
	$con = new mysqli('localhost', 'root', '', 'gms_test');
	if($con->connect_error)
	{
		die('Connection failed :' . $con->connect_error);
	}
	else
	{
		$stmt = $con->prepare("SELECT userTypeId, name, dob, gender, addressline1, addressline22, street, district, city, state, country, pincode, mobile, landmark, landlineNo FROM user_details WHERE userDetailsId = ?");
		$stmt->bind_param("i",$_SESSION['REQID']);
		$stmt->execute();
		$stmt_result = $stmt->get_result();
		$value = $stmt_result->fetch_object();
		if (!is_null($value)) 
		{
			$userTypeId = $value->userTypeId;
			$name = $value->name;
			$dob = $value->dob;
			$gender = $value->gender;
			$addressline1 = $value->addressline1;
			$addressline22 = $value->addressline22;
			$street = $value->street; 
			$district = $value->district;
			$city = $value->city;
			$state = $value->state;
			$country = $value->country;
			$pincode = $value->pincode;
			$mobile = $value->mobile;
			$landmark = $value->landmark;
			$landlineNo = $value->landlineNo;	
		}
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
	<h2>Edit Users</h2>
</div>   



<form class="form-inline"  method="post">

	<table>

		<tr style="padding-top:10px">
			<td> <label>User Type:</label> </td>
			<td>
				<div class="form-group">
					<select style="width:450px" class="form-control" name="userType">
						<option <?= $userTypeId == 2 ? ' selected="selected"' : '';?> value="2">House Owner</option>
						<option <?= $userTypeId == 3 ? ' selected="selected"' : '';?> value="3">Worker</option>
					</select>
				</div>
			</td>
		</tr>

		<tr style="padding-top:10px">
			<td> <label>Name:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter Name"  name="name"
					value=" <?php if(!is_null($name)) { echo $name; } ?> ">
				</div>
			</td>
		</tr>

		<tr style="padding-top:10px">
			<td> <label>Date Of Birth:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter date of bith in dd/mm/yyyy format"  name="dob"
					value=" <?php if(!is_null($dob)) { echo $dob; } ?> ">
				</div>
			</td>
		</tr>

		<tr style="padding-top:10px">
			<td> <label>Gender:</label> </td>
			<td>
				<div class="form-group">
					<label>Male </label>
					<input type="radio"  name="rbtnGender" value="male" <?= $gender == 'male' ? ' checked="checked"' : '';?>>
					<label>Female </label>
					<input type="radio"  name="rbtnGender" value="female" <?= $gender == 'female' ? ' checked="checked"' : '';?>>
				</div>
			</td>
		</tr>

		<tr style="padding-top:10px">
			<td> <label>AddressLine1:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter AddressLine1"  name="addressline1"
					value=" <?php if(!is_null($addressline1)) { echo $addressline1; } ?> ">
				</div>
			</td>
		</tr>
		<tr style="padding-top:10px">
			<td> <label>AddressLine2:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter AddressLine2"  name="addressline2"
					value=" <?php if(!is_null($addressline22)) { echo $addressline22; } ?> ">
				</div>
			</td>
		</tr>
		<tr style="padding-top:10px">
			<td> <label>Street:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter Street"  name="street"
					value=" <?php if(!is_null($street)) { echo $street; } ?> ">
				</div>
			</td>
		</tr>
		<tr style="padding-top:10px">
			<td> <label>City:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter City"  name="city"
					value=" <?php if(!is_null($city)) { echo $city; } ?> ">
				</div>
			</td>
		</tr>
		<tr style="padding-top:10px">
			<td> <label>District:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter District"  name="district"
					value=" <?php if(!is_null($district)) { echo $district; } ?> ">
				</div>
			</td>
		</tr>
		<tr style="padding-top:10px">
			<td> <label>State:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter State"  name="state"
					value=" <?php if(!is_null($state)) { echo $state; } ?> ">
				</div>
			</td>
		</tr>
		<tr style="padding-top:10px">
			<td> <label>Country:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter Country"  name="country"
					value=" <?php if(!is_null($country)) { echo $country; } ?> ">
				</div>
			</td>
		</tr>
		<tr style="padding-top:10px">
			<td> <label>Pincode:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter Pincode"  name="pincode"
					value=" <?php if(!is_null($pincode)) { echo $pincode; } ?> ">
				</div>
			</td>
		</tr>
		<tr style="padding-top:10px">
			<td> <label>Landmark:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter Landmark"  name="landmark"
					value=" <?php if(!is_null($landmark)) { echo $landmark; } ?> ">
				</div>
			</td>
		</tr>
		<tr style="padding-top:10px">
			<td> <label>Landline:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter Landline"  name="landline"
					value=" <?php if(!is_null($landlineNo)) { echo $landlineNo; } ?> ">
				</div>
			</td>
		</tr>
		<tr style="padding-top:10px">
			<td> <label>Mobile:</label> </td>
			<td>
				<div class="form-group">
					<input style="width:450px" type="text" class="form-control" placeholder="Enter Mobile"  name="mobile"
					value=" <?php if(!is_null($mobile)) { echo $mobile; } ?> ">
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
	$time  = date('Y-m-d H:i:s');

//Dtabase Connection
	$con = new mysqli('localhost', 'root', '', 'gms_test');
	if($con->connect_error)
	{
		die('Connection failed :' . $con->connect_error);
	}
	else
	{
	//user_details insertion
		$stmt = $con->prepare("UPDATE user_details SET user_details.userTypeId = ?, user_details.name = ?, user_details.dob = ?, user_details.gender = ?, user_details.addressline1 = ?, user_details.addressline22 = ?, user_details.street = ?, user_details.city = ?, user_details.district = ?, user_details.state = ?, user_details.country = ?, user_details.pincode = ?, user_details.landmark = ?, user_details.landlineNo = ?, user_details.mobile = ? WHERE user_details.userDetailsId = ?");
		$stmt->bind_param("issssssssssssssi", $usertype, $name, $dob, $gender, $addr1, $addr2, $street, $city, $district, $state, $country, $pincode, $landmark, $landline,$mobile, $_SESSION['REQID']);
		$stmt->execute();

		$stmt->close();
		$con->close();
		echo "<script>alert('User edited successfull !');</script>";
		echo "<script> location.href='http://localhost/GMS/Home.php'; </script>";
		exit;

	}

}
?>
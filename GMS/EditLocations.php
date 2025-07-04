<?php
include_once('Header.php');

$con = new mysqli('localhost', 'root', '', 'gms_test');
if(isset($_GET['DELREQID']) && $_GET['DELREQID'] != "")
{
	$stmt = $con->prepare("UPDATE locations SET locations.isDeleted = 1 WHERE locations.locationId = ?");
	$stmt->bind_param("i",  $_GET['DELREQID']);
	$stmt->execute();
	$stmt->close();
	$con->close();

	echo "<script>alert('Location deleted successfully !');</script>";
	echo "<script> location.href='http://localhost/GMS/ViewLocations.php'; </script>";
	exit;
}

$street = '';
$city = '';
$district = '';
$state = '';
$country = '';

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

	$stmt = $con->prepare("SELECT locationId,street, city, district, state, country FROM locations WHERE locationId = ? ");
	$stmt->bind_param("i",$_SESSION['REQID']);
	$stmt->execute();
	$stmt_result = $stmt->get_result();
	$value = $stmt_result->fetch_object();
	if (!is_null($value)) 
	{
		$street = $value->street;
		$city = $value->city;
		$district = $value->district;
		$state = $value->state;
		$country = $value->country;
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
</head>
<body>


	<div class="page-header">
		<h2>Create Location</h2>
	</div>   


	<form class="form-inline" method="post">

		<table>


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


			<tr>
				<td>
					<button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>
				</td>
			</tr>
		</table>
	</form>



	<?php

	if(array_key_exists('btnSubmit', $_POST)) {
		SaveLocations();
	}

	function SaveLocations()
	{
		$street = $_POST['street'];
		$city = $_POST['city'];
		$district = $_POST['district'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$time  = date('Y-m-d H:i:s');

//Dtabase Connection
		$con = new mysqli('localhost', 'root', '', 'gms_test');
		if($con->connect_error)
		{
			die('Connection failed :' . $con->connect_error);
		}
		else
		{
	//locations insertion
			$stmt = $con->prepare("UPDATE locations SET locations.street = ?, locations.city = ?, locations.district = ?, locations.state = ?, locations.country = ? WHERE locations.locationId = ?");
			$stmt->bind_param("sssssi", $street, $city, $district, $state, $country, $_SESSION['REQID']);
			$stmt->execute();

			$stmt->close();
			$con->close();

			echo "<script>alert('Location updated successfull !');</script>";
			echo "<script> location.href='http://localhost/GMS/ViewLocations.php'; </script>";
			exit;

		}
	}

?>
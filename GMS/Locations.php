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
			$stmt = $con->prepare("insert into locations(street, city, district, state, country, createdDateTime, updatedDateTime) values (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("sssssss", $street, $city, $district, $state, $country, $time, $time);
			$stmt->execute();

			$stmt->close();
			$con->close();

			echo "<script>alert('Location saved successfull !');</script>";
			echo "<script> location.href='http://localhost/GMS/ViewLocations.php'; </script>";
			exit;

		}
	}

?>
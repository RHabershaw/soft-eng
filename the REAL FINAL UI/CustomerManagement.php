<!DOCTYPE html>
<html>
<head>
  <style>
  .center {
      text-align: center;
  }
  .left{
    text-align: left;
  }
  h1 {
    padding-left: 35px;
  }
  h3 {
    color: black;
    padding-left: 15px;
  }
  .divtable {
    padding-right: 100px;
    padding-top: 45px;
  }
  html {
    background: url(Wims2.png) no-repeat center fixed;
    background-size: cover;
  }

  body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    color: white;
  }

  .topnavigation {
    overflow: hidden;
    background-color: black;
    color: white;
  }

  .topnavigation a {
    float: left;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
  }

  .topnavigation a:hover {
    background-color: #F43386;
    color: white;
  }

  .topnavigation a.active {
    background-color: #404F6B;
    color: white;
  }

				table {
					font-family: arial, sans-serif;
					border-collapse: collapse;
					width: auto;
					float: right;
					margin: -560px 0px;
          color: black;
				}

				thead, tbody, tr, td, th { display: block; }

				thead th {
					height: 20px;
					text-align: center;
				    background: #F43386;
					color: white;
				}

				tbody {
					height:400px;
					text-align: center;
					background: rgba(255,255,255,0.1);;
					overflow-y: scroll;
					white-space: nowrap;
				}

				td, th {
					border: 1px solid #dddddd;
					padding: 4px;
					float: left;
				}

				tr:after {
					content: '';
					display: block;
					visibility: hidden;
					clear: both;
				}

				tr{
					background-color: white;
				}

				.divtable {
					padding-right: 15px;
					padding-top: 45px;
				}

				table.divtable tr:hover {
					background-color: #grey;
				}

				tr:hover {
					background-color: #D3D3D3;
				}

  .dropbutton {
    background-color: #FFFF00;
    color: black;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}

</style>
<title>Customer Management</title>
</head>
<body>
  <div class="topnavigation">
  <a href="index.php">Log Out</a>

<?php
	session_start();

	$mySec = $_SESSION['secLevel'];

	if($mySec == 'Administrator' || $mySec == 'Owner'){
		echo "<a href='OrderEntry.php'>Order Entry</a>";
		echo "<a href='ProductSearch.php'>Product Search</a>";
		echo "<a href='InventoryManagement.php'>Inventory Management</a>";
		echo "<a class='active' href='CustomerManagement.php'>Customer Management</a>";
		echo "<a href='UserManagement.php'>User Management</a>";
	}
	elseif($mySec == 'Salesperson'){
		echo "<a href='OrderEntry.php'>Order Entry</a>";
		echo "<a href='ProductSearch.php'>Product Search</a>";
		echo "<a class='active' href='CustomerManagement.php'>Customer Management</a>";
		echo "<a href='UserManagement.php'>User Management</a>";
	}
?>
</div>

<?php
$db = mysqli_connect('localhost:8889', 'root', 'root', 'wims')or die('Error connecting to MySQL server');

$CustID = '';
$Fname = '';
$Minit = '';
$Lname = '';
$CompName = '';
$Street = '';
$Town = '';
$State = '';
$Zip = '';
$Phone = '';
$Email = '';

$editActive = 0;
$error = 0;

if(!isset($_SESSION['editSubmit']))
{
    $_SESSION['editSubmit'] = 0;
}

if(!isset($_SESSION['CustID']))
{
    $_SESSION['CustID'] = -1;
}

if(isset($_POST['edit'])){
	$editActive = 1;
	$_SESSION['editSubmit'] = 1;
	if(isset($_POST['formCheck'])){
		$aRecord = $_POST['formCheck'];
		if(empty($aRecord)){
			echo("You didn't select any user.");
		}
		else{
			$N = count($aRecord);

			if($N == 1){
				$edit = "SELECT * FROM customers WHERE CustID = '$aRecord[0]'";

				mysqli_query($db, $edit) or die('Error querying database.');
				$result = mysqli_query($db, $edit);

				$row = mysqli_fetch_array($result);
				$_SESSION['CustID'] = $row['CustID'];
				$CustID = $_SESSION['CustID'];
				$Fname = $row['Fname'];
				$Minit = $row['Minitial'];
				$Lname = $row['Lname'];
				$CompName = $row['CompanyName'];
				$Street = $row['AddStreet'];
				$Town = $row['AddTown'];
				$State = $row['AddState'];
				$Zip = $row['AddZip'];
				$Phone = $row['PhoneNum'];
				$Email = $row['Email'];


			}
			else{
				$_SESSION['editSubmit'] = 0;
				$error = 1;
			}
		}
	}
	else{
		$_SESSION['editSubmit'] = 0;
		$error = 2;
	}
}

?>

<div class="left">
  <h1>Customer Management</h1>
<section>
  <h1>Add</h1>
  <ul>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      First Name:<br>
	  <input type="text" name="fname" size="14" value= "<?php echo $Fname;?>">
      <br>
      Middle Initial:<br>
      <input type="text" name="minit" size="14" value= "<?php echo $Minit; ?>">
      <br>
	  Last Name:<br>
      <input type="text" name="lname" size="14" value= "<?php echo $Lname;?>">
      <br>
	  Company Name:<br>
	  <input type="text" name="cname" size="14" value= "<?php echo $CompName;?>">
      <br>
      Street:<br>
      <input type="text" name="addstreet" size="14" value= "<?php echo $Street;?>">
      <br>
      Town:<br>
      <input type="text" name="addtown" size="14" value= "<?php echo $Town;?>">
      <br>
      State:<br>
      <input type="text" name="addstate" size="14" value= "<?php echo $State;?>">
      <br>
      Zip Code:<br>
      <input type="text" name="addzip" size="14" value= "<?php echo $Zip;?>">
      <br>
      Phone #:<br>
      <input type="text" name="phonenum" size="14" value= "<?php echo $Phone;?>">
      <br>
      Email:<br>
      <input type="text" name="email" size="14" value= "<?php echo $Email;?>">
      <br>
	  <br><br>
	<input type="submit" name="add" value="Submit"/>
  </br>
<br>

</div>
</section>

		<div class="divtable">
			<table>
			<?php
				$rownumber = 0;

				$myuser = $_SESSION['user'];
				$mysec = $_SESSION['secLevel'];
				$myID = $_SESSION['myID'];

				$query = "SELECT * FROM customers";

				if(count($_POST) == 0){
					updateTable($query);
				}

				function generateRandomString($length = 5) {
					$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$charactersLength = strlen($characters);
					$randomString = '';
					for ($i = 0; $i < $length; $i++) {
					$randomString .= $characters[rand(0, $charactersLength - 1)];
					}
					return strtoupper($randomString);
				}
				//$randID = generateRandomString();


				function updateTable($qry, $active=0){
					mysqli_query($GLOBALS['db'], $qry) or die('Error querying database.');

					$result = mysqli_query($GLOBALS['db'], $qry);
					echo "<thead>";
					echo "<tr>";
					echo "<th style='overflow:hidden;width:60px;'>CustID</th>";
					echo "<th style='overflow:hidden;width:100px;'>First Name</th>";
					echo "<th style='overflow:hidden;width:25px;'>M.I.</th>";
					echo "<th style='overflow:hidden;width:100px;'>Last Name</th>";
					echo "<th style='overflow:hidden;width:120px;'>Company</th>";
					echo "<th style='overflow:hidden;width:200px;'>Street</th>";
					echo "<th style='overflow:hidden;width:120px;'>Town</th>";
					echo "<th style='overflow:hidden;width:40px;'>State</th>";
					echo "<th style='overflow:hidden;width:50px;'>Zip</th>";
					echo "<th style='overflow:hidden;width:105px;'>Phone#</th>";
					echo "<th style='overflow:hidden;width:150px;'>Email</th>";
					echo "<th style='overflow:hidden;width:62px;'>Select</th>";
					echo "</tr>";
					echo "</thead>";


					echo"<tbody>";
					while ($row = mysqli_fetch_array($result)) {
						echo "<tr>";
						echo "<td style='overflow:hidden;width:60px;'>" . $row['CustID'] . "</td>";

						if($row['Fname']!= ''){
							echo "<td style='overflow:hidden;width:100px;'>" . $row['Fname'] . "</td>";
						}
						else{
							echo "<td style='overflow:hidden;width:100px;'>&nbsp</td>";
						}

						if($row['Minitial']!= ''){
							echo "<td style='overflow:hidden;width:25px;'>" . $row['Minitial'] . "</td>";
						}
						else{
							echo "<td style='overflow:hidden;width:25px;'>&nbsp</td>";
						}

						if($row['Lname']!= ''){
							echo "<td style='overflow:hidden;width:100px;'>" . $row['Lname'] . "</td>";
						}
						else{
							echo "<td style='overflow:hidden;width:100px;'>&nbsp</td>";
						}

						if($row['CompanyName']!= ''){
							echo "<td style='overflow:hidden;width:120px;'>" . $row['CompanyName'] . "</td>";
						}
						else{
							echo "<td style='overflow:hidden;width:120px;'>&nbsp</td>";
						}

						if($row['AddStreet']!= ''){
							echo "<td style='overflow:hidden;width:200px;'>" . $row['AddStreet'] . "</td>";
						}
						else{
							echo "<td style='overflow:hidden;width:200px;'>&nbsp</td>";
						}

						if($row['AddTown']!= ''){
							echo "<td style='overflow:hidden;width:120px;'>" . $row['AddTown'] . "</td>";
						}
						else{
							echo "<td style='overflow:hidden;width:120px;'>&nbsp</td>";
						}

						if($row['AddState']!= ''){
							echo "<td style='overflow:hidden;width:40px;'>" . $row['AddState'] . "</td>";
						}
						else{
							echo "<td style='overflow:hidden;width:40px;'>&nbsp</td>";
						}

						if($row['AddZip']!= ''){
							echo "<td style='overflow:hidden;width:50px;'>" . $row['AddZip'] . "</td>";
						}
						else{
							echo "<td style='overflow:hidden;width:50px;'>&nbsp</td>";
						}

						if($row['PhoneNum']!= ''){
							echo "<td style='overflow:hidden;width:105px;'>" . $row['PhoneNum'] . "</td>";
						}
						else{
							echo "<td style='overflow:hidden;width:105px;'>&nbsp</td>";
						}

						if($row['Email']!= ''){
							echo "<td style='overflow:hidden;width:150px;'>" . $row['Email'] . "</td>";
						}
						else{
							echo "<td style='overflow:hidden;width:150px;'>&nbsp</td>";
						}


						if($active == 1){
							echo "<td style='overflow:hidden;width:40px;'><center><input type='checkbox' name='formCheck[]' value='" . $row['CustID'] . "' checked/></center></td>";
						}
						else{
							echo "<td style='overflow:hidden;width:45px;'><center><input type='checkbox' name='formCheck[]' value='" . $row['CustID'] . "'/></center></td>";
						}
						echo "</tr>";
						$GLOBALS['rownumber'] = $GLOBALS['rownumber'] + 1;
					}
					echo"</tbody>";
				}

				if(isset($_POST['add'])){
					$randID = generateRandomString();
					$Fname = $_POST['fname'];
					$Minit = $_POST['minit'];
					$Lname = $_POST['lname'];
					$CompName = $_POST['cname'];
					$Street = $_POST['addstreet'];
					$Town = $_POST['addtown'];
					$State = $_POST['addstate'];
					$Zip = $_POST['addzip'];
					$Phone = $_POST['phonenum'];
					$Email = $_POST['email'];

					if ($_SESSION['editSubmit'] == 1){
						//echo "EDIT ACTIVE ON SUBMIT!";
						$_SESSION['editSubmit'] = 0;
							$CustID = $_SESSION['CustID'];
							$updatecustomer = "UPDATE IGNORE customers SET Fname = '$Fname', Minitial = '$Minit', Lname = '$Lname', CompanyName = '$CompName', AddStreet = '$Street', AddTown = '$Town', AddState = '$State', AddZip = '$Zip', PhoneNum = '$Phone', Email = '$Email' WHERE CustID = '$CustID'";
							mysqli_query($db, $updatecustomer) or die('Error querying database.');

							updateTable($query);
					}
					else{
						//echo "EDIT INACTIVE ON SUBMIT!!!";

							$dupe = 0;

							while (!$dupe){
								$duplicate = "SELECT * FROM customers WHERE CustID = '$randID'";
								$result = mysqli_query($db, $duplicate) or die('Error querying database.');
								$noRows = mysqli_num_rows($result);

								if($noRows > 0){
									$randID = generateRandomString();
								}
								else{
									$dupe = 1;
								}
							}

							$CustID = $randID;

							$insertcustomer = "INSERT IGNORE INTO customers (CustID, Fname, Minitial, Lname, CompanyName, AddStreet, AddTown, AddState, AddZip, PhoneNum, Email)
								VALUES ('$CustID','$Fname','$Minit','$Lname','$CompName','$Street','$Town','$State','$Zip','$Phone','$Email')";
							mysqli_query($db, $insertcustomer) or die('Error querying database.');

							updateTable($query);
					}
				}

				if(($editActive == 1) && ($error == 0)){
					//echo "Edit is active";
					updateTable($edit, 1);
				}
				elseif(($editActive == 1) && ($error > 0)){
					updateTable($query);
				}
				else{
					$_SESSION['editSubmit'] = 0;
					$error = 0;
				}

				if($error == 1){
					echo("You can't edit more than 1 customer at a time");
				}
				elseif($error == 2){
					echo("You didn't select any customer.");
				}



				if(isset($_POST['delete'])){
					if(isset($_POST['formCheck'])){
						$aRecord = $_POST['formCheck'];
						if(empty($aRecord)){
							echo("You didn't select any customer.");
						}
						else{
							$N = count($aRecord);

							//echo("You selected $N user(s): ");

							for($i=0; $i < $N; $i++)
							{
								//echo($aRecord[$i] . " ");
								$delete = "DELETE FROM customers WHERE CustID = '$aRecord[$i]'";
								mysqli_query($db, $delete) or die('Error querying database.');
							}
							updateTable($query);
						}
					}
					else{
						echo("You didn't select any customer(s).");
						updateTable($query);
					}
				}

				mysqli_close($db);
			?>
			</table>
				<input type='submit' name='edit' value='Edit' style='color:#173365;; float: right; margin: -92px 700px;'/>
				<input type='submit' name='delete' value='Delete' style='color:#FF00C1;; float: right; margin: -92px 400px;'/>
			</form>
</body>
</html>

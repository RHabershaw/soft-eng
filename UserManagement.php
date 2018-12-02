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
					margin: -420px 0px;
          color: black;
				}

				thead, tbody, tr, td, th { display: block; }

				thead th {
					height: 20px;
					text-align: center;
				    background: #FF00C1;
					color: white;
				}

				tbody {
					height:400px;
					text-align: center;
					background: rgba(255,255,255,0.1);;
					overflow-y: scroll;
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
					padding-right: 100px;
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
<title>User Management</title>
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
		echo "<a href='CustomerManagement.php'>Customer Management</a>";
		echo "<a class='active' href='UserManagement.php'>User Management</a>";
	}
	elseif($mySec == 'Salesperson'){
		echo "<a href='OrderEntry.php'>Order Entry</a>";
		echo "<a href='ProductSearch.php'>Product Search</a>";
		echo "<a href='CustomerManagement.php'>Customer Management</a>";
		echo "<a class='active' href='UserManagement.php'>User Management</a>";
	}
	elseif($mySec == 'Manager'){
		echo "<a href='ProductSearch.php'>Product Search</a>";
		echo "<a href='InventoryManagement.php'>Inventory Management</a>";
		echo "<a class='active' href='UserManagement.php'>User Management</a>";
	}
?>
</div>

<?php
$db = mysqli_connect('localhost', 'root', '', 'wims')or die('Error connecting to MySQL server');

$Username = '';
$Password = '';
$Fname = '';
$Minit = '';
$Lname = '';
$Security = '';

$editActive = 0;
$error = 0;

if(!isset($_SESSION['editSubmit']))
{
    $_SESSION['editSubmit'] = 0;
}

if(!isset($_SESSION['UserID']))
{
    $_SESSION['UserID'] = -1;
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
				$edit = "SELECT * FROM users WHERE UserID = '$aRecord[0]'";

				mysqli_query($db, $edit) or die('Error querying database.');
				$result = mysqli_query($db, $edit);

				$row = mysqli_fetch_array($result);
				$_SESSION['UserID'] = $row['UserID'];
				$Username = $row['Username'];
				$Password = $row['EncryptedPass'];
				$Fname = $row['Fname'];
				$Minit = $row['Minitial'];
				$Lname = $row['Lname'];
				$Security = $row['Security'];

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
  <h1>User Management</h1>
<section>
  <h1>Add</h1>
  <ul>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      Username:<br>
	  <input type="text" name="uname" size="14" value= "<?php echo $Username;?>">
      <br>
      Password:<br>
      <input type="text" name="passwd" size="14" value= "<?php echo $Password; ?>">
      <br>
	  First Name:<br>
      <input type="text" name="fname" size="14" value= "<?php echo $Fname;?>">
      <br>
	  Middle Initial:<br>
	  <input type="text" name="minit" size="14" value= "<?php echo $Minit;?>">
      <br>
      Last Name:<br>
      <input type="text" name="lname" size="14" value= "<?php echo $Lname;?>">
      <br>
      Security Level:<br>
      <input type="text" list = "sectypes" name="security" size="14" value= "<?php echo $Security;?>">
	  <datalist id = "sectypes">
<?php
	if($mySec == 'Administrator' || $mySec == 'Owner'){
		echo "<option value = 'Administrator' />";
		echo "<option value = 'Owner' />";
		echo "<option value = 'Manager' />";
		echo "<option value = 'Salesperson' />";
		echo "<option value = 'Warehouse' />";
	}
	elseif($mySec == 'Salesperson'){
		echo "<option value = 'Salesperson' />";
	}
	elseif($mySec == 'Manager'){
		echo "<option value = 'Manager' />";
	}
?>
	  </datalist>
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
				
				if($mysec == 'Administrator' || $mysec == 'Owner'){
					$query = "SELECT * FROM users";
				}
				else{
					$query = "SELECT * FROM users WHERE UserID = '$myID'";
				}

				$UserID = $_SESSION['UserID'];

				if(count($_POST) == 0){
					updateTable($query);
				}

				function updateTable($qry, $active=0){
					mysqli_query($GLOBALS['db'], $qry) or die('Error querying database.');

					$result = mysqli_query($GLOBALS['db'], $qry);
					echo "<thead>";
					echo "<tr>";
					echo "<th style='overflow:hidden;width:150px;'>Username</th>";
					echo "<th style='overflow:hidden;width:100px;'>Password</th>";
					echo "<th style='overflow:hidden;width:200px;'>First Name</th>";
					echo "<th style='overflow:hidden;width:50px;'>Minit</th>";
					echo "<th style='overflow:hidden;width:200px;'>Last Name</th>";
					echo "<th style='overflow:hidden;width:100px;'>Security</th>";
					echo "<th style='overflow:hidden;width:82px;'>Select</th>";
					echo "</tr>";
					echo "</thead>";



					echo"<tbody>";
					while ($row = mysqli_fetch_array($result)) {
						echo "<tr>";
						echo "<td style='overflow:hidden;width:150px;'>" . $row['Username'] . "</td>";
						if($row['EncryptedPass']!= ''){
							echo "<td style='overflow:hidden;width:100px;'>" . $row['EncryptedPass'] . "</td>";
						}
						else{
							echo "<td style='overflow:hidden;width:100px;'>&nbsp</td>";
						}
						echo "<td style='overflow:hidden;width:200px;'>" . $row['Fname'] . "</td>";
						
						if($row['Minitial']!= ''){
							echo "<td style='overflow:hidden;width:50px;'>" . $row['Minitial'] . "</td>";
						}
						else{
							echo "<td style='overflow:hidden;width:50px;'>&nbsp</td>";
						}
						
						if($row['Lname']!= ''){
							echo "<td style='overflow:hidden;width:200px;'>" . $row['Lname'] . "</td>";
						}
						else{
							echo "<td style='overflow:hidden;width:200px;'>&nbsp</td>";
						}
						
						echo "<td style='overflow:hidden;width:100px;'>" . $row['Security'] . "</td>";
						if($active == 1 || $_SESSION['secLevel'] == 'Salesperson' || $_SESSION['secLevel'] == 'Manager' ){
							echo "<td style='overflow:hidden;width:60px;'><center><input type='checkbox' name='formCheck[]' value='" . $row['UserID'] . "' checked/></center></td>";
						}
						else{
							echo "<td style='overflow:hidden;width:65px;'><center><input type='checkbox' name='formCheck[]' value='" . $row['UserID'] . "'/></center></td>";
						}
						echo "</tr>";
						$GLOBALS['rownumber'] = $GLOBALS['rownumber'] + 1;
					}
					echo"</tbody>";
				}

				if(isset($_POST['add'])){
					$Username = $_POST['uname'];
					$Password = $_POST['passwd'];
					$Fname = $_POST['fname'];
					$Minit = $_POST['minit'];
					$Lname = $_POST['lname'];
					$Security = $_POST['security'];

					if ($_SESSION['editSubmit'] == 1){
						//echo "EDIT ACTIVE ON SUBMIT!";
						$_SESSION['editSubmit'] = 0;

						if((!isset($Username) || trim($Username) == '') || (!isset($Fname) || trim($Fname) == '') || (!isset($Security) || trim($Security) == '')){
							echo "You did not fill out all the required fields.";
							updateTable($query);
						}
						else{

							$updateuser = "UPDATE IGNORE users SET Username = '$Username', EncryptedPass = '$Password', Fname = '$Fname', Minitial = '$Minit', Lname = '$Lname', Security = '$Security' WHERE UserID = '$UserID'";
							mysqli_query($db, $updateuser) or die('Error querying database.');

							updateTable($query);
						}
					}
					else{
						//echo "EDIT INACTIVE ON SUBMIT!!!";
						if((!isset($Username) || trim($Username) == '') || (!isset($Fname) || trim($Fname) == '') || (!isset($Security) || trim($Security) == '')){
							echo "You did not fill out all the required fields.";
							updateTable($query);
						}
						else{
							$insertuser = "INSERT IGNORE INTO users (Username, EncryptedPass, Fname, Minitial, Lname, Security)
								VALUES ('$Username','$Password','$Fname','$Minit','$Lname','$Security')";
							mysqli_query($db, $insertuser) or die('Error querying database.');

							updateTable($query);
						}
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
					echo("You can't edit more than 1 user at a time");
				}
				elseif($error == 2){
					echo("You didn't select any user.");
				}



				if(isset($_POST['delete'])){
					if(isset($_POST['formCheck'])){
						$aRecord = $_POST['formCheck'];
						if(empty($aRecord)){
							echo("You didn't select any user.");
						}
						else{
							$N = count($aRecord);

							//echo("You selected $N user(s): ");

							for($i=0; $i < $N; $i++)
							{
								//echo($aRecord[$i] . " ");
								$delete = "DELETE FROM users WHERE UserID = '$aRecord[$i]'";
								mysqli_query($db, $delete) or die('Error querying database.');
							}
							updateTable($query);
						}
					}
					else{
						echo("You didn't select any user(s).");
						updateTable($query);
					}
				}

				mysqli_close($db);
			?>
			</table>
			<?php
				if($mySec == 'Administrator' || $mySec == 'Owner'){
					echo "<input type='submit' name='edit' value='Edit' style='color:#173365;; float: right; margin: 68px 600px;'/>";
					echo "<input type='submit' name='delete' value='Delete' style='color:#FF00C1;; float: right; margin: -90px 300px;'/>";
				}
				else{
					echo "<input type='submit' name='edit' value='Edit' style='color:#173365;; float: right; margin: 68px 460px;'/>";
				}
			?>
			</form>
</body>
</html>

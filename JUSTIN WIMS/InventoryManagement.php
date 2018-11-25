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
    background: url(WIMSbackground.jpg) no-repeat center fixed;
    background-size: cover;
  }

  body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
  }

  .topnavigation {
    overflow: hidden;
    background-color: black;
  }

  .topnavigation a {
    float: left;
    color: #FFFF00;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
  }

  .topnavigation a:hover {
    background-color: #FF0000;
    color: white;
  }

  .topnavigation a.active {
    background-color: #FFFF00;
    color: black;
  }

				table {
					font-family: arial, sans-serif;
					border-collapse: collapse;
					width: 78.9%;
					float: right;
					margin: -590px -52px;
				}
				
				thead, tbody, tr, td, th { display: block; }

				thead th {
					height: 20px;
					text-align: center;
				    background: #4CAF50;
					color: #ddd;
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
					background-color: darkgrey;
				}
  
				.divtable {
					padding-right: 100px;
					padding-top: 45px;
				}
				
				table.divtable tr:hover {
					background-color: #EBECCD;
				}
				
				tr:hover {
					background-color: #ffa;
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
<title>Inventory Management</title>
</head>
<body>
  <div class="topnavigation">
  <a href="index.php">Log Out</a>
  <a href="OrderEntry.php">Order Entry</a>
  <a href="ProductSearch.php">Product Search</a>
  <a class="active" href="InventoryManagement.php">Inventory Management</a>
  <a href="CustomerManagement.php">Customer Management</a>
</div>

<?php 
$db = mysqli_connect('localhost', 'root', '', 'wims')or die('Error connecting to MySQL server');

$Sku = '';
$Vendor = '';
$Vcode = '';
$Style = '';
$Size = '';
$Color = '';
$Lot = '';
$Location = '';
$Amount = '';
$Price = '';
$editActive = 0;
$error = 0;

session_start();
if(!isset($_SESSION['editSubmit']))
{
    $_SESSION['editSubmit'] = 0;
}

if(!isset($_SESSION['GoodID']))
{
    $_SESSION['GoodID'] = -1;
}

if(isset($_POST['edit'])){
	$editActive = 1;
	$_SESSION['editSubmit'] = 1;
	if(isset($_POST['formCheck'])){
		$aRecord = $_POST['formCheck'];
		if(empty($aRecord)){
			echo("You didn't select any product.");
		}
		else{
			$N = count($aRecord);
							
			if($N == 1){
				$edit = "SELECT * FROM goods WHERE GoodId = '$aRecord[0]'";
				
				mysqli_query($db, $edit) or die('Error querying database.');
				$result = mysqli_query($db, $edit);
				
				$row = mysqli_fetch_array($result); 
				$_SESSION['GoodID'] = $row['GoodID'];
				$Sku = $row['SupplierCode'];
				$Vcode = $row['VendorCode'];
				$Style = $row['StyleName'];
				$Size = $row['TileSize'];
				$Color = $row['Color'];
				$Lot = $row['Lot'];
				$Location = $row['Location'];
				$Amount = $row['Amount'];
				$Price = $row['UnitPrice'];
				
				$edit2 = "SELECT * FROM vendors WHERE Vcode = '$Vcode'";
				
				mysqli_query($db, $edit2) or die('Error querying database.');
				$result = mysqli_query($db, $edit2);
				
				$row = mysqli_fetch_array($result);
				$Vendor = $row['Vname'];
				
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
  <h1>Inventory Management</h1>
<section>
  <h1>Add</h1>
  <ul>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      SupplierCode:<br>
	  <input type="text" name="sucode" size="10" value= "<?php echo $Sku;?>">
      <br>
      Vendor:<br>
      <input type="text" name="vendor" size="10" value= "<?php echo $Vendor; ?>">
      <br>
	  Vendor Code:<br>
      <input type="text" name="vcode" size="10" value= "<?php echo $Vcode;?>">
      <br>
	  Style Name:<br>
	  <input type="text" name="stylename" size="10" value= "<?php echo $Style;?>">
      <br>
      Tile Size:<br>
      <input type="text" name="tilesize" size="10" value= "<?php echo $Size;?>">
      <br>
      Color:<br>
      <input type="text" name="color" size="10" value= "<?php echo $Color;?>">
      <br>
	  Lot:<br>
      <input type="text" name="lot" size="10" value= "<?php echo $Lot;?>">
      <br>
      Location:<br>
      <input type="text" name="location" size="10" value= "<?php echo $Location;?>">
      <br>
	  Amount:<br>
      <input type="text" name="amount" size="10" value= "<?php echo $Amount;?>">
      <br>
	  Unit Price:<br>
      <input type="text" name="unitprice" size="10" value= "<?php echo $Price;?>">
      <br>
	  <br><br>
	<input type="submit" name="add" value="Submit"/>
  </br>
<br>

</div>
</section>
</div>
		<div class="divtable">
			<table>
			<?php
				$rownumber = 0;
				$query = "SELECT * FROM goods";
				
				$GoodID = $_SESSION['GoodID'];
				
				if(count($_POST) == 0){
					updateTable($query);
				}
				
				function updateTable($qry, $active=0){
					mysqli_query($GLOBALS['db'], $qry) or die('Error querying database.');
			
					$result = mysqli_query($GLOBALS['db'], $qry);
					echo "<thead>";
					echo "<tr>";
					echo "<th style='overflow:hidden;width:100px;'>SKU</th>";
					echo "<th style='overflow:hidden;width:60px;'>Vendor</th>";
					echo "<th style='overflow:hidden;width:150px;'>Style</th>";
					echo "<th style='overflow:hidden;width:180px;'>Tile Size</th>";
					echo "<th style='overflow:hidden;width:140px;'>Color</th>";
					echo "<th style='overflow:hidden;width:60px;'>Lot</th>";
					echo "<th style='overflow:hidden;width:80px;'>Location</th>";
					echo "<th style='overflow:hidden;width:60px;'>Amount</th>";
					echo "<th style='overflow:hidden;width:60px;'>Price</th>";
					echo "<th style='overflow:hidden;width:67px;'>Select</th>";
					echo "</tr>";
					echo "</thead>";
					
					
	
					echo"<tbody>";
					while ($row = mysqli_fetch_array($result)) {
						echo "<tr>";
						echo "<td style='overflow:hidden;width:100px;'>" . $row['SupplierCode'] . "</td>";
						echo "<td style='overflow:hidden;width:60px;'>" . $row['VendorCode'] . "</td>";
						echo "<td style='overflow:hidden;width:150px;'>" . $row['StyleName'] . "</td>";
						echo "<td style='overflow:hidden;width:180px;'>" . $row['TileSize'] . "</td>";
						echo "<td style='overflow:hidden;width:140px;'>" . $row['Color'] . "</td>";
						echo "<td style='overflow:hidden;width:60px;'>" . $row['Lot'] . "</td>";
						echo "<td style='overflow:hidden;width:80px;'>" . $row['Location'] . "</td>";
						echo "<td style='overflow:hidden;width:60px;'>" . $row['Amount'] . "</td>";
						echo "<td style='overflow:hidden;width:60px;'>" . $row['UnitPrice'] . "</td>";
						if($active == 1){
							echo "<td style='overflow:hidden;width:50px;'><center><input type='checkbox' name='formCheck[]' value='" . $row['GoodID'] . "' checked/></center></td>";
						}
						else{
							echo "<td style='overflow:hidden;width:50px;'><center><input type='checkbox' name='formCheck[]' value='" . $row['GoodID'] . "'/></center></td>";
						}
						echo "</tr>";
						$GLOBALS['rownumber'] = $GLOBALS['rownumber'] + 1;
					}
					echo"</tbody>";
				}
					
				if(isset($_POST['add'])){
					$Sku = $_POST['sucode'];
					$Vendor = $_POST['vendor'];
					$Vcode = $_POST['vcode'];
					$Style = $_POST['stylename'];
					$Size = $_POST['tilesize'];
					$Color = $_POST['color'];
					$Lot = $_POST['lot'];
					$Location = $_POST['location'];
					$Amount = $_POST['amount'];
					$Price = $_POST['unitprice'];
					
					if ($_SESSION['editSubmit'] == 1){
						//echo "EDIT ACTIVE ON SUBMIT!";
						$_SESSION['editSubmit'] = 0;
						
						if((!isset($Sku) || trim($Sku) == '') || (!isset($Vendor) || trim($Vendor) == '') || (!isset($Vcode) || trim($Vcode) == '') || (!isset($Style) || trim($Style) == '') || (!isset($Size) || trim($Size) == '') || (!isset($Color) || trim($Color) == '') || (!isset($Lot) || trim($Lot) == '') || (!isset($Location) || trim($Location) == '') || (!isset($Amount) || trim($Amount) == '') || (!isset($Price) || trim($Price) == '')){
							echo "You did not fill out all the required fields.";
							updateTable($query);
						}
						else{
							$checkVendor = "SELECT * FROM vendors WHERE Vcode = '$Vcode'";
							mysqli_query($db, $checkVendor) or die('Error querying database.');
							$result = mysqli_query($db, $checkVendor);
							
							if (mysqli_num_rows($result)==0) { 
								$insertVendor = "INSERT IGNORE INTO vendors (Vcode, Vname)
								VALUES ('$Vcode', '$Vendor')";
								mysqli_query($db, $insertVendor) or die('Error querying database.');
							}
							else{
								$updateVendor = "UPDATE IGNORE vendors SET Vcode='$Vcode', Vname='$Vendor' WHERE Vcode = '$Vcode'";
								mysqli_query($db, $updateVendor) or die('Error querying database.');
							}
							
							$updateProduct = "UPDATE IGNORE goods SET SupplierCode = '$Sku', VendorCode = '$Vcode', StyleName = '$Style', TileSize = '$Size', Color = '$Color', Lot = '$Lot', Location = '$Location', Amount = '$Amount', UnitPrice = '$Price' WHERE GoodID = '$GoodID'";
							mysqli_query($db, $updateProduct) or die('Error querying database.');
							
							updateTable($query);
						}
					}
					else{
						//echo "EDIT INACTIVE ON SUBMIT!!!";
						if((!isset($Sku) || trim($Sku) == '') || (!isset($Vendor) || trim($Vendor) == '') || (!isset($Vcode) || trim($Vcode) == '') || (!isset($Style) || trim($Style) == '') || (!isset($Size) || trim($Size) == '') || (!isset($Color) || trim($Color) == '') || (!isset($Lot) || trim($Lot) == '') || (!isset($Location) || trim($Location) == '') || (!isset($Amount) || trim($Amount) == '') || (!isset($Price) || trim($Price) == '')){
							echo "You did not fill out all the required fields.";
							updateTable($query);
						} 
						else{
							$insertVendor = "INSERT IGNORE INTO vendors (Vcode, Vname)
								VALUES ('$Vcode', '$Vendor')";
							mysqli_query($db, $insertVendor) or die('Error querying database.');
					
							$insertProduct = "INSERT IGNORE INTO goods (SupplierCode, VendorCode, StyleName, TileSize, Color, Lot, Location, Amount, UnitPrice) 
								VALUES ('$Sku','$Vcode','$Style','$Size','$Color','$Lot','$Location', '$Amount', '$Price')";
							mysqli_query($db, $insertProduct) or die('Error querying database.');
							
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
					echo("You can't edit more than 1 product at a time");
				}
				elseif($error == 2){
					echo("You didn't select any product.");
				}
				
				
				
				if(isset($_POST['delete'])){
					if(isset($_POST['formCheck'])){
						$aRecord = $_POST['formCheck'];
						if(empty($aRecord)){
							echo("You didn't select any product.");
						}
						else{
							$N = count($aRecord);
	
							//echo("You selected $N product(s): ");
						
							for($i=0; $i < $N; $i++)
							{
								//echo($aRecord[$i] . " ");
								$delete = "DELETE FROM goods WHERE GoodID = '$aRecord[$i]'";
								mysqli_query($db, $delete) or die('Error querying database.');
							}
							updateTable($query);
						}
					}
					else{
						echo("You didn't select any product(s).");
						updateTable($query);
					}
				}
				
				mysqli_close($db);
			?> 
			</table>
				<input type="submit" name="edit" value="Edit" style="color:green; float: right; margin: -120px 600px;"/>
				<input type="submit" name="delete" value="Delete" style="color:red; float: right; margin: -120px 300px;"/>
			</form>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
  <style>
  .left {
      text-align: left;
  }
  
  html {
    background: url(Wims2.png) no-repeat center fixed;
    background-size: cover;
  }
  .button {
      background-color: #4CAF50;
      border: none;
      color: white;
      padding: 16px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      -webkit-transition-duration: 0.4s; /* Safari */
      transition-duration: 0.4s;
      cursor: pointer;
  }
  h1 {
    padding-left: 35px;
  }
  
   h2 {
    padding-left: 35px;
  }

  .redbutton {
      background-color: white;
      color: black;
      border: 2px solid #FF00C1;
  }

  .button:hover {
      background-color: #FF00C1;
      color: white;
  }


  body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    color: white;
  }

  .topnavigation {
    overflow: hidden;
    background-color: black;
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
					margin: 50px -20px;
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
</style>
<title>Build Your Order</title>
</head>
<body>
  <div class="topnavigation">
  <a href="index.php">Log Out</a>

<?php
	session_start(); 

	$mySec = $_SESSION['secLevel'];
	$myID = $_SESSION['myID'];
	
	if($mySec == 'Administrator' || $mySec == 'Owner'){
		echo "<a class='active' href='OrderEntry.php'>Order Entry</a>";
		echo "<a href='ProductSearch.php'>Product Search</a>";
		echo "<a href='InventoryManagement.php'>Inventory Management</a>";
		echo "<a href='CustomerManagement.php'>Customer Management</a>";
		echo "<a href='UserManagement.php'>User Management</a>";
	}
	elseif($mySec == 'Salesperson'){
		echo "<a class='active' href='OrderEntry.php'>Order Entry</a>";
		echo "<a href='ProductSearch.php'>Product Search</a>";
		echo "<a href='CustomerManagement.php'>Customer Management</a>";
		echo "<a href='UserManagement.php'>User Management</a>";
	}

?>
</div>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  		<div class="divtable">
			<table>  
<?php
//DATABASE CONNECTION
$db = mysqli_connect('localhost', 'root', '', 'wims')or die('Error connecting to MySQL server');

				$rownumber = 0;
				$query = "SELECT * FROM goods";

				if(count($_POST) == 0){
					//updateTable($query);
					$_SESSION['OrderNum'] = '';
					$_SESSION['GoodID'] = '';
					$_SESSION['OrderType'] = '';
					$_SESSION['CustID'] = '';
					$_SESSION['Quantity'] = '';
					$_SESSION['haveProd'] = 0;
					$_SESSION['editSubmit'] = 0;
					$_SESSION['showButtons'] = 0;
					
					$getsales = "SELECT Username FROM users WHERE UserID = '$myID'";
					mysqli_query($db,$getsales) or die('Error querying database.');
					$result = mysqli_query($db, $getsales);
					$row = mysqli_fetch_array($result);
					
					$_SESSION['salesperson'] = $row['Username'];
				}
				else{
					$_SESSION['showButtons'] = 1;
				}

//PRODUCT INFORMATION
$Sku = '';
$Vendor = '';
$Vcode = '';
$Style = '';
$Size = '';
$Color = '';
$Lot = '';
$Location = '';
$Amount = '';

//ORDER INFORMATION
$OrdNum = '';
$Salesperson = '';
$CustID = '';
$OrdType = '';
$Product = '';
$ProdID = '';
$quantity = '';

//EDIT VARIABLES
$editActive = 0;
$error = 0;
$active = 0;

//SET UP CONSTANT VARIABLES

if(!isset($_SESSION['editSubmit']))
{
    $_SESSION['editSubmit'] = 0;
}

if(!isset($_SESSION['haveProd']))
{
    $_SESSION['haveProd'] = 0;
}

if(!isset($_SESSION['OrderNum']))
{
    $_SESSION['OrderNum'] = '';
}

if(!isset($_SESSION['GoodID']))
{
    $_SESSION['GoodID'] = '';
}

if(!isset($_SESSION['OrderType']))
{
    $_SESSION['OrderType'] = '';
}

if(!isset($_SESSION['CustID']))
{
    $_SESSION['CustID'] = '';
}

if(!isset($_SESSION['Quantity']))
{
    $_SESSION['Quantity'] = '';
}

if(!isset($_SESSION['GoodQty']))
{
    $_SESSION['GoodQty'] = 0;
}

if(!isset($_SESSION['showButtons']))
{
    $_SESSION['showButtons'] = 0;
}

if(!isset($_SESSION['salesperson']))
{
    $_SESSION['salesperson'] = '';
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
					echo "<th style='overflow:hidden;width:87px;'>Select</th>";
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
						echo "<td style='overflow:hidden;width:65px;'>" . $row['UnitPrice'] . "</td>";
						if($active == 1){
							echo "<td style='overflow:hidden;width:60px;'><center><input type='checkbox' name='formCheck[]' value='" . $row['GoodID'] . "' checked/></center></td>";
						}
						else{
							echo "<td style='overflow:hidden;width:65px;'><center><input type='checkbox' name='formCheck[]' value='" . $row['GoodID'] . "'/></center></td>";
						}
						echo "</tr>";
						$GLOBALS['rownumber'] = $GLOBALS['rownumber'] + 1;
					}
					echo"</tbody>";
				}

function updateOrderTable($qry){
					
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
					echo "<th style='overflow:hidden;width:70px;'>Quantity</th>";
					echo "<th style='overflow:hidden;width:87px;'>Select</th>";
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
						echo "<td style='overflow:hidden;width:70px;'>" . $row['Quantity'] . "</td>";
						if($GLOBALS['active'] == 1){
							echo "<td style='overflow:hidden;width:65px;'><center><input type='checkbox' name='formCheck[]' value='" . $row['GoodID'] . "' checked/></center></td>";
						}
						else{
							echo "<td style='overflow:hidden;width:65px;'><center><input type='checkbox' name='formCheck[]' value='" . $row['GoodID'] . "'/></center></td>";
						}
					}
					echo"</tbody>";
}

function productSearch(){
					$Search = $_POST['product'];
					$Search = (string)$Search;

					if((empty($Search) || trim($Search) == '')){
						$query = "SELECT * FROM goods";
					}
					else{
						$query = "SELECT * FROM goods WHERE SupplierCode = '$Search' OR VendorCode = '$Search' OR StyleName = '$Search' OR TileSize = '$Search'
					OR Color = '$Search' OR Lot = '$Search' OR Location = '$Search'";
					}


					mysqli_query($GLOBALS['db'], $query) or die('Error querying database.');

					$result = mysqli_query($GLOBALS['db'], $query);


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
					echo "<th style='overflow:hidden;width:82px;'>Select</th>";
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
						echo "<td style='overflow:hidden;width:65px;'><center><input type='checkbox' name='formCheck[]' value='" . $row['GoodID'] . "'/></center></td>";
						echo "</tr>";
					}
					echo"</tbody>";
}

if(isset($_POST['edit'])){
	$_SESSION['editSubmit'] = 1;
	$id = $_SESSION['GoodID'];
	if(isset($_POST['formCheck'])){
		$aRecord = $_POST['formCheck'];
		if(empty($aRecord)){
			echo("You didn't select any product.");
		}
		else{
			$N = count($aRecord);
			if($N == 1){
				
				//$_SESSION['OrderNum'] = $row['OrderNum'];
				$OrdNum = $_SESSION['OrderNum'];
				
				$edit = "SELECT ItemID, Quantity FROM orderitems WHERE OrderNum = '$OrdNum' AND ItemID = '$aRecord[0]'";
				//$edit = "SELECT ItemID, Quantity FROM orderitems WHERE OrderNum = '$OrdNum' AND ItemID = '$aRecord[0]'";
			
				mysqli_query($db, $edit) or die('Error querying database.');
				$result = mysqli_query($db, $edit);

				$row = mysqli_fetch_array($result);
				$_SESSION['GoodID'] = $row['ItemID'];
				$ProdID = $_SESSION['GoodID'];
				$_SESSION['Quantity'] = $row['Quantity'];
				$_SESSION['haveProd'] = 1;
				
				
				//$edit2 = "SELECT Quantity FROM orderitems WHERE ItemID = $ProdID";
				//mysqli_query($db, $edit) or die('Error querying database.');
				//$result = mysqli_query($db, $edit);
				//$row = mysqli_fetch_array($result);
				//$_SESSION['Quantity'] = $row['Quantity'];
				
				
				$getOrder2 = "SELECT G.GoodID, G.SupplierCode, G.VendorCode, G.StyleName, G.TileSize, G.Color, G.Lot, O.Quantity FROM orderitems O, goods G WHERE O.OrderNum = '$OrdNum' AND G.GoodID = O.ItemID";
				updateOrderTable($getOrder2);
				
				//$updateOrder = "UPDATE IGNORE orderitems SET ItemID='$product' , Quantity= '$quantity'";
				//mysqli_query($db, $updateOrder) or die('Error querying database.');
					
				//updateOrderTable($getOrder2);
			}
			else{
				//$_SESSION['editSubmit'] = 0;
				echo("You can't edit more than 1 product at a time");
			}
		}
	}
	else{
		//$_SESSION['editSubmit'] = 0;
		echo("You didn't select any product.");
	}
}


if(isset($_POST['submit'])){
	
	$_SESSION['OrderNum'] = $_POST['onumber'];
	$OrdNum = $_SESSION['OrderNum'];
	
	//IF ORDER NUM NOT SET
	if((!isset($OrdNum) || trim($OrdNum) == '')){
		
		$Salesperson = $_SESSION['salesperson'];
		
		//CHECK IF ORDER TYPE IS EMPTY
		$_SESSION['OrderType'] = $_POST['otype'];
		$OrdType = $_SESSION['OrderType'];
		
		if((!isset($OrdType) || trim($OrdType) == '')){
			$_SESSION['OrderType'] = 'Pick-Up';
			$OrdType = $_SESSION['OrderType'];
		}
		
		//CHECK IF Customer ID IS EMPTY
		$_SESSION['CustID'] = $_POST['customer'];
		$CustID = $_SESSION['CustID'];
		
		
		if((!isset($CustID) || trim($CustID) == '')){
			$addOrder = "INSERT IGNORE INTO orders (Salesperson, CustID, OrderType)
			VALUES ('$Salesperson',NULL,'$OrdType')";
		}
		else{
			$addOrder = "INSERT IGNORE INTO orders (Salesperson, CustID, OrderType)
			VALUES ('$Salesperson','$CustID','$OrdType')";
		}
					
		//SHOW NEW ORDER IN TABLE
		mysqli_query($db, $addOrder) or die('Error querying database.');
		
		$getOrderNum = "SELECT MAX(OrderNum) AS OrderNum FROM orders";		
		$result = mysqli_query($db, $getOrderNum) or die('Error querying database.');;
		$row = mysqli_fetch_array($result);
		$OrdNum = $row['OrderNum'];
		$_SESSION['OrderNum'] = $OrdNum;
		
		$getOrder = "SELECT * FROM orders WHERE OrderNum = '$OrdNum'";
		mysqli_query($db, $getOrder) or die('Error querying database.');
		
		//$_SESSION['OrderNum'] = $_POST['onumber'];
		//$OrdNum = $_SESSION['OrderNum'];
		$getOrder2 = "SELECT G.GoodID, G.SupplierCode, G.VendorCode, G.StyleName, G.TileSize, G.Color, G.Lot, O.Quantity FROM orderitems O, goods G WHERE O.OrderNum = '$OrdNum' AND G.GoodID = O.ItemID";
		updateOrderTable($getOrder2);
	}
	//IF ORDER NUM SET
	else{
		
		$_SESSION['OrderNum'] = $_POST['onumber'];
		$OrdNum = $_SESSION['OrderNum'];
		$Salesperson = $_SESSION['salesperson'];
		
		$_SESSION['CustID'] = $_POST['customer'];
		$CustID = $_SESSION['CustID'];
		
		$_SESSION['OrderType'] = $_POST['otype'];
		$OrdType = $_SESSION['OrderType'];
		
		//UPDATE ORDER TABLE
		$updateOrder = "UPDATE IGNORE orders SET Salesperson='$Salesperson' , CustID= '$CustID' , OrderType='$OrdType' WHERE OrderNum = '$OrdNum'";
		mysqli_query($db, $updateOrder) or die('Error querying database.');
		
		$getOrder = "SELECT * FROM orders WHERE OrderNum = '$OrdNum'";
		
		mysqli_query($db, $getOrder) or die('Error querying database.');
		$result = mysqli_query($db, $getOrder);
		
		$row = mysqli_fetch_array($result);
		
		$_SESSION['OrderNum'] = $row['OrderNum'];
		$OrdNum = $_SESSION['OrderNum'];
		
		$Salesperson = $row['Salesperson'];
		
		$_SESSION['CustID'] = $row['CustID'];
		$CustID = $_SESSION['CustID'];
		
		$_SESSION['OrderType'] = $row['OrderType'];
		$OrdType = $_SESSION['OrderType'];
		
		$_SESSION['GoodID'] = $_POST['product'];
		$Product = $_SESSION['GoodID'];
		
		$beforeQty = $_SESSION['Quantity'];
		//echo $beforeQty;
		$_SESSION['Quantity'] = $_POST['quantity'];
		$quantity = $_SESSION['Quantity'];
		//echo $quantity;
		
		$getOrder2 = "SELECT G.GoodID, G.SupplierCode, G.VendorCode, G.StyleName, G.TileSize, G.Color, G.Lot, O.Quantity FROM orderitems O, goods G WHERE O.OrderNum = '$OrdNum' AND G.GoodID = O.ItemID";
		mysqli_query($db, $getOrder2) or die('Error querying database.');
		$result = mysqli_query($db, $getOrder2);
		
		$row = mysqli_fetch_array($result);
		
		//DO A PRODUCT SEARCH IF FIELD IS NOT EMPTY
		if((!isset($Product) || trim($Product) == '')){
				updateOrderTable($getOrder2);
		}
		else{
			if($_SESSION['haveProd'] == 0){
				productSearch();
			}
			else{		
				//echo "I have a product!";
				if((!isset($quantity) || trim($quantity) == '')){
					echo "You must specify a quantity!";
				}
				else{
					if($_SESSION['editSubmit'] == 1){		
					
						//CHANGE INVENTORY AMOUNT
						$getGoodAmt = "SELECT Amount FROM goods WHERE GoodID = '$Product'";
						$result = mysqli_query($db, $getGoodAmt) or die('Error querying database.');
						$row = mysqli_fetch_array($result);
						$_SESSION['GoodQty'] = $row['Amount'];
						
						
						if($beforeQty >= $quantity){
							$add = $beforeQty - $quantity;
							$diffAmount = $_SESSION['GoodQty'] + $add;
							//echo $diffAmount;
							$changeAmt = "UPDATE IGNORE goods SET Amount='$diffAmount' WHERE GoodID = '$Product'";
							mysqli_query($db, $changeAmt) or die('Error querying database.');
							
							//UPDATE ORDER
							$updateOrder = "UPDATE IGNORE orderitems SET ItemID='$Product' , Quantity= '$quantity'";
							mysqli_query($db, $updateOrder) or die('Error querying database.');
							updateOrderTable($getOrder2);
						}
						else{
							if($_SESSION['GoodQty'] >= $quantity){
								$sub = $quantity - $beforeQty;
								$diffAmount = $_SESSION['GoodQty'] - $sub;
								//echo $diffAmount;
								$changeAmt = "UPDATE IGNORE goods SET Amount='$diffAmount' WHERE GoodID = '$Product'";
								mysqli_query($db, $changeAmt) or die('Error querying database.');
								
								//UPDATE ORDER
								$updateOrder = "UPDATE IGNORE orderitems SET ItemID='$Product' , Quantity= '$quantity'";
								mysqli_query($db, $updateOrder) or die('Error querying database.');
								updateOrderTable($getOrder2);
							}
							else{
								echo "There is not enough product in inventory to make this change!";
								updateOrderTable($getOrder2);
							}
						}
						//END CHANGE 
						
						$_SESSION['GoodID'] = '';
						$_SESSION['Quantity'] = '';
						$_SESSION['editSubmit'] = 0;
					}
					else{
						//CHANGE INVENTORY AMOUNT
						$getGoodAmt = "SELECT Amount FROM goods WHERE GoodID = '$Product'";
						$result = mysqli_query($db, $getGoodAmt) or die('Error querying database.');
						$row = mysqli_fetch_array($result);
						$_SESSION['GoodQty'] = $row['Amount'];
						if($_SESSION['GoodQty'] >= $quantity){
							$insertProduct = "INSERT IGNORE INTO orderitems (OrderNum, ItemID, Quantity)
							VALUES ('$OrdNum','$Product','$quantity')";
							mysqli_query($db, $insertProduct) or die('Error querying database.');
							updateOrderTable($getOrder2);
							$_SESSION['GoodID'] = '';
							$_SESSION['Quantity'] = '';
							$_SESSION['haveProd'] = 0;
						}
						else{
							echo "There is not enough product in inventory to make this change!";
							updateOrderTable($getOrder2);
							$_SESSION['haveProd'] = 1;
						}

					}
				}
				
			}
		}
	}
}

if(isset($_POST['add'])){
	$_SESSION['OrderNum'] = $_POST['onumber'];
	$OrdNum = $_SESSION['OrderNum'];
	$getOrder2 = "SELECT G.GoodID, G.SupplierCode, G.VendorCode, G.StyleName, G.TileSize, G.Color, G.Lot, O.Quantity FROM orderitems O, goods G WHERE O.OrderNum = '$OrdNum' AND G.GoodID = O.ItemID";
	updateOrderTable($getOrder2);
	
	if(isset($_POST['formCheck'])){

		$aRecord = $_POST['formCheck'];
		$N = count($aRecord);

		if($N == 1){
			
			$add = "SELECT GoodID FROM goods WHERE GoodId = '$aRecord[0]'";

			mysqli_query($db, $add) or die('Error querying database.');
			$result = mysqli_query($db, $add);

			$row = mysqli_fetch_array($result);
			$_SESSION['GoodID'] = $row['GoodID'];
			$_SESSION['haveProd'] = 1;
		}	
		else{
			echo("You can't edit more than 1 product at a time");
		}
	}	
	else{
		echo("You didn't select a product!");
	}
}

if(isset($_POST['delete'])){
	$_SESSION['OrderNum'] = $_POST['onumber'];
	$OrdNum = $_SESSION['OrderNum'];	
	$getOrder2 = "SELECT G.GoodID, G.SupplierCode, G.VendorCode, G.StyleName, G.TileSize, G.Color, G.Lot, O.Quantity FROM orderitems O, goods G WHERE O.OrderNum = '$OrdNum' AND G.GoodID = O.ItemID";
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
				$delete = "DELETE FROM orderitems WHERE ItemID = '$aRecord[$i]'";
				mysqli_query($db, $delete) or die('Error querying database.');
			}
			updateOrderTable($getOrder2);
		}
	}
	else{
		echo("You didn't select any product(s).");
		updateOrderTable($getOrder2);
	}
}




mysqli_close($db);
?>
</table>

<div class="left">
  <h1>Order Entry</h1>
<section>
  <h1>Enter Here:</h1>
  <ul>
  
      Order #:<br>
	  <input type="text" name="onumber" size="10" value= "<?php echo $_SESSION['OrderNum'];?>">
      <br>
      Customer:<br>
	  <input type="text" name="customer" size="10" value= "<?php echo $_SESSION['CustID'];?>">
      <br>
      Product:<br>
      <input type="text" name="product" size="10" value= "<?php echo $_SESSION['GoodID']; ?>">
      <br>
	  Quantity:<br>
      <input type="text" name="quantity" size="10" value= "<?php echo $_SESSION['Quantity']; ?>">
      <br>
	  Order Type:<br>
      <input type="text" list = "orderTypes" name="otype" size="10" value= "<?php echo $_SESSION['OrderType'];?>">
	  <datalist id = "orderTypes">
		<option value = "Pick-Up" />
		<option value = "Truck" />
		<option value = "UPS" />
	  </datalist>
      <br>
	  <br><br>
	<input type="submit" name="submit" value="Submit"/>
  </br>
<br>

</div>
</section>
<?php			
			if ($_SESSION['showButtons'] == 1){
				echo "<input type='submit' name='add' value='Add' style='color:#173365; float: right; margin: 0px 650px;'/>";
				echo "<input type='submit' name='edit' value='Edit' style='color:#173365; float: right; margin: -22px 450px;'/>";
				echo "<input type='submit' name='delete' value='Delete' style='color:#FF00C1; float: right; margin: -22px 250px;'/>";
			}
?>
			</form>
  </body>
  </html>
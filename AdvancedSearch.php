<!DOCTYPE html>
<html>
	<head>
		<style>
			.center {
			text-align: center;
			}

			.left{
			padding-left: 15px;
			}

			h1 {
			padding-left: 10px;
			}

			section{
				padding-left: 15px;
			}

			html {
			background: url(Wims.png) no-repeat center fixed;
			background-size: cover;
			}

			.button {
			background-color: #4CAF50; /* Green */
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

			.bluebutton {
		      background-color: white;
		      color: black;
		      border: 2px solid #404F6B;
		  }

		  .bluebutton:hover {
		      background-color: #404F6B;
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
			color: black;
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
				width: 74.43%;
				float: right;
				margin: -450px -52px;
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
				height:600px;
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
		<title>Advanced Search</title>
	</head>
	<body>
		<div class="topnavigation">
			<a href="index.php">Log Out</a>
<?php
	session_start(); 

	$mySec = $_SESSION['secLevel'];
	
	if($mySec == 'Administrator' || $mySec == 'Owner'){
		echo "<a href='OrderEntry.php'>Order Entry</a>";
		echo "<a class='active' href='ProductSearch.php'>Product Search</a>";
		echo "<a href='InventoryManagement.php'>Inventory Management</a>";
		echo "<a href='CustomerManagement.php'>Customer Management</a>";
		echo "<a href='UserManagement.php'>User Management</a>";
	}
	elseif($mySec == 'Salesperson'){
		echo "<a href='OrderEntry.php'>Order Entry</a>";
		echo "<a class='active' href='ProductSearch.php'>Product Search</a>";
		echo "<a href='CustomerManagement.php'>Customer Management</a>";
		echo "<a href='UserManagement.php'>User Management</a>";		
	}
	elseif($mySec == 'Manager'){
		echo "<a class='active' href='ProductSearch.php'>Product Search</a>";
		echo "<a href='InventoryManagement.php'>Inventory Management</a>";
		echo "<a href='UserManagement.php'>User Management</a>";
	}
	elseif($mySec == 'Warehouse'){
		echo "<a class='active' href='ProductSearch.php'>Product Search</a>";
	}
?>
		</div>

		  <h1>Advanced Search</h1>
<section>
  <h2>Enter Here:</h2>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	SKU:<br>
	<input type="text" name="psearch_sku">
	<br>
	Vendor Code:<br>
	<input type="text" name="psearch_vendor">
	<br>
	Style:<br>
	<input type="text" name="psearch_style">
	<br>
	Size:<br>
	<input type="text" name="psearch_size">
	<br>
	Color:<br>
	<input type="text" name="psearch_color">
	<br>
	Location:<br>
	<input type="text" name="psearch_loc">
	<br><br>
	<button class="button bluebutton" type="submit" name="submit" value="Submit">Submit</button>
  </form>

</section>

		<div class="divtable">
			<table>
			<?php

				$query = "SELECT * FROM goods WHERE ";
				$num = 0;

				$db = mysqli_connect('localhost', 'root', '', 'wims')or die('Error connecting to MySQL server');

				if(isset($_POST['submit'])){
					$Sku = $_POST['psearch_sku'];
					$Vendor = $_POST['psearch_vendor'];
					$Style = $_POST['psearch_style'];
					$Color = $_POST['psearch_color'];
					$Size = $_POST['psearch_size'];
					$Location = $_POST['psearch_loc'];

					if ((!empty($Sku) && trim($Sku) != '')) {
						$query .= "SupplierCode = '$Sku' ";
						$num = $num+1;
					}

					if((!empty($Vendor) && trim($Vendor) != '')) {
						if($num >= 1){
							$query .= "AND ";
						}

						$query .= "VendorCode = '$Vendor' ";
						$num = $num+1;
					}

					if((!empty($Style) && trim($Style) != '')) {
						if($num >= 1){
							$query .= "AND ";
						}

						$query .= "StyleName = '$Style' ";
						$num = $num+1;
					}

					if((!empty($Size) && trim($Size) != '')) {
						if($num >= 1){
							$query .= "AND ";
						}

						$query .= "TileSize = '$Size' ";
						$num = $num+1;
					}

					if((!empty($Color) && trim($Color) != '')) {
						if($num >= 1){
							$query .= "AND ";
						}

						$query .= "Color = '$Color' ";
						$num = $num+1;
					}

					if((!empty($Location) && trim($Location) != '')) {
						if($num >= 1){
							$query .= "AND ";
						}

						$query .= "Location = '$Location'";
						$num = $num+1;
					}

					if($num == 0){
						$query = "SELECT * FROM goods";
					}

					mysqli_query($db, $query) or die('Error querying database.');

					$result = mysqli_query($db, $query);

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
					echo "<th style='overflow:hidden;width:77px;'>Price</th>";
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
						echo "</tr>";
					}
					echo"</tbody>";
				}

				mysqli_close($db);
			?>
			</table>
		</div>
	</body>
</html>

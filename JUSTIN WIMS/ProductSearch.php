<!DOCTYPE html>
<html>
	<body>
		<head>
			<style>
				html{
					background: url(WIMSbackground.jpg) no-repeat center fixed;
					background-size: cover;
				}
				
				body {
					margin: 0;
					font-family: Arial, Helvetica, sans-serif;
				}
				
				.topnavigation {
					overflow: hidden;
					background-color: #000000;
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
					-webkit-transition-duration: 0.4s;
					transition-duration: 0.4s;
					cursor: pointer;
				}
				
				.greenbutton {
					background-color: white;
					color: black;
					border: 2px solid #4CAF50;
				}

				.greenbutton:hover {
					background-color: #4CAF50;
					color: white;
				}

				.redbutton{
					background-color: white;
					color: black;
					border: 2px solid #f44336;
				}

				.redbutton:hover {
					background-color: #f44336;
					color: white;
				}
				
				h1 {
					padding-left: 10px;
				}
				
				h2{
					padding-left: 10px;
				}
				
				section{
					padding-left: 15px;
				}
				
				table {
					font-family: arial, sans-serif;
					border-collapse: collapse;
					width: 74.43%;
					float: right;
					margin: -310px -52px;
				}
				
				thead, tbody, tr, td, th { display: block; }

				thead th {
					height: 20px;
					text-align: center;
				    background: #4CAF50;
					color: #ddd;
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
					background-color: darkgrey;
				}
  
				.divtable {
					padding-right: 100px;
					padding-top: 45px;
				}
				
				tr:hover {
					background-color: #ffa;
				}
	
			</style>
			<title>Product Search</title>
		</head>
		
		<div class="topnavigation">
			<a href="index.php">Log Out</a>
			<a href="OrderEntry.php">Order Entry</a>
			<a class="active" href="ProductSearch.php">Product Search</a>
			<a href="InventoryManagement.php">Inventory Management</a>
			<a href="CustomerManagement.php">Customer Management</a>
		</div>

		<h1>Search for a Tile</h1>
		<h2>Product Search</h2>
		
		<section>

			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input type="text" name="psearch_input">
				<br><br>
				<button class="button redbutton" type="submit" name="submit" value="Submit">Submit</button>
			</form>

			<form action="AdvancedSearch.php">
			<button class="button greenbutton">Advanced Search</button></form>


		</section>
		
		<div class="divtable">
			<table>
			<?php
				$db = mysqli_connect('localhost', 'root', '', 'wims')or die('Error connecting to MySQL server');

				if(isset($_POST['submit'])){
					$Search = $_POST['psearch_input'];
					$Search = (string)$Search;
					
					if((empty($Search) || trim($Search) == '')){
						$query = "SELECT * FROM goods";
					}
					else{
						$query = "SELECT * FROM goods WHERE SupplierCode = '$Search' OR VendorCode = '$Search' OR StyleName = '$Search' OR TileSize = '$Search'
					OR Color = '$Search' OR Lot = '$Search' OR Location = '$Search'";
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

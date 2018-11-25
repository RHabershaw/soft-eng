<html>
<head>
  <style>

        table {
            width: 40%;
			float: right;
			margin: 100px 150px;
        }

        thead, tbody, tr, td, th { display: block; }

        tr:after {
            content: '';
            display: block;
            visibility: hidden;
            clear: both;
        }

        thead th {
            height: 30px;
            text-align: center;
			border: 1px solid;
        }

        tbody {
            height: 300px;
			text-align: center;
            overflow-y: auto;
        }

        thead {
            /* fallback */
        }


        tbody td, thead th {
            float: left;
			border: 1px solid #dddddd;
        }
		
		tr:nth-child(even) {
				background-color: #dddddd;
		}
		
</style>
<title>Test Table</title>
</head>
    <table>    
		<?php
				$db = mysqli_connect('localhost', 'root', '', 'wims')or die('Error connecting to MySQL server');
				
				$query = "SELECT * FROM goods WHERE Color = 'Beige'";
			
				mysqli_query($db, $query) or die('Error querying database.');
				
				$result = mysqli_query($db, $query);
				$row = mysqli_fetch_array($result);
				
				echo "<thead>";
				echo "<tr class='header'>";
				echo "<th style='overflow:hidden;width:100px;'>SKU</th>";
				echo "<th style='overflow:hidden;width:60px;'>Vendor</th>";
				echo "<th style='overflow:hidden;width:110px;'>Style</th>";
				echo "<th style='overflow:hidden;width:100px;'>Tile Size</th>";
				echo "<th style='overflow:hidden;width:100px;'>Color</th>";
				echo "</tr>";
				echo "</thead>";
				
				echo"<tbody>";
				while ($row = mysqli_fetch_array($result)) {
					echo "<tr>";
					echo "<td style='overflow:hidden;width:100px;'>" . $row['SupplierCode'] . "</td>";
					echo "<td style='overflow:hidden;width:60px;'>" . $row['VendorCode'] . "</td>";
					echo "<td style='overflow:hidden;width:110px;'>" . $row['StyleName'] . "</td>";
					echo "<td style='overflow:hidden;width:100px;'>" . $row['TileSize'] . "</td>";
					echo "<td style='overflow:hidden;width:100px;'>" . $row['Color'] . "</td>";
					echo "</tr>";
				}
				echo"</tbody>";
		?>
    </table>
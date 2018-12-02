<!DOCTYPE html>
<html>
<head>
  <style>
  .center {
      text-align: center;
  }
  html {
    background: url(Wims.png) no-repeat center fixed;
    background-size: cover;
  }
  h1
  {
    padding-left: 15px;
  }
  p
  {
    padding-left: 20px;
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

  .greenbutton {
      background-color: white;
      color: black;
      border: 2px solid #4CAF50;
  }

  .greenbutton:hover {
      background-color: #4CAF50;
      color: white;
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

  .redbutton {
      background-color: white;
      color: black;
      border: 2px solid #F43386;
  }

  .redbutton:hover {
      background-color: #F43386;
      color: white;
  }

  .yellowbutton {
      background-color: white;
      color: black;
      border: 2px solid #FFFF00;
  }

  .yellowbutton:hover {background-color: #FFFF00;}

  body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    color: white;
  }

  .topnavigation {
    overflow: hidden;
    background-color: #000000;
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
    background-color:  #FF00C1;
    color: white;
  }

  .topnavigation a.active {
    background-color: #FF00C1;
    color: white;
  }
</style>
<title>WIMs by Boogle</title>
</head>
<body>
  <div class="topnavigation">
  <a class="active" href="index.php">Log Out</a>
  </div>
<div class="center>">
<?php 
session_start(); 

$User = $_SESSION['user'];
$Security = $_SESSION['secLevel'];

?>
  <h1>Wecome Back <?php echo $User ?>!</h1>
<p style="color:white;">As <?php echo  strtolower($Security) ?> here is what you can do:</p>
<ul>
<?php 
	if($Security == 'Administrator' || $Security == 'Owner'){
		echo "<form action='OrderEntry.php' method='get'>";
		echo "<li><button class='button greenbutton'>Order Entry</button></li>";
		echo "</form>";
		echo "<form action='ProductSearch.php' method='get'>";
		echo "<li><button class='button bluebutton'>Product Search</button></li>";
		echo "</form>";
		echo "<form action='InventoryManagement.php' method='get'>";
		echo "<li><button class='button redbutton'>Inventory Management</button></li>";
		echo "</form>";
		echo "<form action='CustomerManagement.php' method='get'>";
		echo "<li><button class='button yellowbutton'>Customer Management</button></li>";
		echo "</form>";
		echo "<form action='UserManagement.php' method='get'>";
		echo "<li><button class='button bluebutton'>User Management</button></li>";
		echo "</form>";	
	}
	elseif($Security == 'Salesperson'){
		echo "<form action='OrderEntry.php.php' method='get'>";
		echo "<li><button class='button greenbutton'>Order Entry</button></li>";
		echo "</form>";
		echo "<form action='ProductSearch.php' method='get'>";
		echo "<li><button class='button bluebutton'>Product Search</button></li>";
		echo "</form>";
		echo "<form action='CustomerManagement.php' method='get'>";
		echo "<li><button class='button yellowbutton'>Customer Management</button></li>";
		echo "</form>";
		echo "<form action='UserManagement.php' method='get'>";
		echo "<li><button class='button bluebutton'>User Management</button></li>";
		echo "</form>";	
	}
	elseif($Security == 'Manager'){
		echo "<form action='ProductSearch.php' method='get'>";
		echo "<li><button class='button bluebutton'>Product Search</button></li>";
		echo "</form>";
		echo "<form action='InventoryManagement.php' method='get'>";
		echo "<li><button class='button redbutton'>Inventory Management</button></li>";
		echo "</form>";
		echo "<form action='UserManagement.php' method='get'>";
		echo "<li><button class='button bluebutton'>User Management</button></li>";
		echo "</form>";	
	}
	elseif($Security == 'Warehouse'){
		echo "<form action='ProductSearch.php' method='get'>";
		echo "<li><button class='button bluebutton'>Product Search</button></li>";
		echo "</form>";
	}
?>
</ul>
</div>
</body>
</html>

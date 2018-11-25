<!DOCTYPE html>
<html>
<head>
  <style>
  .center {
      text-align: center;
  }
  html {
    background: url(WIMSby.jpg) no-repeat center fixed;
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
      border: 2px solid #008CBA;
  }

  .bluebutton:hover {
      background-color: #008CBA;
      color: white;
  }

  .redbutton {
      background-color: white;
      color: black;
      border: 2px solid #f44336;
  }

  .redbutton:hover {
      background-color: #f44336;
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
</style>
<title>WIMs by Boogle</title>
</head>
<body>
  <div class="topnavigation">
  <a class="active" href="index.php">Log Out</a>
  </div>
<div class="center>">
  <h1>Wecome Back!</h1>
<p style="color:black;">As a manager here is what you can do:</p>
<ul>
  <form action="OrderEntry.php" method="get">
  <li><button class="button greenbutton">Order Entry</button></li>
</form>
  <form action="ProductSearch.php" method="get">
  <li><button class="button bluebutton">Product Search</button></li>
</form>
<form action="InventoryManagement.php" method="get">
  <li><button class="button redbutton">Inventory Management</button></li>
</form>
<form action="CustomerSearch.php" method="get">
  <li><button class="button yellowbutton">Customer Search</button></li>
</form>
</ul>
</div>
</body>
</html>

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
    padding-left: 10px;
  }

  .redbutton {
      background-color: white;
      color: black;
      border: 2px solid #f44336;
  }

  .button:hover {
      background-color: #f44336;
      color: white;
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
</style>
<title>Build Your Order</title>
</head>
<body>
  <div class="topnavigation">
  <a href="index.php">Log Out</a>
  <a class="active" href="OrderEntry.php">Order Entry</a>
  <a href="ProductSearch.php">Product Search</a>
  <a href="InventoryManagement.php">Inventory Management</a>
  <a href="CustomerManagement.php">Customer Management</a>
</div>
  <h1>Enter Your Order</h1>
  <div class="center">
  <p>Enter Here:</p>
  <form action="OrderEntryEX.php" method="get">
  SKU:<br>
  <input type"text" name"011">
  <br>
  Vendor:<br>
  <input type="text" name="Equipe">
  <br>
  Style:<br>
  <input type="text" name="Splendorous">
  <br>
  Color:<br>
  <input type="text" name="">
  <br>
  Size:<br>
  <input type="text" name ="3x12">
  <br>
  <br>
  <button class="button redbutton">Submit Order</button>
  </form>
  </div>
  </body>
  </html>

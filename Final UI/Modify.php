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
  html {
    background: url(WIMSbackground.jpg) no-repeat center fixed;
    background-size: cover;
}
  body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
  }
  h1 {
    padding-left: 35px;
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
      width: 50%;
  }

  td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 4px;
  }

  tr:nth-child(even) {
      background-color: #dddddd;
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
.divtable {
  padding-right: 100px;
  padding-top: 45px;
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
  <a href="CustomerManagement.php">Customer Management </a>
</div>
<div class="divtable">
<table align="right">
  <tr>
    <th>Vendor</th>
    <th>Style</th>
    <th>Color</th>
    <th>Tile Size</th>
  </tr>
  <tr>
    <td>Equipe</td>
    <td>Splendorous</td>
    <td>Black</td>
    <td>3x12</td>
  </tr>
  <tr>
    <td>Equipe</td>
    <td>Splendorous</td>
    <td>White</td>
    <td>3X12</td>
  </tr>
  <tr>
    <td>Equipe</td>
    <td>Splendorous</td>
    <td>Red</td>
    <td>3x12</td>
  </tr>
  <tr>
    <td>Equipe</td>
    <td>Splendorous</td>
    <td>Blue</td>
    <td>3x12</td>
  </tr>
  <tr>
    <td>Equipe</td>
    <td>Splendorous</td>
    <td>Green</td>
    <td>3x12</td>
  </tr>
  <tr>
    <td>Equipe</td>
    <td>Splendorous</td>
    <td>Purple</td>
    <td>3x12</td>
  </tr>
</table>
</div>
<div class="left">
  <h1>Inventory Management</h1>
<section>
  <h1>Modify</h1>
  <ul>
    <form action="" target="">
      SKU:<br>
      <input type"text" name"" size=10>
      <br>
      Vendor:<br>
      <input type"text" name"" size=10>
      <br>
      Size:<br>
      <input type"text" name"" size=10>
      <br>
      Color:<br>
      <input type"text"name"" size=10>
      <br>
      Location:<br>
      <input type"text" name"" size=10>
      <br>
  </br>
<br>
</form>
  <div class="dropdown">
    <button class="dropbutton">Manage</button>
    <div class="dropdown-content">
      <a href="InventoryManagement.php">Add</a>
      <a href="Delete.php">Delete</a>
      <a href="">Filter</a>
      <a href="">Sort</a>
    </div>
  </div>
</section>

  </div>
  </body>
  </html>

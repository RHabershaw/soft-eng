<!DOCTYPE html>
<html>
<head>
  <style>
  .center {
      text-align: center;
      padding-right: 100000000000px;
      padding-bottom:1000px;
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
  .padding {
    padding-bottom: 100000000px;
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

</style>
<title>Customer Management</title>
</head>
<body>
  <div class="topnavigation">
  <a href="index.php">Log Out</a>
  <a href="OrderEntry.php">Order Entry</a>
  <a href="ProductSearch.php">Product Search</a>
  <a href="InventoryManagement.php">Inventory Management</a>
  <a class="active" href="CustomerManagement.php">Customer Management</a>
</div>
<div class="divtable">
<table align="right">
  <tr>
  </tr>
</table>
</div>
<div class="left">
  <h1>Customer Management</h1>
</div>
<section>
  <h1>Add</h1>
  <ul>
    <div class="padding">
    <form action="" target="">
      First Name:<br>
      <input type"text" name"" size=20>
      <br>
      Last Name:<br>
      <input type"text" name"" size=20>
      <br>
      Middle Name:<br>
      <input type"text" name"" size=20>
      <br>
      Company Name:<br>
      <input type"text" name"" size=20>
      <br>
      Address:<br>
      <input type"text" name"" size=20>
      <br>
      City:<br>
      <input type"text" name"" size=20>
      <br>
      State:<br>
      <input type"text" name"" size=20>
      <br>
      Zip:<br>
      <input type"text" name"" size=20>
      <br>
      Phone Number:<br>
      <input type"text" name"" size=20>
      <br>
      Email:<br>
      <input text"text" name"" size=20>
      <br>
      <br>
    </br>
  </br>
</ul>
</div>
</form>
</section>
</div>
</body>
</html>

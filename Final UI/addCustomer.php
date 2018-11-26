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
    position: absolute;
    top: 110px;
    left: 10px;
    right: 10px;
    bottom: auto;
    overflow-y: scroll;
    height:1000px;
    display: block;
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
  }

.divtable td, .divtable th {
    border: 1px solid #ddd;
    padding: 8px;
}

.divtable tr:nth-child(even){background-color: #FFFFFF;}

.divtable tr:nth-child(odd){background-color: #FFFFFF;}

.divtable tr:hover {background-color: #C0C0C0;}

.divtable th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #B900FF;
    color: white;
  }

  .padding {
    padding-bottom: 100000000px;
  }
  html {
    background: url(Wims.png) no-repeat center fixed;
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


.redbutton {
    background-color: white;
    color: black;
    border: 2px solid #f44336;
}

.redbutton:hover {
    background-color: #f44336;
    color: white;
}
  </style>
</head>
<title>Customer Management</title>
<body>
  <div class="topnavigation">
  <a href="index.html">Log Out</a>
  <a href="OrderEntry.html">Order Entry</a>
  <a href="ProductSearch.php">Product Search</a>
  <a class="active" href="InventoryManagement.html">Inventory Management</a>
  <a href="CustomerManagement.html">Customer Management</a>
</div>
<h1>Result</h1>

<div class="left">
<?php
	include_once 'dbh.php';


	$CustID = mysqli_real_escape_string($conn, $_POST['CustID']);
	$Fname =  mysqli_real_escape_string($conn, $_POST['Fname']);
	$Minit =  mysqli_real_escape_string($conn, $_POST['Minit']);
	$Lname =  mysqli_real_escape_string($conn, $_POST['Lname']);
	$Cname =  mysqli_real_escape_string($conn, $_POST['Cname']);
	$AddSt =  mysqli_real_escape_string($conn, $_POST['AddSt']);
	$AddTw =  mysqli_real_escape_string($conn, $_POST['AddTw']);
	$AddState = mysqli_real_escape_string($conn, $_POST['AddState']);
	$AddZip = mysqli_real_escape_string($conn, $_POST['AddZip']);
	$Phone =  mysqli_real_escape_string($conn, $_POST['Phone']);
	$Email =  mysqli_real_escape_string($conn, $_POST['Email']);


	$sql = "INSERT INTO customers (CustID, Fname, Minitial, Lname, CompanyName, AddStreet, AddTown, AddState, AddZip, PhoneNum, Email)
            VALUES ('$CustID','$Fname','$Minit','$Lname','$Cname','$AddSt','$AddTw','$AddState','$AddZip','$Phone','$Email');";
	mysqli_query($conn, $sql);

  ?>

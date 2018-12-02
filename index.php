<!DOCTYPE html>
<html>
<head>
  <style>
html {
  background: url(Wims.png) no-repeat center fixed;
  background-size: cover;
}

.center {
    text-align: center;
}
.myFunction
{
  margin-left: auto;
   margin-right: auto;
}

.LogInbutton {
    background-color: white;
    color: black;
    border: 2px solid #4CAF50;
}

 .LogInbutton:hover {
    background-color: #4CAF50;
    color: white;
}
body{
  color: white;
}


</style>
 <title>Welcome to WIMS!</title>
</head>
<body>
<p>
</p>
<p>
</p>
<p>
</p>
<p>
</p>
<div class="center">
<h1 style="color:white;">Sign in Here:</h1>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 <br style="color:white;">Username: <input type="text" id="username" size="20" name="username"></br>
 <br style="color:white;">Password: <input type="password" id="password" size="20" name="password" value=""></br>
 <br><button name="login" value ="login" class="button LogInbutton">Submit</button></br>
 <input type="checkbox" onclick="MYFUNCTION()">Show Password
</form>
<div class="myFunction">

<?php
	$db = mysqli_connect('localhost', 'root', '', 'wims')or die('Error connecting to MySQL server');
	
	$Username = '';
	$User = '';
	$Security = '';
	$Password = '';
	$chkpwd = '';
	
	if(!isset($_SESSION['loggedIn']))
	{
		$_SESSION['loggedIn'] = 0;
	}

	if(!isset($_SESSION['user']))
	{
		$_SESSION['user'] = '';
	}
	
	if(!isset($_SESSION['myID']))
	{
		$_SESSION['myID'] = '';
	}

	if(!isset($_SESSION['secLevel']))
	{
		$_SESSION['secLevel'] = '';
	}

	if($_SESSION['loggedIn'] == 0){
		session_start();
		$_SESSION['loggedIn'] = 1;
	}
	else{
		session_destroy();
	}
	
	if (isset($_POST['username'])){ 
		$Username = $_POST['username'];
	}
	
	if (isset($_POST['password'])){ 
		$Password = $_POST['password'];
	}
	
	if(isset($_POST['login'])){
		if((!isset($Username) || trim($Username) == '')){
			echo "You need to enter a username!";
		}
		else{
			
			$getinfo = "SELECT EncryptedPass, Security, Fname, UserID FROM users WHERE Username = '$Username'";
				
			mysqli_query($db,$getinfo) or die('Error querying database.');
			$result = mysqli_query($db, $getinfo);
			$noRows = mysqli_num_rows($result);

			if($noRows > 0){
				$row = mysqli_fetch_array($result);
				$User = $row['Fname'];
				$Security = $row['Security'];
				$chkpwd = $row['EncryptedPass'];
				$UserID = $row['UserID'];
				
				if(empty($Password) && empty($chkpwd)){
					$_SESSION['user'] = $User;
					$_SESSION['secLevel'] = $Security;
					$_SESSION['myID'] = $UserID;
					header("Location: ListofFunctions.php");
				}
				
				if($Password == $chkpwd){
					$_SESSION['user'] = $User;
					$_SESSION['secLevel'] = $Security;
					$_SESSION['myID'] = $UserID;
					header("Location: ListofFunctions.php");
				}
				else{
					echo "Invalid Password!";
				}
			}
			else{
				echo "Invalid Username!";
			}
		}
	}


?>

<script>
function MYFUNCTION(){
	var x = document.getElementById("password");
	if(x.type === "password"){
		x.type = "text";
	}
	else{
		x.type = "password"
	}
}
</script>
</div>
</div>

</body>
</html>

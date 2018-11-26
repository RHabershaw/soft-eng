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
<form action="ListofFunctions.php" onsubmit="return myFunction()">
 <br style="color:white;">Username: <input type="text" id="username" size="20" name="username"></br>
 <br style="color:white;">Password: <input type="password" id="password" size="20" name="password" value=""></br>
 <br><button class="button LogInbutton">Submit</button></br>
 <input type="checkbox" onclick="MYFUNCTION()">Show Password
</form>
<div class="myFunction">
<script>
function myFunction() {
   var password = document.getElementById("password").value;
   var username = document.getElementById("username").value;
   submitOK = "true";

   if ((username !== "admin") || (password !== "password")){
       alert("Incorrect credentials!");
       submitOK = "false";
    }

   if (submitOK == "false") {
       return false;
   }
}
</script>
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

<?php
session_start();
if(isset($_POST['submitted']))
{
/*if(isset($_POST['username']) and isset($_POST['passwd']))
{
	$_SESSION['username']=$_POST['username'];
	$_SESSION['passwd']=$_POST['passwd'];

	if(($_SESSION['username']=='admin') and ($_SESSION['passwd']=='12345'))
	{*/
		echo "<h1><u><i><center>Installation Prerequisites</center></i></u></h1>";
	/*}
	else
	{
		echo "<h2>The username and password did not match</h2>";
		exit();	
	}
}
}
else
{
	echo "<h2>Unauthenticated user</h2>";
	exit();
*/
}
?>

<html>
<head><title>Register</title>
<style>
th{
  text-align:right;
}
input{
  height:3em;
  width:100%;
  color:cornflowerblue;
}
</style>
</head>
<body bgcolor="#d0e4fe"></br></br>
<h2><i> We will need a few details for installation purposes</i></h2></br></br></br>
<form name="registerf" method="POST" action="tb_create.php"><i>
<fieldset>
<table>
<tr><th>Database name</th><td><input type="text" placeholder="Input Database name" name="dbname" required></td></tr>
<tr><th>Database user</th><td><input type="text" placeholder="Input Database user" name="dbuser" required></td></tr>
<tr><th>Database password </th><td><input type="password" placeholder="Input Database password" name="dbpassword" required></td></tr>
<tr><th>Table prefix</th><td><input type="text" name="tbprefix" placeholder="eg. TB_"required></td><tr>
<tr><th>Host name</th><td><input type="text" name="hname" required placeholder="localhost" value="localhost"></td></tr>
<tr><th>Choose Username (site maintenance account) : </th><td><input style="width:100%;height:3em;color:cornflowerblue;" type="text" name="username" placeholder="Input Username" required></td></tr>
<tr><th>Choose Password (site maintenance account) :</th><td><input style="width:100%;height:3em;color:cornflowerblue;" type="password" name="password" placeholder="Input Password" required></td></tr>
<tr><th>Enter Email (site maintenance account) : </th><td><input style="width:100%;height:3em;color:cornflowerblue;" type="text" name="email" placeholder="Input Email" required></td></tr>
<tr><td colspan="2"><input type="submit" value="Get Started >>" name="registration"></td></tr>
</table>
</fieldset>
</form>
</body>
</html>


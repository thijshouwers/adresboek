<?php
if(isset($_COOKIE['username']))
{
	header("Location: contactenpagina.php");
	die();
}
$host = "mysql.hostinger.nl";
$database = "u361730451_adres";
$gebruiker = "u361730451_thijs";
$wachtwoord = "iEOrBUYGW3lM";

$connection = mysqli_connect($host, $gebruiker, $wachtwoord, $database);

if(mysqli_connect_errno())
{
	die("Connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
}

//Test if there was a query error
if(isset($_POST["gebruikersnaam"], $_POST["wachtwoord"])) 
{  
	$name = $_POST["gebruikersnaam"]; 
	$password = $_POST["wachtwoord"];


	$query = "SELECT Gebruikersnaam, Wachtwoord FROM gebruikers WHERE Gebruikersnaam = '". $name ."' AND  Wachtwoord = '".$password. "'";
	$result =  mysqli_query($connection, $query);
	if(!$result)
	{
		die("Database query failed");
	}
	// $name = $_POST["gebruikersnaam"]; 
	// $password = $_POST["wachtwoord"]; 

	//$result1 = mysqli_query("SELECT Gebruikersnaam, Wachtwoord FROM gebruikers WHERE Gebruikersnaam = '".$name."' AND  password = '".$password."'");

	if(mysqli_num_rows($result) > 0 )
	{ 
		setcookie("username", base64_encode($name), time()+999999, "/");
		echo "ingelogd";
		header("Location: contactenpagina.php");
	}
	else
	{
		echo 'The username or password are incorrect!';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style type="text/css">
		body {
			background-image: url(Achtergrond.jpg);
			background-size: cover;
		}

		p {
			color:black;
			font-family:arial;
		}

		#container {
			margin:0px auto;
			width:408px;
			height:550px;
		}

		#logo {
			width:auto;
			height:auto;
			text-align:center;
			font-size: 30px;
			font-family:arial;
		}

		#logo p {
			margin: 0px;
			color: blue;
			padding:20px;
		}

		#compleetlogin {
			width:350px;
			height:auto;
			margin:0px auto;
		}

		#login {
			width:350px;
			height:60px;
			background-color:#ff9900;
		}

		img {
			width:200px;
			height:160px;
		}

		#login p {
			margin-top:0px;
			padding-top:15px;
			text-align:center;
			font-size:30px;
			font-weight:bold;
		}

		#inlogscherm {
			width:350px;
			height:300px;
			background-color:white;
			text-align:center;
			padding-top:20px;
		}

		#inlogscherm p {
			padding-top:10px;
		}

		.inlogknop {
			margin-top:60px;
			padding:10px 30px 10px 30px;
			background-color:orange;
		}
	</style>
</head>
<body>
	<div id="container">
		<div id="logo"><img src="logo.png" alt="logo"></div>
		<div id="compleetlogin">
			<div id="login"><p>Log in</p></div>
			<div id="inlogscherm">
				<form method="post">
					<p>Gebruikersnaam:</p>
					<input type="text" name="gebruikersnaam" required />

					<p>Wachtwoord:</p>
					<input type="password" name="wachtwoord" required />
					<br>
					<input type="submit" class="inlogknop" name="login" value="Login">
				</form>
			</div>	
		</div>

	</div>
</body>
</html>
<?php
mysqli_close($connection);
?>
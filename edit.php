<!DOCTYPE HTML PUBLIC>

<html>

<head>

	<title>Edit Record</title>

</head>

<body>

	<?php

// if there are any errors, display them
	$id = $_GET['id'];
	if ($error != '')

	{

		echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

	}
	echo $id;
	?>


	<form method="post">

		<input type="hidden" name="id" value="<?php echo $id; ?>"/>

		<div>

			<input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>

			<strong>Gebruikersnaam: *</strong> <input type="text" name="gebruikersnaam" value="<?php echo $Gebruikersnaam; ?>"/><br/>

			<strong>Wachtwoord: *</strong> <input type="password" name="password" value="<?php echo $Wachtwoord; ?>"/><br/>

			<strong>email: *</strong> <input type="text" name="email" value="<?php echo $email; ?>"/><br/>

			<strong>Functie: *</strong> <input type="text" name="functie" value="<?php echo $functie; ?>"/><br/>

			<p>* Required</p>

			<input type="submit" name="submit" value="Submit">

		</div>

	</form>

</body>

</html>

<?php








// connect to the database

include('connect-db.php');



// check if the form has been submitted. If it has, process the form and save it to the database


if (isset($_POST['submit']))
{

// confirm that the 'id' value is a valid integer before getting the form data


// get form data, making sure it is valid

$Gebruikersnaam = $_POST['gebruikersnaam'];
$Wachtwoord = $_POST['password'];
$functie = $_POST['functie'];
$email = $_POST['email'];

// check that firstname/lastname fields are both filled in

		if ($Gebruikersnaam == '' || $Wachtwoord == '' || $email == '' || $functie == '')

		{

// generate error message

			$error = 'ERROR: Please fill in all required fields!';



//error, display form

			renderForm($id, $gebruikersnaam, $lastname, $error, $email, $functie);

		}

		else

		{

// save the data to the database
		
			mysqli_query($connection, "UPDATE gebruikers SET Gebruikersnaam='$Gebruikersnaam', Wachtwoord='$Wachtwoord' , email='$email' , functie='$functie' WHERE id='$id'")

			or die(mysqli_error());



// once saved, redirect back to the view page

			header("Location: gebruikersbeheer.php");

		}

	}


?>
<?php

// connect to the database

include('connect-db.php');

$id = $_GET['id'];



// delete the entry

$result = mysqli_query($connection, "DELETE FROM gebruikers WHERE id=$id")

or die(mysqli_error());



// redirect back to the view page

header("Location: gebruikersbeheer.php");

?>
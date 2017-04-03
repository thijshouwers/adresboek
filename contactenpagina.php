<?php
if(!isset($_COOKIE['username']))
{
    header("Location: index.php");
    die();
}

$host = "mysql.hostinger.nl";
$database = "u361730451_adres";
$gebruiker = "u361730451_thijs";
$wachtwoord = "iEOrBUYGW3lM";

$connection = mysqli_connect($host, $gebruiker, $wachtwoord, $database);

$query = "SELECT * FROM `gebruikers`";
$result =  mysqli_query($connection, $query);

if(mysqli_connect_errno())
{
    die("Connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gebruikersbeheer</title>
    
    <style type="text/css">
        body {
            background-image:url(Achtergrond.jpg);
            background-size:cover;

        }

        /* containers */
        #container {
            width:1500px;
            height:auto;
            margin: 0px auto;
        }
        #content {
            width:1100px;
            height:500px;
            margin-left:50px;
            margin-right:50px;
            background-color:white; 
        }
        /* divisies */
        #contentheader {
            width:1100px;
            height:50px;
            background-color:#FF9900;
        }
        #contentheader h1 {
            color:white;
            font-size:24px;
            font-family:Arial, Helvetica, sans-serif;
            text-align: center;
            margin: 0px auto;
        }
        #header {
            width:1200px;
            height:150px;   
        }
        #imgheader {
            width:197px;
            height:150px;   
            background-image:url(Logo.png);
            background-size:cover;
            float:left;
        }
        /* classes/aanpassingen */
        .accountrechten {
            color:white;
            font-size:36px;
            font-family:Arial, Helvetica, sans-serif;
            font-weight:bold;
            font-style:italic;
            padding-left:120px;
            margin-top:75px;
            margin-left:0px;
            margin-bottom:0px;
            float:left;
            text-decoration:none;    
        }
        .topsearchbar {
            width:365px;
            float:right;
            margin-top:83px;
            float:right;
            margin-left:75px;  
        }
        #logoutbutton {
            width:96px;
            height:29px;
            border-radius:8px;
            background-color:#FF9900;
            float:right;
            margin-right:50px;
            margin-top:50px;
            text-align:center;

        }
        #logoutbutton a {
            color:white;
            text-decoration:none;
            padding-top:5px;
        }
        #addusers {
            width:1100px;
            height:500px;
            margin-top:100px; 
        }
        #addusers h1 {
            color:white;
            font-family:Arial, Helvetica, sans-serif;
            margin-left:50px;
            font-size:24px;     
        }
        table {

            color:white;
            font-family:Arial, Helvetica, sans-serif;      
        }
        .ondersubmit{
            width:140px;
            height:40px;
            background-color:#ff9900;
            border-radius:25px;
            color:white;
            border: none;
        }
        .zoeksubmit {
            position: absolute;
            width: 20px;
            height: 20px;
        }
        #content table {
            color: black;
            padding-left: 15px;
            padding-top: 5px;
            margin: 20px;
            width: 200px;
            border-collapse: collapse;
            border:none;
        }
        #content td{
            margin: 20px;
            padding-left: 50px;
            width: 200px;
        }
        .headtabel {
            padding-right: 60px;
        }
        #content th{
            margin: 20px;
            padding-right: 40px;
            min-width: 200px;
            margin-left: 50px;
        }
        .aanpas{
            border: none;
        }
    </style>
</head>
<!-- De structuur
*************
*************
*************-->
<body>
    <div id="container">
     <div id="header">
         <div id="imgheader">
         </div>
         <a href="#" class="accountrechten">Accountrechten</a>
         <div id="logoutbutton">
            <a href="index.php?log=out">Uitloggen</a>
            <?php 
                if ($_GET['log'] == 'out') {
                    session_destroy();

                    if (isset($_SESSION['username'])) {
                        usset($_SESSION['username']);
                    }
                }
             ?>
        </div>

        <form>
            <span class="topsearchbar"><input type="text" name="topsearch" size="25"/> 
                <input type="image" class="zoeksubmit" src="search-logo.png" border="0" alt="submit"/>

            </form>
        </div>

        <div id="content">
           <div id="contentheader">
            <h1>Gebruikers/admins</h1>
        </div>
        <table border="2">
            <tr class="headtabel">
                <th class="tabel">Gebruikersnaam</th>
                <th class="tabel">Email</th>
                <th class="tabel">Functie</th>
            </tr>
            <?php 
            if (!empty($_POST['versturen'])) {


                $Gebruikersnaam = $_POST['gebruikersnaam'];
                $Wachtwoord = $_POST['password'];
                $functie = $_POST['functie'];
                $email = $_POST['email'];

                $query = "INSERT INTO `gebruikers` (`Gebruikersnaam`, `Wachtwoord`, `functie`, `email`) 
                VALUES('$Gebruikersnaam' ,'$Wachtwoord', '$functie', '$email')";
                mysqli_query($connection, $query) or die(mysqli_error($connection));


            }

            ?>
            <?php
            while ($row = mysqli_fetch_assoc($result))
            {
                ?>
                <tr>  
                    <?php echo "<tr><td>".$row['Gebruikersnaam']."</td>";
                    ?>
                    <td class="tabel"><?=$row['email'];?></td>
                    <td class="tabel"><?=$row['functie'];?></td>
                    <?php
                    echo '<td><a href="edit.php?id=' . $row['id'] . '">Edit</a></td>';

                    echo '<td><a href="delete.php?id=' . $row['id'] . '">Delete</a></td>';
                    ?>
                </tr>
                

                <?php 
            }
            ?>
        </table>
    </div>
    <div id="addusers">
        <h1>Voeg gebruiker toe:</h1>
        <br>
        <form action="gebruikersbeheer.php" method="post">
            <table>
                <tr>
                 <td>Gebruikersnaam:</td>
                 <td><input type="text" name="gebruikersnaam"> </td> 
             </tr>
             <tr>
                 <td>Wachtwoord:</td>
                 <td><input type="password" name="password"> </td>
             </tr>
             <tr>
                 <td>E-mail:</td>
                 <td><input type="text" name="email"> </td>
             </tr>
             <tr> 
                 <td>functie:</td>
                 <td><input type="text" name="functie"></td>
             </tr>

             <tr>
                 <td><input type="submit" name="versturen" value="Versturen" class="ondersubmit"></td>
                 
             </tr>
         </table>
     </form>
 </div>
</div>
</body>
</html>
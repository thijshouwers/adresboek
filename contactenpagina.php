<?php
$host = "mysql.hostinger.nl";
$database = "u361730451_adres";
$gebruiker = "u361730451_thijs";
$wachtwoord = "iEOrBUYGW3lM";

$connection = mysqli_connect($host, $gebruiker, $wachtwoord, $database);

// sorteerfunctie
if ($_POST['sorteren'] {
            switch ( sorteer ) 
            {
                case 'voornaam':                    
                    $query = "SELECT * FROM adressen ORDER BY voornaam ASC";
                    break;
                
                case 'achternaam':
                    $query = "SELECT * FROM adressen ORDER BY achternaam ASC";
                    break;

                case 'plaats':
                    $query = "SELECT * FROM adressen ORDER BY plaats ASC";
                    break;

                case 'adres':
                    $query = "SELECT * FROM adressen ORDER BY adres ASC";
                    break;

                case 'postcode':
                    $query = "SELECT * FROM adressen ORDER BY postcode ASC";
                    break;
            }  
            else          
            {
                $query = "SELECT * FROM `adressen`";
            }    
}

$query = "SELECT * FROM `adressen`";
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
    <title>PHP Project</title>
    <style>

        @charset "utf-8";

        /* CSS Document*/

        body {
            background-image: url(../../../../../../xamppp/htdocs/PHP/Periode%203/Achtergrond.jpg);
            background-size: cover;
        }

        #container {
            width: 1500px;
            height: auto;
            margin: 0 auto;
        }

        #header {
            width: 1500px;
            height: 150px;
        }

        #logo {
            width: 174px;
            height: 112px;
            background-image: url(../../../../../../xamppp/htdocs/PHP/Periode%203/logo.png);
            background-size: cover;
            background-repeat: no-repeat;
            float: left;
        }

        #content {
            width: 1500px;
            height: 500px;
        }

        #droplist {
            width: 400px;
            height: 150px;
            float: left;
        }

        #rechten{
            width: 600px;
            height: 150px;
            float: left;
        }
        #toevoegen{
            width: 1500px;
            height: 150px;
            float: none;
        }
        table {
            padding: 50px;
            border-color: gray;
            border-collapse: collapse;
            border: solid;
            border-width: 1px;
        }

        td {
            width: 200px;
            height: 30px;
            background-color: white;
            padding: 5px;
            border-color: gray;
            border-collapse: collapse;
            border: solid;
            border-width: 1px;
        }

        th {
            background-color: #ff9900;
            color: white;
            height: 30px;
            width: 200px;
            padding: 5px;
            border-color: gray;
            border-collapse: collapse;
            border: solid;
            border-width: 1px;
            text-align: left;
        }

        input {
            width: 250px;
            margin-left: 50px;
        }

        button {
            width: 100px;
            height: 30px;
            background-color: #ff9900;
            color: white;
            border-radius: 5px;
            margin-top: 30px;
            margin-bottom: 30px;
            margin-left: 50px;
            float: left;
        }

        .beheer {
            width: 100px;
            height: 30px;
            background-color: #ff9900;
            color: white;
            border-radius: 5px;
            margin-top: 30px;
            margin-bottom: 30px;
            margin-left: 50px;
            float: left;
        }

        select {
            margin-top: 100px;
            margin-left: 50px;
        }

        p{
            color: #ff9900;
            margin-top: 75px;
            font-size: 36px;
        }

        .zoek {

        }

    </style>
</head>

<body>
    <div id="container">
        <div id="header">
            <div id="logo"></div>            
            <div id="droplist">
            <form action="" method="post">
                <select name="sorteer">
                    <option value="sorteerop">Sorteer op:</option>
                    <option value="voornaam">Voornaam</option>
                    <option value="achternaam">Achternaam</option>
                    <option value="plaats">Plaats</option>
                    <option value="adres">Adres</option>
                    <option value="postcode">Postcode</option>
                </select>
                <input type="submit" value="sorteren" name="sorteren">
            </form>
            </div>
            
            <div id="rechten">
                <p>Adresboek</p>
            </div>
            <form action="../../../../../../xamppp/htdocs/PHP/Periode 3/gebruikersbeheer.php">
                <input type="submit" name="beheer" class="beheer" value="Beheer">
            </form>
            <button type="button">Uitloggen</button>
            <form>
                <input type="text" name="zoek" placeholder="zoeken" class="zoek"> </form>
            </div>
            <div id="content">
                <table border="1">
                    <tr class="oranje">
                        <th>Voornaam</th>
                        <th>Tussenvoegsel</th>
                        <th>Achternaam</th>
                        <th>Tel. nummer</th>
                        <th>Plaats</th>
                        <th>Adres</th>
                        <th>Postcode</th>
                        <th>Afbeelding</th>
                        <th>Opmerking</th>
                    </tr>
                    <tr id="wit">
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {

                            echo "<td>" . $row['Voornaam'] . "</td>";
                            echo "<td>" . $row['Tussenvoegsel'] . "</td>";
                            echo "<td>" . $row['Achternaam'] . "</td>";
                            echo "<td>" . $row['Plaats'] . "</td>";
                            echo "<td>" . $row['Tel'] . "</td>";
                            echo "<td>" . $row['Adres'] . "</td>";
                            echo "<td>" . $row['Postcode'] . "</td>";
                            echo "<td>" . $row['Opmerking'] . "</td>";
                            echo "</tr>";
                        }

        //mysqli_free_result($result);
                        ?>
                    </table>
                </div>
                <div id="toevoegen"></div>
            </div>
        </body>

        </html>
        <?php
        mysqli_close($connection);
        ?>
<?php
session_start();
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="logo.png" />
    <style>
        body {
            background: url("bg.png") no-repeat top;
        }

        .container {
            font-weight: bolder;
            background: rgba(250, 250, 250, 0.4);
        }
    </style>
</head>


<body>
    <?php
    $servername = "localhost";
    $username   = "kevin";
    $password   = "pass";
    $dbname     = "esport";

    include("nav.html");
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //echo "Connected successfully";
    $sql = "SELECT evenement.id_e, evenement.nom as nom, evenement.date, evenement.jeu, evenement.description, evenement.ouvert, organisateur.nom as orga FROM evenement, organisateur WHERE evenement.id_o=organisateur.id_o";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<div class="container text-center">
        <h4>Liste des evenements</h4>
        <table class="table table-striped">
        <thead>
            <tr>
                <th>id_e</th>
                <th>nom</th>
                <th>date</th>
                <th>jeu</th>
                <th>description</th>
                <th>ouvert?</th>
                <th>organisateur</th>
            </tr>
        </thead>';
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {

            echo "<tr><td>" . $row["id_e"] . "</td>" .
                "<td>" . $row["nom"] . "</td>" .
                "<td>" . $row["date"] . "</td>" .
                "<td>" . $row["jeu"] . "</td>" .
                "<td>" . $row["description"] . "</td>" ;
            if($row["ouvert"] == 1) {
                echo "<td>OPEN</td>" ;
            } else {
                echo "<td>CLOSE</td>";
            }
            echo "<td>" . $row["orga"] . "</td></tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "Aucune donnés n'a pu être récupéré.";
    }
    ?>
    </div>
</body>
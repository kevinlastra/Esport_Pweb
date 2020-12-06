<?php
session_start();
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="logo.png" />
    <style>
        span {
            margin: 2%;
        }
        body {
            background: url("bg.png") no-repeat top;
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
    $sql = "SELECT id_t, nombre_joueur, description, id_e, type, niveau FROM tournoi, typetournoi WHERE tournoi.id_tt=typetournoi.id_tt;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<div class="card text-center">
        <div class="card-header"><h1>L\'event n°' . $_GET['event'] . '</h1></div>';
        while ($row = $result->fetch_assoc()) {
            if ($_GET['event'] == $row['id_e']) {
                echo '<div class="card-body">
                <h5 class="card-title">Tournoi '. $row['id_t']. " de type " . $row['type'] .'</h5>
                <p class="card-text">'. $row["description"] .'</p>
                <hr>
                <p class="card-text">Niveau : '. $row["niveau"] .'</p>
                <hr>
                <p class="card-text">Nombre de joueur : '. $row["nombre_joueur"] .'</p>
                <a href="#" class="btn btn-primary">S\'inscrire</a>
            </div>';
            }
        }
        echo "</div>";
    }
    ?>
</body>
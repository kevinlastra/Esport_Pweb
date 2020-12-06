<?php
session_start();
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        body {
            background: url("bg.png") no-repeat top;
        }

        #info {
            margin: 2%;
            text-align: center;
        }

        #button {
            font-size: 130%;
        }
    </style>
    <link rel="icon" type="image/png" href="logo.png" />
</head>

<body>
    <?php
    include("nav.html");

    $servername = "localhost";
    $username   = "kevin";
    $password   = "pass";
    $dbname     = "esport";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //echo "Connected successfully";
    $sql = "SELECT * FROM evenement";
    $result = $conn->query($sql);
    echo "<div class='container'>";
    if ($result->num_rows > 0) {
        $col = 0;
        echo "<div class='row'>";
        while ($row = $result->fetch_assoc()) {
            echo '<div class ="col" id="info">
            <div class="card" style="width: 18rem;">
            <div class="card-body">
            <h3 class="card-title"> Event n°' . $row['id_e'] . '</h3>
            <hr>
            <h4>' . $row['jeu'] . '</h4>
            <hr>
            <p class="card-text">' . $row['description'] . '</p>
            <a class="btn btn-primary" id="button" href="event.php?event=' . $row['id_e'] . '">Voir l\'évenement</a>
            </div></div></div>';
            if (($col % 2) != 0) {
                echo "</div><div class='row'>";
            }
            
            $col++;
            
        }
        echo "</div>";
    } else {
        for ($i = 0; $i < 100; $i++) {
            echo "fuck";
        }
    }
    ?>

</body>
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
    </style>
</head>

<body>
    <?php
    include("nav.html");
    $servername = "localhost";
    $username   = "kevin";
    $password   = "pass";
    $dbname     = "esport";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT id_e as event, id_o FROM evenement";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($_SESSION['id'] == $row['id_o']) {
                $_SESSION['id_e'] = $row['event'];
                echo '
                    <div class="card">
                    <div class="card-body">
                        ';
                include("create-tournament.php");
                echo '
                    </div>
                    </div>
                    ';
            }
        }
    }
    ?>

</body>
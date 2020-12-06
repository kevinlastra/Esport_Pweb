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

    $sql = "SELECT COUNT(*) as nombre FROM `evenement` WHERE 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['event'] = $row['nombre'] + 1;
        }
    }

    $a = htmlspecialchars(trim($_SESSION['event']));
    $b = htmlspecialchars(trim($_SESSION['id']));
    $e = htmlspecialchars(trim($_POST['nom_event']));
    $f = htmlspecialchars(trim($_POST['date']));
    $g = htmlspecialchars(trim($_POST['jeu']));
    $h = $conn->real_escape_string(htmlspecialchars(trim($_POST['desc'])));

    if ($e != null) {
        $sql2 = "INSERT INTO evenement(id_e, nom, date, jeu, description, ouvert, id_o) 
        VALUES ('$a','$e','$f','$g','$h','1','$b')";
        mysqli_query($conn, $sql2);
    }

    ?>
    <div class="card" style="margin: 3%;">
        <div class="card-header" style="text-align: center;">
            <h2 style="text-transform: uppercase;">
                Information evenement
            </h2>
        </div>
        <div class="card-body">
            <form method="post" action="create.php">
                <div class="form-row">
                    <div class="col">
                        <label for="validationDefaultUsername">Nom</label>
                        <div class="input-group">
                            <input type="text" name="nom_event" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" required>
                        </div>
                    </div>
                    <div class="col">
                        <label for="validationDefaultUsername">Date</label>
                        <div class="input-group">
                            <input type="date" name="date" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" required>
                        </div>
                    </div>
                    <div class="col">
                        <label for="validationDefaultUsername">Jeu</label>
                        <div class="input-group">
                            <input type="text" name="jeu" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" required>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="validationDefaultUsername">Description</label>
                        <div class="input-group">
                            <textarea type="text" name="desc" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" required>
                            </textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-row justify-content-center">
                    <div class="col">
                        <button class="btn btn-primary" type="submit">Créer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
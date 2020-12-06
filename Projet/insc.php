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

    $sqla = "SELECT COUNT(*) as nombre FROM `organisateur` WHERE 1";
    $result = $conn->query($sqla);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['orga'] = $row['nombre'] + 1;
        }
    }


    $sqlb = "SELECT nom FROM `organisateur` WHERE 1";
    $result = $conn->query($sqlb);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($_POST['nom_orga'] == $row['nom']) {
                $_POST['nom_orga'] = null;
                echo 'Cet organisateur existe deja!';
            }
        }
    }
    
    $b = htmlspecialchars(trim($_SESSION['orga']));
    $c = htmlspecialchars(trim($_POST['nom_orga']));
    $d = $conn->real_escape_string(htmlspecialchars(trim($_POST['mdp_orga'])));

    if ($c != null) {
        $sql1 = "INSERT INTO organisateur(id_o,nom,mot_de_passe) 
        VALUES ('$b','$c','$d')";
        mysqli_query($conn, $sql1);
        echo "Organisateur créé!";
    }

    echo '
    <div class="card">
    <div class="card-header">
    S\'inscrire
    </div>
    <div class="card-body">
    <form method="post" action="insc.php">
    <div class="form-group">
    <label for="validationDefault01">Nom organisateur</label>
    <input type="text" name="nom_orga" class="form-control" id="validationDefault01" required>
    </div>
    <div class="form-group">
    <label for="validationDefault02">Mot de passe</label>
    <input type="password" name="mdp_orga" class="form-control" id="validationDefault02" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
    </div>
    ';
    ?>

</body>
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

    if ($_POST['nom'] != null && $_POST['password'] != null) {
        $_SESSION['nom'] = $_POST['nom'];
        $_SESSION['mdp'] = $_POST['password'];
    }

    $sql = "SELECT id_o, nom, mot_de_passe as mdp FROM organisateur WHERE 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        if ($_SESSION['nom'] != null && $_SESSION['mdp'] != null) {

            while ($row = $result->fetch_assoc()) {

                if ($_SESSION['nom'] == $row['nom'] && $_SESSION['mdp'] == $row['mdp']) {
                    $_SESSION['id'] = $row['id_o'];
                    $_SESSION['co'] = true;
                    echo '
                    Vous etes connecté!
                    ';
                } 
            }
        }
    }

    if ($_SESSION['co']) {
        echo '
        <div class="card">
        <div class="card-header" style="text-align: center">
        <h3>
        Connecté
        </h3>
        </div>
        <div class="card-body">

        <div style="text-align: center">
        <h5 class="card-title">Créer</h5>
        <p class="card-text">Cliquez sur ce lien pour pouvoir aller créer des events.</p>
        <a href="create.php" class="card-link">Créer évent</a>
        </div>
        
        <hr>
        
        <div style="text-align: center">
        <h5 class="card-title">Administration</h5>
        <p class="card-text">Cliquez sur ce lien pour pouvoir aller gérer vos events.</p>
        <a href="control-event.php" class="card-link">Gérer évent</a>
        </div>

        </div>
        ';
    }

    if (!$_SESSION['co']) {
        echo '
            <div class="card">
            <div class="card-header">
                Se connecter
            </div>
            <div class="card-body">
                <form method="post" action="conn.php">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nom</label>
                        <input type="text" name="nom" class="form-control" id="validationDefault01" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="validationDefault02" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    ';
    }
    
    ?>

</body>
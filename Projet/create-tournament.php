<style>
    h4 {
        margin: auto;
        width: 50%;
        padding: 10px;
        text-align: center;
    }
</style>
<?php
    $servername = "localhost";
    $username   = "kevin";
    $password   = "pass";
    $dbname     = "esport";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo $_POST['type'] . $_POST['level'] . $_POST['team'] . $_POST['desc'];

?>
<div class="card" style="margin: 3%;">
    <div class="card-header" style="text-align: center;">
        <h2 style="text-transform: uppercase;">
            Creer tournoi
        </h2>
    </div>
    <div class="card-body">
        <form method="post" action="control-event.php">
            <div class="form-row">
                <h4>
                    Type de tournoi
                </h4>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="validationDefault01">Type</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Options</label>
                        </div>
                        <select class="custom-select" name="type" id="inputGroupSelect01">
                            <option selected>Choisissez...</option>
                            <option value="1">1v1</option>
                            <option value="2">2v2</option>
                            <option value="3">3v3</option>
                            <option value="4">4v4</option>
                            <option value="5">5v5</option>
                            <option value="6">6v6</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <label for="validationDefault02">Niveau</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Options</label>
                        </div>
                        <select class="custom-select" name="level" id="inputGroupSelect01">
                            <option selected>Choisissez...</option>
                            <option value="1">Debutant</option>
                            <option value="2">Mixte</option>
                            <option value="3">Moyen</option>
                            <option value="4">Pro</option>
                        </select>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-row">
                <h4>
                    Détail du tournoi
                </h4>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="validationDefault01">Nombre d'équipe</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Options</label>
                        </div>
                        <input type="number" min="2" max="64" name="team" class="form-control" id="validationDefault02" required>
                    </div>
                </div>
                <div class="col">
                    <label for="validationDefaultUsername">Description</label>
                    <div class="input-group">
                        <textarea type="text" name="desc" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" required></textarea>
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
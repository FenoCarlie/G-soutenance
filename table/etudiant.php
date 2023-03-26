<?php require '../require/connection_DB.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../fontawesome/css/all.min.css" rel="stylesheet"/>
    <title>Document</title>
    <style>
        .navbar {
            background-color: #2bc791;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid mt-2">
            <a class="navbar-brand" href="../index.php">GESTION DES SOUTENANCES</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown link
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="./organisme.php">organisme</a></li>
                            <li><a class="dropdown-item" href="./professeur.php">Professeur</a></li>
                            <li><a class="dropdown-item" href="./soutenir.php">soutenir</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="d-flex">
                <ul class="navbar-nav">
                    <a href="../login/index_login.php"><button type="button" class="btn btn-outline-dark">Connecter</button></a>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        
        <?php

            $sql = "SELECT * FROM etudiant";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                echo '<div class="text-center m-2 "><h1>TABLES ETUDIANT</h1></div>';
                echo '<table class="table table-hover text-center m-3">';
                echo '<thead>';
                echo '<tr class="table-dark">
                        <th scope="col">Matricule</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénoms</th>
                        <th scope="col">Niveau</th>
                        <th scope="col">Parcours</th>
                        <th scope="col">Adresse mail</th>
                    </tr>';
                echo '</thead>';
                echo '<tbody>';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                            <td>' . htmlspecialchars($row['matricule']) . '</td>
                            <td>' . htmlspecialchars($row['nom']) . '</td>
                            <td>' . htmlspecialchars($row['prenoms']) . '</td>
                            <td>' . htmlspecialchars($row['niveau']) . '</td>
                            <td>' . htmlspecialchars($row['parcours']) . '</td>
                            <td>' . htmlspecialchars($row['adr_email']) . '</td>
                        </tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<div class="alert alert-dark mt-3" role="alert"><p class="h1">Aucun étudiant inscrit</p></div>';
            }
        ?>
    </div>
    <script src="../fontawesome/js/all.min.js"></script>
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>
</html>
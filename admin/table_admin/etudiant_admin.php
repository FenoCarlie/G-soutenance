<?php require '../../require/connection_DB.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../DataTables/datatables.min.css" rel="stylesheet"/>
    <link href="../../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../../fontawesome/css/all.min.css" rel="stylesheet"/>
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
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
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
            </li>
        </ul>
        </div>
    </div>
    </nav>
    <div class="container">
        <?php
            $sql = "SELECT * FROM etudiant";
            $result = mysqli_query($conn, $sql);
            
            // Afficher les données dans une table HTML
            
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo '<table class="table table-hover">';
                    echo '<thead>';
                    echo '<tr>
                            <th scope="col">Matricule</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénoms</th>
                            <th scope="col">Niveau</th>
                            <th scope="col">Parcours</th>
                            <th scope="col">Adresse mail</th>
                            <th scope="col">action</th>
                            </tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    echo '<tr>
                            <td>' . $row['matricule']. '</td>
                            <td>' . $row['nom']. '</td>
                            <td>' . $row['prenoms']. '</td>
                            <td>' . $row['niveau']. '</td>
                            <td>' . $row['parcours']. '</td>
                            <td>' . $row['adr_email']. '</td>
                            <td>
                            <a href="" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3" style="color: #2766d3;"></i></a>
                            <a href="" class="link-dark"><i class="fa-solid fa-trash fs-5 me-3" style="color: #d12335;"></i></i></a>
                            <a href="" class="link-dark"><button type="button" class="btn btn-info">Soutenir</button></i></a>

                            </td>
                        </tr>';
                    echo '</tbody>';
                }
            } else {
                echo '<div class="alert alert-dark" role="alert"><p class="h1">Aucun etudiant inscrit</p></div>';
            }
            
            echo "</table>";
        ?>
    </div>
    <script src="../../fontawesome/js/all.min.js"></script>
    <script src="../../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>
</html>
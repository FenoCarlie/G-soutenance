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
    <div class="container-fluid mt-2">
        <a class="navbar-brand" href="../admin.php">GESTION DES SOUTENANCES</a>
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
                <li><a class="dropdown-item" href="../table_admin/etudiant_admin.php">Etudiant</a></li>
                <li><a class="dropdown-item" href="../table_admin/professeur_admin.php">Professeur</a></li>
                <li><a class="dropdown-item" href="../table_admin/soutenir_admin.php">soutenir</a></li>
            </ul>
            </li>
        </ul>
        </div>
    </div>
    </nav>
    <div class="container mt-3">
        
        <?php
        if (isset($_GET['msg'])) {
            $msg = htmlspecialchars($_GET['msg']);
            echo '<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                    '.$msg.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        ?>
        <a class="btn btn-outline-secondary mt-3" href="../../admin/add_new/add_organisme.php" role="button">Ajouter un nouvele organisme</a>
        
        <?php

            $sql = "SELECT * FROM organisme";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                echo '<div class="text-center m-2 "><h1>TABLES ORGANISME</h1></div>';
                echo '<table class="table table-hover text-center m-3">';
                echo '<thead>';
                echo '<tr>
                        <th scope="col">Designation</th>
                        <th scope="col">Lieu</th>
                        <th scope="col">action</th>
                    </tr>';
                echo '</thead>';
                echo '<tbody>';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                            <td>' . htmlspecialchars($row['design']) . '</td>
                            <td>' . htmlspecialchars($row['lieu']) . '</td>
                            <td style="display: flex; justify-content: center;">
                                <form action="../modif/modif_organisme.php?idorg='. htmlspecialchars($row["idorg"]) .'" method="POST">
                                    <input type="hidden" name="idorg" value="' . htmlspecialchars($row['idorg']) . '">
                                    <button type="submit" class="btn btn-link" ><i class="fa-solid fa-pen-to-square fs-5" style="color: #2766d3;"></i></button>
                                </form>
                                <form action="../delet/delet_organisme.php?idorg='. htmlspecialchars($row["idorg"]) .'" method="POST" onsubmit="return confirm(\'Êtes-vous sûr de vouloir supprimer cet organisme ?\')">
                                    <input type="hidden" name="idorg" value="' . htmlspecialchars($row['idorg']) . '">
                                    <button type="submit" class="btn btn-link"><i class="fa-solid fa-trash fs-5" style="color: #d12335;"></i></button>
                                </form>
                            </td>
                        </tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<div class="alert alert-dark mt-3" role="alert"><p class="h1">Aucun organisme inscrit</p></div>';
            }
        ?>
    </div>
    <script src="../../fontawesome/js/all.min.js"></script>
    <script src="../../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>
</html>
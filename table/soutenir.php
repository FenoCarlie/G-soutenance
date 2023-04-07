<?php require '../require/connection_DB.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../DataTables/datatables.min.css" rel="stylesheet"/>
    <link href="../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../fontawesome/css/all.min.css" rel="stylesheet"/>
    <link href="../DataTables/DataTables-1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
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
                        <li><a class="dropdown-item" href="./etudiant.php">etudiant</a></li>
                        <li><a class="dropdown-item" href="./organisme.php">organisme</a></li>
                        <li><a class="dropdown-item" href="./professeur.php">Professeur</a></li>
                        <li><a class="dropdown-item" href="./note.php">Note</a></li>
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
        if (isset($_GET['msg'])) {
            $msg = htmlspecialchars($_GET['msg']);
            echo '<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                    '.$msg.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        ?>
        <?php

            $sql = "SELECT soutenir.id as s_id, soutenir.note as s_note, soutenir.annee_univ as s_annee_univ,
                           soutenir.matricule as s_matricule, etudiant.nom as e_nom, etudiant.prenoms as e_prenoms, etudiant.niveau as e_niveau, etudiant.parcours as e_parcours,
                           organisme.design as o_design,
                           p1.civilite as president_civilite, p1.nom as president_nom, p1.prenoms as president_prenoms,
                           p2.civilite as examinateur_civilite, p2.nom as examinateur_nom, p2.prenoms as examinateur_prenoms,
                           p3.civilite as r_ext_civilite, p3.nom as r_ext_nom, p3.prenoms as r_ext_prenoms, soutenir.rapporteur_ext as s_r_ext
            FROM soutenir
            JOIN etudiant ON soutenir.matricule = etudiant.matricule
            JOIN organisme ON soutenir.idorg = organisme.idorg
            JOIN professeur p1 ON soutenir.president = p1.idprof
            JOIN professeur p2 ON soutenir.examinateur = p2.idprof
            JOIN professeur p3 ON soutenir.rapporteur_int = p3.idprof";
            $stmt = mysqli_prepare($conn, $sql);
            if (!$stmt) {
                die(mysqli_error($conn));
            }
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                echo '<div class="text-center m-2 "><h1>TABLES  SOUTENUE</h1></div>';
                echo '<table id="soutenance" class="table table-hover text-center m-3">';
                echo '<thead>';
                echo '<tr class="table-dark">
                        <th scope="col">Matricule</th>
                        <th scope="col">Etudiant</th>
                        <th scope="col">Parcour et Niveau</th>
                        <th scope="col">Organisme</th>
                        <th scope="col">Président des jurys</th>
                        <th scope="col">Examinateur</th>
                        <th scope="col">Rapporteur interne</th>
                        <th scope="col">rapporteur externe</th>
                        <th scope="col">Note</th>
                        <th scope="col">Annee_univ</th>
                        <th scope="col">Action</th>
                    </tr>';
                echo '</thead>';
                echo '<tbody>';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                            <td>' . htmlspecialchars($row['s_matricule']) . '</td>
                            <td>' . htmlspecialchars($row['e_nom'] . ' ' . $row['e_prenoms']) . '</td>
                            <td>' . htmlspecialchars($row['e_parcours'] . ' en ' . $row['e_niveau']) . '</td>
                            <td>' . htmlspecialchars($row['o_design']) . '</td>
                            <td>' . htmlspecialchars($row['president_civilite'] . ' ' . $row['president_nom']) .  ' ' . $row['president_prenoms'] .'</td>
                            <td>' . htmlspecialchars($row['examinateur_civilite'] . ' ' . $row['examinateur_nom']) .  ' ' . $row['examinateur_prenoms'] .'</td>
                            <td>' . htmlspecialchars($row['r_ext_civilite'] . ' ' . $row['r_ext_nom']) .  ' ' . $row['r_ext_prenoms'] .'</td>
                            <td>' . htmlspecialchars($row['s_r_ext']) . '</td>
                            <td>' . htmlspecialchars($row['s_note']) . '</td>
                            <td>' . htmlspecialchars($row['s_annee_univ']) . '</td>
                            <td style="row row-cols-auto">
                                <form class="col" action="../fpdf/generpdf.php?id='. htmlspecialchars($row["s_id"]) .'" method="POST" style="display: inline">
                                    <input type="hidden" name="id" value="' . htmlspecialchars($row['s_id']) . '">
                                    <button type="submit" class="btn btn-info">PDF</button>
                                </form>
                            </td>
                        </tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<div class="alert alert-dark mt-3" role="alert"><p class="h1">Aucun soutenance inscrit</p></div>';
            }
        ?>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../fontawesome/js/all.min.js"></script>
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../DataTables/DataTables-1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="../DataTables/DataTables-1.13.4/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#soutenance').DataTable();
        });
    </script>
</body>
</html>
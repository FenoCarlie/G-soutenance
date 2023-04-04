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
                        <li><a class="dropdown-item" href="./etudiant.php">Etudiant</a></li>
                        <li><a class="dropdown-item" href="./organisme.php">Organisme</a></li>
                        <li><a class="dropdown-item" href="./professeur.php">Professeur</a></li>
                        <li><a class="dropdown-item" href="./soutenir.php">Soutenir</a></li>
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
            function DeuxDate($date) {
                $dates = explode('-', $date);
                $date_deb = $dates[0];
                $date_fin = $dates[1];
                return array($date_deb, $date_fin);
            }
            if((isset($_POST['submit']))){
            
                if (isset($_POST['date_in_deb'])) {
                    $date_in_deb = $_POST['date_in_deb'];
                } else {
                    $date_in_deb = "";
                }
                
                if (isset($_POST["date_in_fin"])) {
                    $date_in_fin = $_POST['date_in_fin'];
                } else {
                    $date_in_fin = "";
                }
            
                if (empty($date_in_deb) || empty($date_in_fin)) {
                    $error_msg = "Aucune date n'a été inscrite";
                    $sql_deb = "SELECT soutenir.id as s_id, soutenir.note as s_note, soutenir.annee_univ as s_annee_univ,
                soutenir.matricule as s_matricule, etudiant.nom as e_nom, etudiant.prenoms as e_prenoms, etudiant.niveau as e_niveau, etudiant.parcours as e_parcours
                FROM soutenir
                JOIN etudiant ON soutenir.matricule = etudiant.matricule";

                $stmt_deb = mysqli_prepare($conn, $sql_deb);
                mysqli_stmt_execute($stmt_deb);
                $result_deb = mysqli_stmt_get_result($stmt_deb);

                if (mysqli_num_rows($result_deb) > 0) {
                    echo '<div class="text-center m-2 "><h1>TABLES ETUDIANT</h1></div>';
                    $msg = htmlspecialchars($error_msg, ENT_QUOTES);
                    echo '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        '.$msg.'
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                    echo '<form action="" method="POST">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Annee debut</label>
                                    <input type="number" class="form-control" name="date_in_deb" placeholder="Ex: 2023" value="">
                                </div>
                                <div class="col">
                                    <label class="form-label">Annee fin</label>
                                    <input type="number" class="form-control" name="date_in_fin" placeholder="Ex: 2024" value="">
                                </div>
                                    <button type="submit" name="submit" class="btn btn-outline-secondary">Rechercher</button>
                            </div>
                        </form>';
                    echo '<table class="table table-hover text-center m-3">';
                    echo '<thead>';
                    echo '<tr class="table-dark">
                            <th scope="col">Annee_univ</th>
                            <th scope="col">Matricule</th>
                            <th scope="col">Etudiant</th>
                            <th scope="col">Parcour et Niveau</th>
                            <th scope="col">Note</th>
                        </tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = mysqli_fetch_assoc($result_deb)) {
                        echo '<tr>
                                <td>' . htmlspecialchars($row['s_annee_univ']) . '</td>
                                <td>' . htmlspecialchars($row['s_matricule']) . '</td>
                                <td>' . htmlspecialchars($row['e_nom'] . ' ' . $row['e_prenoms']) . '</td>
                                <td>' . htmlspecialchars($row['e_parcours'] . ' en ' . $row['e_niveau']) . '</td>
                                <td>' . htmlspecialchars($row['s_note']) . '</td>
                            </tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                }
                } else {
                    if ($date_in_deb < $date_in_fin) {
                        list($date_deb, $date_fin) = DeuxDate("$date_in_deb-$date_in_fin");
                        echo "Date de début : " . $date_deb . "<br>";
                        echo "Date de fin : " . $date_fin . "<br>";
                        $sql = "SELECT soutenir.id as s_id, soutenir.note as s_note, soutenir.annee_univ as s_annee_univ,
                                soutenir.matricule as s_matricule, etudiant.nom as e_nom, etudiant.prenoms as e_prenoms, etudiant.niveau as e_niveau, etudiant.parcours as e_parcours
                                FROM soutenir
                                JOIN etudiant ON soutenir.matricule = etudiant.matricule";
                        $result = mysqli_query($conn, $sql);
                        
                        if (mysqli_num_rows($result) > 0) {
                            echo '<div class="text-center m-2 "><h1>TABLES ETUDIANT</h1></div>';
                            echo '<form action="" method="POST">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Annee debut</label>
                                            <input type="number" class="form-control" name="date_in_deb" placeholder="Ex: 2023" value="">
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Annee fin</label>
                                            <input type="number" class="form-control" name="date_in_fin" placeholder="Ex: 2024" value="">
                                        </div>
                                            <button type="submit" name="test" class="btn btn-outline-secondary">Rechercher</button>
                                    </div>
                                </form>';
                            echo '<table class="table table-hover text-center m-3">';
                            echo '<thead>';
                            echo '<tr class="table-dark">
                                    <th scope="col">Annee_univ</th>
                                    <th scope="col">Matricule</th>
                                    <th scope="col">Etudiant</th>
                                    <th scope="col">Parcour et Niveau</th>
                                    <th scope="col">Note</th>
                                  </tr>';
                            echo '</thead>';
                            echo '<tbody>';
                                while($row = mysqli_fetch_assoc($result)) {
                                    $annee = explode ('-', $row['s_annee_univ']);
                                    if ((($annee [0] >= $date_deb && $annee [0] < $date_fin) && ($annee [1] > $date_deb && $annee [1] <= $date_fin)) > 0){
                                        echo '<tr>
                                                <td>' . $annee [0] . "-" . $annee [1] . '</td>
                                                <td>' . $row['s_matricule'] . '</td>
                                                <td>' . $row['e_nom'] . ' ' . $row['e_prenoms'] . '</td>
                                                <td>' . $row['e_parcours'] . ' ' . 'en' . ' ' . $row['e_niveau'] . '</td>
                                                <td>' . $row['s_note'] . '</td>
                                            </tr>';
                                    }else{
                                        echo '<div class="alert alert-dark mt-3" role="alert"><p class="h1">Aucun résultat trouvé</p></div>';
                                        break;
                                    }
                                }
                            echo '</tbody>';
                            echo '</table>';
                            }
                    }else{
                        $error_msg = "l'annee $date_in_deb-$date_in_fin est incorecte ";
                        $sql_deb = "SELECT soutenir.id as s_id, soutenir.note as s_note, soutenir.annee_univ as s_annee_univ,
                    soutenir.matricule as s_matricule, etudiant.nom as e_nom, etudiant.prenoms as e_prenoms, etudiant.niveau as e_niveau, etudiant.parcours as e_parcours
                    FROM soutenir
                    JOIN etudiant ON soutenir.matricule = etudiant.matricule";
    
                    $stmt_deb = mysqli_prepare($conn, $sql_deb);
                    mysqli_stmt_execute($stmt_deb);
                    $result_deb = mysqli_stmt_get_result($stmt_deb);
    
                    if (mysqli_num_rows($result_deb) > 0) {
                        echo '<div class="text-center m-2 "><h1>TABLES ETUDIANT</h1></div>';
                        $msg = htmlspecialchars($error_msg, ENT_QUOTES);
                        echo '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            '.$msg.'
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                        echo '<form action="" method="POST">
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label">Annee debut</label>
                                        <input type="number" class="form-control" name="date_in_deb" placeholder="Ex: 2023" value="">
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Annee fin</label>
                                        <input type="number" class="form-control" name="date_in_fin" placeholder="Ex: 2024" value="">
                                    </div>
                                        <button type="submit" name="submit" class="btn btn-outline-secondary">Rechercher</button>
                                </div>
                            </form>';
                        echo '<table class="table table-hover text-center m-3">';
                        echo '<thead>';
                        echo '<tr class="table-dark">
                                <th scope="col">Annee_univ</th>
                                <th scope="col">Matricule</th>
                                <th scope="col">Etudiant</th>
                                <th scope="col">Parcour et Niveau</th>
                                <th scope="col">Note</th>
                            </tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        while ($row = mysqli_fetch_assoc($result_deb)) {
                            echo '<tr>
                                    <td>' . htmlspecialchars($row['s_annee_univ']) . '</td>
                                    <td>' . htmlspecialchars($row['s_matricule']) . '</td>
                                    <td>' . htmlspecialchars($row['e_nom'] . ' ' . $row['e_prenoms']) . '</td>
                                    <td>' . htmlspecialchars($row['e_parcours'] . ' en ' . $row['e_niveau']) . '</td>
                                    <td>' . htmlspecialchars($row['s_note']) . '</td>
                                </tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
                    }
                    }
                }

            }else{

                $sql_deb = "SELECT soutenir.id as s_id, soutenir.note as s_note, soutenir.annee_univ as s_annee_univ,
                soutenir.matricule as s_matricule, etudiant.nom as e_nom, etudiant.prenoms as e_prenoms, etudiant.niveau as e_niveau, etudiant.parcours as e_parcours
                FROM soutenir
                JOIN etudiant ON soutenir.matricule = etudiant.matricule";

                $stmt_deb = mysqli_prepare($conn, $sql_deb);
                mysqli_stmt_execute($stmt_deb);
                $result_deb = mysqli_stmt_get_result($stmt_deb);

                if (mysqli_num_rows($result_deb) > 0) {
                    echo '<form action="" method="POST">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Annee debut</label>
                                    <input type="number" class="form-control" name="date_in_deb" placeholder="Ex: 2023" value="">
                                </div>
                                <div class="col">
                                    <label class="form-label">Annee fin</label>
                                    <input type="number" class="form-control" name="date_in_fin" placeholder="Ex: 2024" value="">
                                </div>
                                    <button type="submit" name="submit" class="btn btn-outline-secondary">Rechercher</button>
                            </div>
                        </form>';
                    echo '<table class="table table-hover text-center m-3">';
                    echo '<thead>';
                    echo '<tr class="table-dark">
                            <th scope="col">Annee_univ</th>
                            <th scope="col">Matricule</th>
                            <th scope="col">Etudiant</th>
                            <th scope="col">Parcour et Niveau</th>
                            <th scope="col">Note</th>
                        </tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = mysqli_fetch_assoc($result_deb)) {
                        echo '<tr>
                                <td>' . htmlspecialchars($row['s_annee_univ']) . '</td>
                                <td>' . htmlspecialchars($row['s_matricule']) . '</td>
                                <td>' . htmlspecialchars($row['e_nom'] . ' ' . $row['e_prenoms']) . '</td>
                                <td>' . htmlspecialchars($row['e_parcours'] . ' en ' . $row['e_niveau']) . '</td>
                                <td>' . htmlspecialchars($row['s_note']) . '</td>
                            </tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<div class="alert alert-dark mt-3" role="alert"><p class="h1">Aucun résultat trouvé</p></div>';
                            }
                            
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
</body>
</html>
<?php
    require 'require/connection_DB.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="fontawesome/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="DataTables/DataTables-1.13.4/css/dataTables.bootstrap5.min.css">
    
    
    <style>
        .navbar {
            background-color: #2bc791;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark ">
        <div class="container-fluid mt-2">
            <a class="navbar-brand" href="index.php">GESTION DES SOUTENANCES</a>
            
            <div class="d-flex">
                <ul class="navbar-nav">
                    <a href="./login/index_login.php"><button type="button" class="btn btn-outline-dark">Connecter</button></a>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <a class="col-xl-3 col-md-6 mb-4" href="./table/etudiant.php" style="text-decoration: none; color: black;">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    ETUDIANT</div>
                                    <?php
                                        $sql = "SELECT COUNT(*) AS total FROM etudiant";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result) {
                                            $row = mysqli_fetch_assoc($result);
                                            
                                            echo '<div class="h5 mb-0 font-weight-bold text-gray-800">' . htmlspecialchars($row['total']) . '</div>';}
                                    ?>
                            </div>
                            <div class="col-auto">
                            <i class="fa-solid fa-pen-ruler fa-2x text-gray-300" style="color: #4aa559;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Earnings (Monthly) Card Example -->
            <a class="col-xl-3 col-md-6 mb-4" href="./table/organisme.php" style="text-decoration: none; color: black;">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    ORGANISME</div>
                                    <?php
                                        $sql = "SELECT COUNT(*) AS total FROM organisme";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result) {
                                            $row = mysqli_fetch_assoc($result);
                                            
                                            echo '<div class="h5 mb-0 font-weight-bold text-gray-800">' . htmlspecialchars($row['total']) . '</div>';}
                                    ?>
                            </div>
                            <div class="col-auto">
                            <i class="fa-solid fa-school fa-2x text-gray-300" style="color: #4aa559;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Earnings (Monthly) Card Example -->
            <a class="col-xl-3 col-md-6 mb-4"href="./table/professeur.php" style="text-decoration: none; color: black;">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">PROFESSEUR</div>
                                <?php
                                    $sql = "SELECT COUNT(*) AS total FROM professeur";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);
                                        
                                        echo '<div class="h5 mb-0 font-weight-bold text-gray-800">' . htmlspecialchars($row['total']) . '</div>';}
                                ?>
                            </div>
                            <div class="col-auto">
                            <i class="fa-solid fa-chalkboard-user fa-2x text-gray-300" style="color: #4aa559;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Pending Requests Card Example -->
            <a class="col-xl-3 col-md-6 mb-4" href="./table/soutenir.php" style="text-decoration: none; color: black;">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    SOUTENANCE</div>
                                    <?php
                                        $sql = "SELECT COUNT(*) AS total FROM soutenir";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result) {
                                            $row = mysqli_fetch_assoc($result);
                                            
                                            echo '<div class="h5 mb-0 font-weight-bold text-gray-800">' . htmlspecialchars($row['total']) . '</div>';}
                                    ?>
                            </div>
                            <div class="col-auto">
                            <i class="fa-solid fa-graduation-cap fa-2x text-gray-300" style="color: #4aa559;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <!-- Content Row -->
    <!-- Content Row -->

    <div class="row mt-4">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">notes des étudiants</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <?php
                            $sql = "SELECT soutenir.note as s_note, soutenir.annee_univ as s_annee_univ,
                            soutenir.matricule as s_matricule, etudiant.nom as e_nom, etudiant.prenoms as e_prenoms, etudiant.niveau as e_niveau, etudiant.parcours as e_parcours 
                                    FROM soutenir
                                    JOIN etudiant ON soutenir.matricule = etudiant.matricule";
                            $result = mysqli_query($conn, $sql);
                        ?>
                        <div slass="table-responsive">
                            <table id="date" class="table table-striped table-bordered">
                            <thead>
                                <tr class="table-dark">
                                    <th scope="col">Matricule</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Niveau</th>
                                    <th scope="col">Parcours</th>
                                    <th scope="col">Note</th>
                                    <th scope="col">Annee_univ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<tr>
                                                <td>'. $row["s_matricule"] .'</td>
                                                <td>'. $row["e_nom"] .'</td>
                                                <td>'. $row["e_prenoms"] .'</td>
                                                <td>'. $row["e_niveau"] .'</td>
                                                <td>'. $row["e_parcours"] .'</td>
                                                <td>'. $row["s_note"] .'</td>
                                                <td>'. $row["s_annee_univ"] .'</td>
                                             </tr>';
                                    }
                                ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">étudiants inscrits par niveau avec l’effectif total</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                <?php
                    $sql = "SELECT niveau, COUNT(*) as effectif_total FROM etudiant GROUP BY niveau ORDER BY niveau ASC";
                    $result = mysqli_query($conn, $sql);

                    echo '<table class="table table-hover text-center">';
                    echo '<thead>';
                    echo '<tr class="table-dark">
                            <th scope="col">Niveau</th>
                            <th scope="col">Effectif Total</th>
                          </tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                                <td>' . $row['niveau'] . '</td>
                                <td>' . $row['effectif_total'] . '</td>
                              </tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                ?>
                </div>
            </div>
        </div>
    </div>

<!-- Content Row -->


    <div class="row mt-4">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">étudiants qui n’ont pas encore effectué de soutenance</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <?php
                            $sql = "SELECT * FROM etudiant WHERE matricule NOT IN (SELECT matricule FROM soutenir)";
                            $result = mysqli_query($conn, $sql);
                        ?>
                        <div slass="table-responsive">
                            <table id="soutenance" class="table table-striped table-bordered">
                            <thead>
                                <tr class="table-dark">
                                    <th scope="col">Matricule</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Niveau</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<tr>
                                                <td>'. $row["matricule"] .'</td>
                                                <td>'. $row["nom"] .'</td>
                                                <td>'. $row["prenoms"] .'</td>
                                                <td>'. $row["niveau"] .'</td>
                                             </tr>';
                                    }
                                ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Content Row -->

    
    </div>

    <script src="fontawesome/js/all.min.js"></script>
    <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="DataTables/DataTables-1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="DataTables/DataTables-1.13.4/js/dataTables.bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
            $('#soutenance').DataTable();
        });
    </script>
    <script>
        $(document).ready(function(){
            $('#date').DataTable();
        });
    </script>
</body>
</html>
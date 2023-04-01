<?php
    require '../../require/connection_DB.php';

    if(isset($_POST['submit'])) {
        if (isset($_POST['prenoms'])) {
            $prenoms = $_POST['prenoms'];
        }else{
            $prenoms = '';
        }
        if (isset($_POST['civilite'])) {
            $civilite = $_POST['civilite'];
        } else {
            $civilite = '';
        }
        if (isset($_POST['grade'])) {
            $grade = $_POST['grade'];
        } else {
            $grade = '';
        }
        
        if (strlen($nom = $_POST['nom']) == 1) {
            $error_msg = "Le nom doit contenir au moins deux caractères.";
            
        } else {
            // vérifie si les champs obligatoires sont remplis
            if(empty($nom) || empty($civilite) || empty($grade)) {
                $error_msg = "Les champs Nom, Civilité et Grade sont obligatoires.";
            } else {
                // vérifie si un enregistrement avec le même nom existe déjà
                $resultat = mysqli_query($conn, "SELECT * FROM professeur WHERE nom='$nom' && prenoms='$prenoms'");
                if (mysqli_num_rows($resultat) > 0) {
                    // un enregistrement avec le même nom existe déjà
                    $error_msg = "ce professeur existe déjà.";
                } else {
                    // insére une nouvel enregistrement
                    $sql = "INSERT INTO professeur(`nom`, `prenoms`, `civilite`, `grade`)
                            VALUES ('$nom','$prenoms','$civilite','$grade')";
                    $result = mysqli_query($conn, $sql);

                    if($result) {
                        header("Location: ../table_admin/professeur_admin.php?msg=Anregistrement reussite");
                        exit();
                    }
                    else {
                        echo "Failed: " . mysqli_error($conn);
                    }
                }
                
            }
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../fontawesome/css/all.min.css">
    <style>
        .navbar {
            background-color: #2bc791;
        }
    </style>

    <title>add_etudient</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark ">
        <div class="container-fluid mt-2">
            <a class="navbar-brand" href="../admin.php">GESTION DES SOUTENANCES</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Table
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="../table_admin/organisme_admin.php">Etudiant</a></li>
                            <li><a class="dropdown-item" href="../table_admin/professeur_admin.php">Professeur</a></li>
                            <li><a class="dropdown-item" href="../table_admin/soutenir_admin.php">organisme</a></li>
                            <li><a class="dropdown-item" href="../table_admin/soutenir_admin.php">soutenir</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="d-flex">
                <ul class="navbar-nav">
                    <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">Deconecter</button>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="text-center mt-4">
            <h1>Ajouter des professeur à la liste</h1>
            <p>Complétez le formulaire ci-dessous pour ajouter un nouveau professeur</p>
        </div>
    </div>

    <div class="container d-flex justify-content-center">
        <form class="mt-4" action="" method="post" style="width:50vw; min-width:300px;">
        <?php if(isset($error_msg)): ?>
            <div class="alert alert-danger"><?php echo $error_msg; ?></div>
        <?php endif; ?>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Nom</label>
                    <input style="text-transform: uppercase;" type="text" class="form-control" name="nom" placeholder="Nom" value="<?php if(isset($_POST['nom'])) echo $_POST['nom']; ?>">
                </div>
                <div class="col">
                    <label class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="prenoms" placeholder="Prénom" value="<?php if(isset($_POST['prenoms'])) echo $_POST['prenoms']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Civilité</label>
                    <select class="form-select" aria-label="Default select example" name="civilite">
                        <option disabled selected value="">Choisissez une civilité</option>
                        <option value="Mr" <?php if(isset($_POST['civilite']) && $_POST['civilite'] == 'Mr') echo 'selected'; ?>>Mr</option>
                        <option value="Mlle" <?php if(isset($_POST['civilite']) && $_POST['civilite'] == 'Mlle') echo 'selected'; ?>>Mlle</option>
                        <option value="Mme" <?php if(isset($_POST['civilite']) && $_POST['civilite'] == 'Mme') echo 'selected'; ?>>Mme</option>
                    </select>
                </div>
                <div class="col">
                    <label class="form-label">Grade</label>
                    <select class="form-select" aria-label="Default select example" name="grade">
                        <option disabled selected value="">Choisissez un grade</option>
                        <option value="Professeur titulaire" <?php if(isset($_POST['grade']) && $_POST['grade'] == 'Professeur titulaire') echo 'selected'; ?>>Professeur titulaire</option>
                        <option value="Maître de Conférences" <?php if(isset($_POST['grade']) && $_POST['grade'] == 'Maître de Conférences') echo 'selected'; ?>>Maître de Conférences</option>
                        <option value="Assistant d’Enseignement Supérieur et de Recherche" <?php if(isset($_POST['grade']) && $_POST['grade'] == 'Assistant d\'Enseignement Supérieur et de Recherche') echo 'selected'; ?>>Assistant d’Enseignement Supérieur et de Recherche</option>
                        <option value="Docteur HDR" <?php if(isset($_POST['grade']) && $_POST['grade'] == 'Docteur HDR') echo 'selected'; ?>>Docteur HDR</option>
                        <option value="Docteur en Informatique" <?php if(isset($_POST['grade']) && $_POST['grade'] == 'Docteur en Informatique') echo 'selected'; ?>>Docteur en Informatique</option>
                        <option value="Doctorant en informatique" <?php if(isset($_POST['grade']) && $_POST['grade'] == 'Doctorant en informatique') echo 'selected'; ?>>Doctorant en informatique</option>
                    </select>
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-success" name="submit">sauvegarder</button>
                <a href="../../admin.php" class="btn btn-danger">annuler</a>
            </div>
        </form>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                Êtes-vous sûr(e) de vouloir vous déconnecter ?
                </div>
                <div class="modal-footer">
                    <a href="../../index.php"><button type="button" class="btn btn-primary">oui</button></a>
                </div>
            </div>
        </div>
    </div>

    <script src="../../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"> </script>
    <script src="../../fontawesome/js/all.min.js"></script>
</body>
</html>
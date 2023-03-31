<?php
require '../../require/connection_DB.php';

if(isset($_POST['submit'])) {
    if (isset($_POST['idorg'])) {
        $idorg = $_POST['idorg'];
    } else {
        $idorg = "";
    }
    
    if (isset($_POST['civilite' . ' ' . 'nom' . ' ' . 'prenoms'])) {
        $rapporteur_ext = $_POST['civilite' . ' ' . 'nom' . ' ' . 'prenoms'];
    } else {
        $rapporteur_ext = "";
    }
    if (isset($_POST['examinateur'])) {
        $examinateur = $_POST['examinateur'];
    } else {
        $examinateur = "";
    }
    if (isset($_POST['president'])) {
        $president = $_POST['president'];
    } else {
        $president = "";
    }
    if (isset($_POST['rapporteur_int'])) {
        $rapporteur_int = $_POST['rapporteur_int'];
    } else {
        $rapporteur_int = "";
    }
    $annee_univ = $_POST['annee_univ'];
    $matricule = $_POST['matricule'];
    $note = $_POST['note'];
    
    
        // vérifie si les champs obligatoires sont remplis
        if(empty($matricule) || empty($note) || empty($idorg) || empty($president) || empty($examinateur) || empty($rapporteur_int)) {
            $error_msg = "Les champs Matricule, note, Année universitaire, organisme, Président des jurys, Examinateur et Rapporteur interne sont obligatoires.";
        } else
        {if (!preg_match("/^\d{4}-\d{4}$/", $annee_univ)) {
            $error_msg = "Le format de l'année universitaire est incorrect, ex: 2000-2001";
        } else {
            // vérifie si un enregistrement avec le même matricule existe déjà
            $stmt = $conn->prepare("SELECT * FROM soutenir WHERE matricule=?");
            $stmt->bind_param("s", $matricule);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // un enregistrement avec le même matricule existe déjà
                $error_msg = "Un étudiant avec ce matricule existe déjà.";
            } else {
                // insére un nouvel enregistrement
                $stmt = $conn->prepare("INSERT INTO soutenir(`matricule`, idorg, `annee_univ`, note, president, examinateur, rapporteur_int, `rapporteur_ext`)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssss", $matricule, $idorg, $annee_univ, $note, $president, $examinateur, $rapporteur_int, $rapporteur_ext);
                $stmt->execute();

                if($stmt->affected_rows > 0) {
                    header("Location: ../table_admin/soutenir_admin.php?msg=Anregistrement reussite");
                    exit();
                } else {
                    echo "Erreur: " . $conn->error;
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
        <div class="text-center mb4">
            <h1>Ajouter des étudiants à la liste</h1>
            <p>Complétez le formulaire ci-dessous pour ajouter un nouvel étudiant</p>
        </div>
    </div>

    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;">
            <?php if(isset($error_msg)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error_msg, ENT_QUOTES); ?></div>
            <?php endif; ?>
            <div class="row mb-3">
                <?php
                    $id = $_GET['id'];
                    $sql = "SELECT matricule as matricule_etudiant FROM etudiant WHERE id=$id ";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (mysqli_num_rows($result) > 0){
                    echo '<div class="col">';
                    echo '<label class="form-label">Matricule</label>';
                    while($row = mysqli_fetch_assoc($result)){
                    echo '<input type="text" class="form-control" name="matricule" value="'. htmlspecialchars($row['matricule_etudiant']) .'" readonly>';}
                    echo '</div>';
                    }
                ?>
                
                <div class="col">
                    <label class="form-label">Note</label>
                    <input type="number" class="form-control" name="note" placeholder="note" value="<?php if(isset($_POST['note'])) echo htmlspecialchars($_POST['note'], ENT_QUOTES); ?>">
                </div>
                <div class="col">
                    <label class="form-label">Année universitaire</label>
                    <input type="text" class="form-control" name="annee_univ" placeholder="yyyy-yyyy" value="<?php if(isset($_POST['annee_univ'])) echo htmlspecialchars($_POST['annee_univ'], ENT_QUOTES); ?>">
                </div>
                <?php
                    $sql = "SELECT * FROM organisme";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    
                    if (mysqli_num_rows($result) > 0){
                        echo '<div class="col">';
                        echo '<label class="form-label">Organisme</label>';
                        echo '<select class="form-select" aria-label="Default select example" name="idorg">';
                        echo '<option disabled selected value="">Choisissez un organisme</option>';
                        while($row = mysqli_fetch_assoc($result)){
                            echo '<option value="'. htmlspecialchars($row['idorg']) .'" '. (isset($_POST['idorg']) && $_POST['idorg'] == $row['idorg'] ? 'selected' : '') .'>'. htmlspecialchars($row['design']) .'</option>';
                        }
                        echo '</select>';
                        echo '</div>';
                    }else{
                        echo '<div class="col"><label class="form-label">Organisme</label><input type="text" class="form-control" value="Pas d\'organisme inscrit" readonly></div>';
                    }
                ?>
            </div>
            <?php
                $sql = "SELECT * FROM professeur";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $prof_sel = array ();
                
                if (mysqli_num_rows($result) > 0){
                    echo '<div class="col mt-3">';
                    echo '<label class="form-label">Président des jurys</label>';
                    echo '<select class="form-select prof" aria-label="Default select example" name="president">';
                    echo '<option disabled selected value="">Choisissez un président des jurys</option>';
                    while($row = mysqli_fetch_assoc($result)){
                        echo '<option value="'. htmlspecialchars($row['idprof']) .'"';
                        if (isset($_POST['president']) && $_POST['president'] == htmlspecialchars($row['idprof'])) {
                            echo ' selected';
                        }
                        echo '>'. htmlspecialchars($row['civilite']) . ' ' . htmlspecialchars($row['nom']) . ' ' . htmlspecialchars($row['prenoms']) .'</option>';
                        
                    }
                    echo '</select>';
                    echo '</div>';
                    mysqli_data_seek($result, 0);
                
                    echo '<div class="col mt-3">';
                    echo '<label class="form-label">Examinateur</label>';
                    echo '<select class="form-select prof" aria-label="Default select example" name="examinateur">';
                    echo '<option disabled selected value="">Choisissez un examinateur</option>';
                    while($row = mysqli_fetch_assoc($result)){
                        echo '<option value="'. htmlspecialchars($row['idprof']) .'"';
                        if (isset($_POST['examinateur']) && $_POST['examinateur'] == htmlspecialchars($row['idprof'])) {
                            echo ' selected';
                        }
                        echo '>'. htmlspecialchars($row['civilite']) . ' ' . htmlspecialchars($row['nom']) . ' ' . htmlspecialchars($row['prenoms']) .'</option>';
                    }
                    echo '</select>';
                    echo '</div>';
                    mysqli_data_seek($result, 0);
                
                    echo '<div class="col mt-3">';
                    echo '<label class="form-label">Rapporteur interne</label>';
                    echo '<select class="form-select prof" aria-label="Default select example" name="rapporteur_int">';
                    echo '<option disabled selected value="">Choisissez un rapporteur interne</option>';
                    while($row = mysqli_fetch_assoc($result)){
                        echo '<option value="'. htmlspecialchars($row['idprof']) .'"';
                        if (isset($_POST['rapporteur_int']) && $_POST['rapporteur_int'] == htmlspecialchars($row['idprof'])) {
                            echo ' selected';
                        }
                        echo '>'. htmlspecialchars($row['civilite']) . ' ' . htmlspecialchars($row['nom']) . ' ' . htmlspecialchars($row['prenoms']) .'</option>';
                        
                    }
                    echo '</select>';
                    echo '</div>';
                }else{
                    echo '<div class="col"><label class="form-label">Membre du jury</label><input type="text" class="form-control" value="Pas de professeur inscrit" readonly></div>';
                }
            ?>
            <div class="row mb-3 mt-3">
            <label class="form-label">Rapporteur extairne</label>
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
                    <label class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" placeholder="Nom" value="<?php if(isset($_POST['nom'])) echo $_POST['nom']; ?>">
                </div>
                <div class="col">
                    <label class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="prenoms" placeholder="Prénom" value="<?php if(isset($_POST['prenoms'])) echo $_POST['prenoms']; ?>">
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-success" name="submit">sauvegarder</button>
                <a href="../table_admin/etudiant_admin.php" class="btn btn-danger">annuler</a>
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
    <script src="../../js/select.js"></script>
</body>
</html>
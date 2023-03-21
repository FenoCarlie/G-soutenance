<?php
require '../../require/connection_DB.php';


$idprof = $_GET['idprof'];
if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $prenoms = $_POST['prenoms'];
    $civilite = $_POST["civilite"];
    $grade = $_POST["grade"];

    // modifier l'enregistrement
    $sql = "UPDATE `professeur` SET `nom`='$nom',`prenoms`='$prenoms',`civilite`='$civilite',`grade`='$grade' WHERE idprof = $idprof";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: ../table_admin/professeur_admin.php?msg=Modification reussite");
        exit();
    } else {
        echo "Failed: " . mysqli_error($conn);
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

    <title>add_etudient</title>
</head>

<body>
    <?php require '../../require/header.php'; ?>

    <div class="container">
        <div class="text-center mb4">
            <h1>Modification d'un professeur à la liste</h1>
        </div>
    </div>

    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;">
            <?php if (isset($error_msg)) : ?>
                <div class="alert alert-danger"><?php echo $error_msg; ?></div>
            <?php endif; ?>

            <?php
            $sql = "SELECT * FROM `professeur` WHERE idprof = $idprof LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" value="<?php echo $row['nom']; ?>">
                </div>
                <div class="col">
                    <label class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="prenoms" value="<?php echo $row['prenoms']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Civilité</label>
                    <select class="form-select" aria-label="Default select example" name="civilite">
                        <option value="Mr" <?php if ($row['civilite'] == 'Mr') echo 'selected'; ?>>Mr</option>
                        <option value="Mlle" <?php if ($row['civilite'] == 'Mlle') echo 'selected'; ?>>Mlle</option>
                        <option value="Mme" <?php if ($row['civilite'] == 'Mme') echo 'selected'; ?>>Mme</option>
                    </select>
                </div>
                <div class="col">
                    <label class="form-label">Grade</label>
                    <select class="form-select" aria-label="Default select example" name="grade">
                        <option value="Professeur titulaire" <?php if ($row['grade'] == 'Professeur titulaire') echo 'selected'; ?>>Professeur titulaire</option>
                        <option value="Maître de Conférences" <?php if ($row['grade'] == 'Maître de Conférences') echo 'selected'; ?>>Maître de Conférences</option>
                        <option value="Assistant d’Enseignement Supérieur et de Recherche" <?php if ($row['grade'] == 'Assistant d’Enseignement Supérieur et de Recherche') echo 'selected'; ?>>Assistant d’Enseignement Supérieur et de Recherche</option>
                        <option value="Docteur HDR" <?php if ($row['grade'] == 'Docteur HDR') echo 'selected'; ?>>Docteur HDR</option>
                        <option value="Docteur en Informatique" <?php if ($row['grade'] == 'Docteur en Informatique') echo 'selected'; ?>>Docteur en Informatique</option>
                        <option value="Doctorant en informatique" <?php if ($row['grade'] == 'Doctorant en informatique') echo 'selected'; ?>>Doctorant en informatique</option>
                    </select>
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-success" name="submit">sauvegarder</button>
                <a href="../table_admin/professeur_admin.php" class="btn btn-danger">annuler</a>
            </div>
        </form>
    </div>

    <script src="../../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"> </script>
    <script src="../../fontawesome/js/all.min.js"></script>
</body>

</html>
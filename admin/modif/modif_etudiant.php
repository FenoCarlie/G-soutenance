<?php
require '../../require/connection_DB.php';


$id = $_GET['id'];
if (isset($_POST['submit'])) {
    $matricule = $_POST['matricule'];
    $prenoms = $_POST['prenoms'];
    $niveau = $_POST["niveau"];
    $parcours = $_POST["parcours"];
    $adr_email = $_POST['adr_email'];
    if (strlen($nom = $_POST['nom']) == 1) {
        $error_msg = "Le nom doit contenir au moins deux caractères.";
    } else {   
        // vérifie si les champs obligatoires sont remplis
        if(empty($matricule) || empty($niveau) || empty($nom) || empty($parcours)) {
            $error_msg = "Les champs Matricule, nom, Niveau et Parcours sont obligatoires.";
        }else {
            // modifier l'enregistrement
            $sql = "UPDATE `etudiant` SET `matricule`='$matricule',`nom`='$nom',`prenoms`='$prenoms',`niveau`='$niveau',`parcours`='$parcours',`adr_email`='$adr_email' WHERE id = $id";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: ../table_admin/etudiant_admin.php?msg=Modification reussite");
                exit();
            } else {
                echo "Failed: " . mysqli_error($conn);
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

    <title>add_etudient</title>
</head>

<body>

    <div class="container">
        <div class="text-center mb4">
            <h1>Modification d'un étudiants à la liste</h1>
        </div>
    </div>

    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;">
            <?php if (isset($error_msg)) : ?>
                <div class="alert alert-danger"><?php echo $error_msg; ?></div>
            <?php endif; ?>

            <?php
            $sql = "SELECT * FROM `etudiant` WHERE id = $id LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Matricule</label>
                    <input type="text" class="form-control" name="matricule" value="<?php echo $row['matricule']; ?>">
                </div>
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
                    <label class="form-label">Niveau</label>
                    <select class="form-select" aria-label="Default select example" name="niveau">
                        <option value="L1" <?php if ($row['niveau'] == 'L1') echo 'selected'; ?>>L1</option>
                        <option value="L2" <?php if ($row['niveau'] == 'L2') echo 'selected'; ?>>L2</option>
                        <option value="L3" <?php if ($row['niveau'] == 'L3') echo 'selected'; ?>>L3</option>
                        <option value="M1" <?php if ($row['niveau'] == 'M1') echo 'selected'; ?>>M1</option>
                        <option value="M2" <?php if ($row['niveau'] == 'M2') echo 'selected'; ?>>M2</option>
                    </select>
                </div>
                <div class="col">
                    <label class="form-label">Parcours</label>
                    <select class="form-select" aria-label="Default select example" name="parcours">
                        <option value="GB" <?php if ($row['parcours'] == 'GB') echo 'selected'; ?>>GB</option>
                        <option value="SR" <?php if ($row['parcours'] == 'SR') echo 'selected'; ?>>SR</option>
                        <option value="IG" <?php if ($row['parcours'] == 'IG') echo 'selected'; ?>>IG</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="adr_email" value="<?php echo $row['adr_email']; ?>">
            </div>

            <div>
                <button type="submit" class="btn btn-success" name="submit">sauvegarder</button>
                <a href="../table_admin/etudiant_admin.php" class="btn btn-danger">annuler</a>
            </div>
        </form>
    </div>

    <script src="../../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"> </script>
    <script src="../../fontawesome/js/all.min.js"></script>
</body>

</html>
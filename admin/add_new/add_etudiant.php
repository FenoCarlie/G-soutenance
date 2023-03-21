<?php
    require '../../require/connection_DB.php';

    if(isset($_POST['submit'])) {
        $prenoms = $_POST['prenoms'];
        if (isset($_POST['niveau'])) {
        $niveau = $_POST['niveau'];
        } else {
        $niveau = "";
        }
        if (isset($_POST['parcours'])) {
        $parcours = $_POST['parcours'];
        } else {
        $parcours = "";
        }
        $adr_email = $_POST['adr_email'];
        $matricule = $_POST['matricule'];
        if (strlen($nom = $_POST['nom']) == 1) {
            $error_msg = "Le nom doit contenir au moins deux caractères.";
            
        } else {
            // vérifie si les champs obligatoires sont remplis
            if(empty($matricule) || empty($niveau) || empty($nom) || empty($parcours)) {
                $error_msg = "Les champs Matricule, nom, Niveau et Parcours sont obligatoires.";
            } else {
                // vérifie si un enregistrement avec le même matricule existe déjà
                $resultat = mysqli_query($conn, "SELECT * FROM etudiant WHERE matricule='$matricule'");
                if (mysqli_num_rows($resultat) > 0) {
                    // un enregistrement avec le même matricule existe déjà
                    $error_msg = "Un étudiant avec ce matricule existe déjà.";
                } else {
                    // insére un nouvel enregistrement
                    $sql = "INSERT INTO etudiant(`matricule`, `nom`, `prenoms`, `niveau`, `parcours`, `adr_email`)
                            VALUES ('$matricule','$nom','$prenoms','$niveau','$parcours','$adr_email')";
                    $result = mysqli_query($conn, $sql);

                    if($result) {
                        header("Location: ../table_admin/etudiant_admin.php?msg=Anregistrement reussite");
                        exit();
                    }
                    else {
                        echo "Failed: " . mysqli_error($conn);
                    }
                }
                
            }
        }

        
        mysqli_close($conn);
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
    <?php require '../../require/header.php';?>

    <div class="container">
        <div class="text-center mb4">
            <h1>Ajouter des étudiants à la liste</h1>
            <p>Complétez le formulaire ci-dessous pour ajouter un nouvel étudiant</p>
        </div>
    </div>

    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;">
        <?php if(isset($error_msg)): ?>
            <div class="alert alert-danger"><?php echo $error_msg; ?></div>
        <?php endif; ?>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Matricule</label>
                    <input type="text" class="form-control" name="matricule" placeholder="matricule" value="<?php if(isset($_POST['matricule'])) echo $_POST['matricule']; ?>">
                </div>
                <div class="col">
                    <label class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" placeholder="Nom" value="<?php if(isset($_POST['nom'])) echo $_POST['nom']; ?>">
                </div>
                <div class="col">
                    <label class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="prenoms" placeholder="Prénom" value="<?php if(isset($_POST['prenom'])) echo $_POST['prenoms']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Niveau</label>
                    <select class="form-select" aria-label="Default select example" name="niveau">
                    <option disabled selected value="">Choisissez un niveau</option>
                    <option value="L1" <?php if(isset($_POST['niveau']) && $_POST['niveau'] == 'L1') echo 'selected'; ?>>L1</option>
                    <option value="L2" <?php if(isset($_POST['niveau']) && $_POST['niveau'] == 'L2') echo 'selected'; ?>>L2</option>
                    <option value="L3" <?php if(isset($_POST['niveau']) && $_POST['niveau'] == 'L3') echo 'selected'; ?>>L3</option>
                    <option value="M1" <?php if(isset($_POST['niveau']) && $_POST['niveau'] == 'M1') echo 'selected'; ?>>M1</option>
                    <option value="M2" <?php if(isset($_POST['niveau']) && $_POST['niveau'] == 'M2') echo 'selected'; ?>>M2</option>
                    </select>
                </div>
                <div class="col">
                    <label class="form-label">Parcours</label>
                    <select class="form-select" aria-label="Default select example" name="parcours">
                        <option disabled selected value="">Choisissez une parcours</option>
                        <option value="GB" <?php if(isset($_POST['parcours']) && $_POST['parcours'] == 'GB') echo 'selected'; ?>>GB</option>
                        <option value="SR" <?php if(isset($_POST['parcours']) && $_POST['parcours'] == 'SR') echo 'selected'; ?>>SR</option>
                        <option value="IG" <?php if(isset($_POST['parcours']) && $_POST['parcours'] == 'IG') echo 'selected'; ?>>IG</option>
                    </select>
                </div>
            </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="adr_email" placeholder="nom@exemple.com" value="<?php if(isset($_POST['adr_email'])) echo $_POST['adr_email']; ?>">
                </div>

            <div>
                <button type="submit" class="btn btn-success" name="submit">sauvegarder</button>
                <a href="../../admin.php" class="btn btn-danger">annuler</a>
            </div>
        </form>
    </div>

    <script src="../../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"> </script>
    <script src="../../fontawesome/js/all.min.js"></script>
</body>
</html>
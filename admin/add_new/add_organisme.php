<?php
require '../../require/connection_DB.php';

if (isset($_POST['submit'])) {
    $design = $_POST['design'];
    $lieu = $_POST['lieu'];

    // vérifier si les champs obligatoires sont remplis
    if (empty($design) || empty($lieu)) {
        $error_msg = "Les champs Designation et Lieu sont obligatoires.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM organisme WHERE design=?");
        $stmt->bind_param("s", $design);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // un enregistrement avec le même design existe déjà
            $error_msg = "Un organisme avec ce designation existe déjà.";
        } else {
            // insére un nouvel enregistrement
            $stmt = $conn->prepare("INSERT INTO organisme(`design`, `lieu`)
                        VALUES (?, ?)");
            $stmt->bind_param("ss", $design, $lieu);
            $stmt->execute();

            if($stmt->affected_rows > 0) {
                header("Location: ../table_admin/organisme_admin.php?msg=Anregistrement reussite");
                exit();
            } else {
                echo "Erreur: " . $conn->error;
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

    <title>add_organisme</title>
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
                            <li><a class="dropdown-item" href="../table_admin/etudiant_admin.php">Etudiant</a></li>
                            <li><a class="dropdown-item" href="../table_admin/professeur_admin.php">Professeur</a></li>
                            <li><a class="dropdown-item" href="../table_admin/organisme_admin.php">organisme</a></li>
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
            <h1>Ajouter des organisme à la liste</h1>
            <p>Complétez le formulaire ci-dessous pour ajouter un nouvel organisme</p>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="post">
                    <?php if (isset($error_msg)) : ?>
                        <div class="alert alert-danger"><?php echo $error_msg; ?></div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label class="form-label">Designation</label>
                        <input type="text" class="form-control" name="design" placeholder="designation" value="<?php if (isset($_POST['design'])) echo $_POST['design']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lieu</label>
                        <input type="text" class="form-control" name="lieu" placeholder="lieu" value="<?php if (isset($_POST['lieu'])) echo $_POST['lieu']; ?>">
                    </div>

                    <div>
                        <button type="submit" class="btn btn-success" name="submit">sauvegarder</button>
                        <a href="../../admin/add_new/add_organisme.php" class="btn btn-danger">annuler</a>
                    </div>
                </form>
            </div>
        </div>
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
<?php
require '../../require/connection_DB.php';

if (isset($_POST['submit'])) {
    $design = $_POST['design'];
    $lieu = $_POST['lieu'];

    // vérifier si les champs obligatoires sont remplis
    if (empty($design) || empty($lieu)) {
        $error_msg = "Les champs Designation et Lieu sont obligatoires.";
    } else {
        $sql = "INSERT INTO `organisme`(`design`, `lieu`) VALUES ('$design', '$lieu')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: ../table_admin/organisme_admin.php?msg=Anregistrement reussite");
            exit();
        } else {
            echo "Failed: " . mysqli_error($conn);
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

    <title>add_organisme</title>
</head>

<body>
    <?php require '../../require/header.php'; ?>
    <div class="container">
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
                        <a href="../../admin.php" class="btn btn-danger">annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="../../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"> </script>
    <script src="../../fontawesome/js/all.min.js"></script>
</body>

</html>
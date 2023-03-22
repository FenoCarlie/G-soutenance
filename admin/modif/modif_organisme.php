<?php
require '../../require/connection_DB.php';


$idorg = $_GET['idorg'];
if (isset($_POST['submit'])) {
    $design = $_POST['design'];
    $lieu = $_POST['lieu'];

    // modifier l'enregistrement
    $sql = "UPDATE `organisme` SET `design`='$design',`lieu`='$lieu' WHERE idorg = $idorg";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: ../table_admin/organisme_admin.php?msg=Modification reussite");
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

    <div class="container">
        <div class="text-center mb4">
            <h1>Modification d'un organisme de la liste</h1>
        </div>
    </div>

    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;">
            <?php if (isset($error_msg)) : ?>
                <div class="alert alert-danger"><?php echo $error_msg; ?></div>
            <?php endif; ?>

            <?php
            $sql = "SELECT * FROM `organisme` WHERE idorg = $idorg LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>
            <div class="row mb-3 mt-3">
                <div class="col">
                    <label class="form-label">Designation</label>
                    <input type="text" class="form-control" name="design" value="<?php echo $row['design']; ?>">
                </div>
                <div class="col">
                    <label class="form-label">Lieu</label>
                    <input type="text" class="form-control" name="lieu" value="<?php echo $row['lieu']; ?>">
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-success" name="submit">sauvegarder</button>
                <a href="../table_admin/organisme_admin.php" class="btn btn-danger">annuler</a>
            </div>
        </form>
    </div>

    <script src="../../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"> </script>
    <script src="../../fontawesome/js/all.min.js"></script>
</body>

</html>
<?php
require '../../require/connection_DB.php';

//crud delete
$idprof = $_GET['idprof'];
$sql = "DELETE FROM `professeur` WHERE idprof=$idprof ";
$result = mysqli_query($conn, $sql);
if ($result) {
    header("Location: ../table_admin/professeur_admin.php?msg=supression reussit");
} else {
    echo "Failed: " . mysqli_error($conn);
}
?>
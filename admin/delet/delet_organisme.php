<?php
require '../../require/connection_DB.php';

//crud delete
$idorg = $_GET['idorg'];
$sql = "DELETE FROM `organisme` WHERE idorg=$idorg ";
$result = mysqli_query($conn, $sql);
if ($result) {
    header("Location: ../table_admin/organisme_admin.php?msg=supression reussit");
} else {
    echo "Failed: " . mysqli_error($conn);
}
?>
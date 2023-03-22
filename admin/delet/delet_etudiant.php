<?php
require '../../require/connection_DB.php';

//crud delete
$id = $_GET['id'];
$sql = "DELETE FROM `etudiant` WHERE id=$id ";
$result = mysqli_query($conn, $sql);
if ($result) {
    header("Location: ../table_admin/etudiant_admin.php?msg=supression reussit");
} else {
    echo "Failed: " . mysqli_error($conn);
}
?>
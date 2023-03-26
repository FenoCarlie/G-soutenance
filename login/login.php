<?php
$username = $_POST['Utilisateur'];
$password = $_POST['mot_de_passe'];

if ($username == 'admin' && $password == '1234') {
    header('Location: ../admin/admin.php');
    exit();
} else {
    // Sinon, afficher un message d'erreur
    echo 'Invalid username or password';
}
?>
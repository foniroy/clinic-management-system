<?php
require_once 'auth.php';
?>
<?php
include "db.php";

$id = $_GET['id'];

mysqli_query($conn,
"DELETE FROM appointments WHERE id=$id");

header("Location: view_appointments.php");
?>
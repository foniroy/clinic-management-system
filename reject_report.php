<?php
require_once 'auth.php';
?>
<?php
include "db.php";

$id = $_GET['id'];

mysqli_query($conn,
"UPDATE reports SET status='rejected' WHERE id=$id");

header("Location: admin_reports.php");
?>
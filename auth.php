<?php
// Clinic Management System authentication guard
// Use a project-specific session cookie so another localhost project
// cannot accidentally authenticate this project.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_name('CLINIC_WEEK45_SESSION');
    session_start();
}

if (!isset($_SESSION['id'])) {
    $_SESSION['redirect_after_login'] = basename($_SERVER['PHP_SELF']);
    header('Location: login.php');
    exit();
}
?>

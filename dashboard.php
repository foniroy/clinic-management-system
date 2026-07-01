<?php
session_start();
include "db.php";

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
        }

        .box{
            background:white;
            padding:20px;
            border-radius:12px;
            text-align:center;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>

<div class="container mt-4">

    <h2 class="text-center mb-4">
        Welcome 👋 <?php echo $user; ?>
    </h2>

    <div class="row">

        <!-- 🔥 PROFILE (ALL USERS) -->
        <div class="col-md-4 mb-3">
            <div class="box">
                <h5>My Profile</h5>
                <a href="profile.php" class="btn btn-warning mt-2">
                    Open Profile
                </a>
            </div>
        </div>

        <!-- PATIENT SECTION -->
        <?php if($role == "patient"){ ?>

        <div class="col-md-4 mb-3">
            <div class="box">
                <h5>Book Appointment</h5>
                <a href="book_appointment.php" class="btn btn-primary mt-2">
                    Open
                </a>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="box">
                <h5>My Appointments</h5>
                <a href="view_appointments.php" class="btn btn-info mt-2">
                    Open
                </a>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="box">
                <h5>My Health Reports</h5>
                <a href="my_reports.php" class="btn btn-success mt-2">
                    View Reports
                </a>
            </div>
        </div>

        <?php } ?>

        <!-- DOCTOR SECTION -->
        <?php if($role == "doctor"){ ?>

        <div class="col-md-4 mb-3">
            <div class="box">
                <h5>Appointments</h5>
                <a href="doctor_appointments.php" class="btn btn-primary mt-2">
                    View
                </a>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="box">
                <h5>Write Report</h5>
                <a href="add_report.php" class="btn btn-success mt-2">
                    Open
                </a>
            </div>
        </div>

        <?php } ?>

        <!-- ADMIN SECTION -->
        <?php if($role == "admin"){ ?>

        <div class="col-md-4 mb-3">
            <div class="box">
                <h5>Manage Doctors</h5>
                <a href="doctors.php" class="btn btn-primary mt-2">
                    Open
                </a>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="box">
                <h5>Appointments</h5>
                <a href="appointments.php" class="btn btn-info mt-2">
                    View
                </a>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="box">
                <h5>Reports</h5>
                <a href="reports.php" class="btn btn-success mt-2">
                    View
                </a>
            </div>
        </div>

        <?php } ?>

        <!-- LOGOUT -->
        <div class="col-md-4 mb-3">
            <div class="box">
                <h5>Logout</h5>
                <a href="logout.php" class="btn btn-danger mt-2">
                    Logout
                </a>
            </div>
        </div>

    </div>

</div>

</body>
</html>
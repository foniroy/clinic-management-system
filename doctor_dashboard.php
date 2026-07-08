<?php
session_start();

if(!isset($_SESSION['id']) || $_SESSION['role']!="doctor"){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard - Medical Portal</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Professional Medical Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        /* Clinic/Medical Blue-Greener Theme for Doctors */
        .sidebar {
            min-height: 100vh;
            background-color: #1a252f;
            color: #fff;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.75);
            padding: 12px 20px;
            border-radius: 4px;
            margin-bottom: 5px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover {
            background-color: #2c3e50;
            color: #fff;
        }
        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: #fff;
        }
        .main-content {
            padding: 30px;
        }
        .stat-card {
            border: none;
            border-radius: 8px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        
        <!-- SIDEBAR NAVIGATION -->
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse p-3">
            <div class="position-sticky">
                <div class="py-3 mb-4 border-bottom border-secondary text-center">
                    <h5 class="fw-bold mb-0 text-uppercase tracking-wider"><i class="fa-solid fa-user-md me-2"></i>Doctor Portal</h5>
                </div>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="doctor_dashboard.php">
                            <i class="fa-solid fa-square-rss me-2"></i> Overview
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="doctor_report.php">
                            <i class="fa-solid fa-file-medical me-2"></i> Create Report
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="doctor_appointments.php">
                            <i class="fa-solid fa-calendar-check me-2"></i> Appointments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="doctor_patients.php">
                            <i class="fa-solid fa-hospital-user me-2"></i> My Patients
                        </a>
                    </li>
                </ul>
                
                <div class="pt-5 mt-5 border-top border-secondary">
                    <a href="logout.php" class="btn btn-sm btn-outline-danger w-100">
                        <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                    </a>
                </div>
            </div>
        </nav>

        <!-- MAIN CONTENT AREA -->
        <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
            
            <!-- Header Summary -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                <h1 class="h2 fw-semibold text-dark">Welcome Back, Doctor</h1>
                <div class="text-secondary small">
                    <i class="fa-solid fa-clock me-1"></i> Hospital Management System
                </div>
            </div>

            <!-- CARDS GRID -->
            <div class="row g-4">

                <!-- Create Report Card -->
                <div class="col-md-4">
                    <div class="card stat-card p-4 shadow-sm bg-white">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="text-muted mb-0 fw-normal">Create Report</h5>
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3">
                                <i class="fa-solid fa-file-medical fa-xl"></i>
                            </div>
                        </div>
                        <p class="text-secondary small mb-3">Generate new medical or prescription reports.</p>
                        <a href="doctor_report.php" class="btn btn-outline-primary btn-sm w-100 py-2">
                            Open Portal <i class="fa-solid fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Appointments Card -->
                <div class="col-md-4">
                    <div class="card stat-card p-4 shadow-sm bg-white">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="text-muted mb-0 fw-normal">Appointments</h5>
                            <div class="bg-info bg-opacity-10 text-info p-3 rounded-3">
                                <i class="fa-solid fa-calendar-check fa-xl"></i>
                            </div>
                        </div>
                        <p class="text-secondary small mb-3">Check your daily and weekly schedule.</p>
                        <a href="doctor_appointments.php" class="btn btn-outline-info btn-sm w-100 py-2 text-dark">
                            View Schedule <i class="fa-solid fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Patients Card -->
                <div class="col-md-4">
                    <div class="card stat-card p-4 shadow-sm bg-white">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="text-muted mb-0 fw-normal">Patients</h5>
                            <div class="bg-success bg-opacity-10 text-success p-3 rounded-3">
                                <i class="fa-solid fa-hospital-user fa-xl"></i>
                            </div>
                        </div>
                        <p class="text-secondary small mb-3">Access and manage assigned patient history.</p>
                        <a href="doctor_patients.php" class="btn btn-outline-success btn-sm w-100 py-2">
                            My Patients <i class="fa-solid fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

            </div>
            
        </main>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
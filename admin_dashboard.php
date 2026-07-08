<?php
session_start();
include "db.php";

if(!isset($_SESSION['id']) || $_SESSION['role']!="admin"){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Management System</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Professional Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #212529;
            color: #fff;
        }
        .sidebar .nav-link {
            color: #rgba(255,255,255,0.75);
            padding: 12px 20px;
            border-radius: 4px;
            margin-bottom: 5px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover {
            background-color: #343a40;
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
                    <h5 class="fw-bold mb-0 text-uppercase tracking-wider"><i class="fa-solid fa-gauge me-2"></i>Admin Panel</h5>
                </div>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="admin_dashboard.php">
                            <i class="fa-solid fa-house me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="doctors_list.php">
                            <i class="fa-solid fa-user-doctor me-2"></i> Doctors
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="appointments_list.php">
                            <i class="fa-solid fa-calendar-check me-2"></i> Appointments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reports.php">
                            <i class="fa-solid fa-file-invoice me-2"></i> Reports
                        </a>
                    </li>
                </ul>
                
                <div class="pt-5 mt-5 border-top border-secondary">
                    <a href="logout.php" class="btn btn-sm btn-outline-danger w-100">
                        <i class="fa-solid fa-right-from-bracket me-2"></i> Sign Out
                    </a>
                </div>
            </div>
        </nav>

        <!-- MAIN CONTENT AREA -->
        <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
            
            <!-- Header Summary -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                <h1 class="h2 fw-semibold text-dark">Dashboard Overview</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="admin_dashboard.php" class="btn btn-sm btn-outline-secondary">
                        <i class="fa-solid fa-rotate me-1"></i> Refresh Data
                    </a>
                </div>
            </div>

            <!-- CARDS GRID -->
            <div class="row g-4">

                <!-- Doctors Card -->
                <div class="col-md-4">
                    <div class="card stat-card p-4 shadow-sm bg-white">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="text-muted mb-0 fw-normal">Doctors</h5>
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3">
                                <i class="fa-solid fa-user-doctor fa-xl"></i>
                            </div>
                        </div>
                        <p class="text-secondary small mb-3">Manage registrations and profiles.</p>
                        <a href="doctors_list.php" class="btn btn-outline-primary btn-sm w-100 py-2">
                            Manage Doctors <i class="fa-solid fa-arrow-right ms-1"></i>
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
                        <p class="text-secondary small mb-3">View and schedule bookings.</p>
                        <a href="appointments_list.php" class="btn btn-outline-info btn-sm w-100 py-2 text-dark">
                            Manage Appointments <i class="fa-solid fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Reports Card -->
                <div class="col-md-4">
                    <div class="card stat-card p-4 shadow-sm bg-white">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="text-muted mb-0 fw-normal">Reports</h5>
                            <div class="bg-success bg-opacity-10 text-success p-3 rounded-3">
                                <i class="fa-solid fa-file-invoice fa-xl"></i>
                            </div>
                        </div>
                        <p class="text-secondary small mb-3">Analyze medical and financial logs.</p>
                        <a href="reports.php" class="btn btn-outline-success btn-sm w-100 py-2">
                            Manage Reports <i class="fa-solid fa-arrow-right ms-1"></i>
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
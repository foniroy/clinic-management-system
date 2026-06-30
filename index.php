<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Clinic System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(120deg,#141e30,#243b55);
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .box{
            width:450px;
            background:white;
            padding:30px;
            border-radius:15px;
            box-shadow:0 10px 25px rgba(0,0,0,0.3);
        }

        .header{
            text-align:center;
            margin-bottom:20px;
        }

        .links a{
            display:block;
            text-align:center;
            margin-top:10px;
            text-decoration:none;
        }

        .profile{
            background:#f1f2f6;
            padding:10px;
            border-radius:10px;
            margin-bottom:15px;
            text-align:center;
        }
    </style>
</head>

<body>

<div class="box">

    <!-- HEADER -->
    <div class="header">
        <h3>🏥 Clinic Management System</h3>
        <p class="text-muted">Secure Login Portal</p>
    </div>

    <!-- PROFILE INFO -->
    <div class="profile">
        <small>Welcome User 👋</small><br>
        <b>Please login to continue</b>
    </div>

    <!-- LOGIN FORM -->
    <form action="login.php" method="POST">

        <label>Username</label>
        <input type="text" name="username" class="form-control mb-2" required>

        <label>Password</label>
        <input type="password" name="password" class="form-control mb-3" required>

        <button name="login" class="btn btn-primary w-100">
            Login
        </button>

    </form>

    <!-- LINKS -->
    <div class="links mt-3">

        <a href="forgot_password.php">🔑 Forgot Password?</a>

        <a href="register.php">📝 Create New Account</a>

    </div>

</div>

</body>
</html>
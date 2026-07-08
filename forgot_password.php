<?php
include "db.php";

$msg = "";
$error = "";

/* =========================
   STEP 1: SEND OTP
========================= */
if(isset($_POST['send_otp'])){

    $username = $_POST['username'];

    $check = mysqli_query($conn,
    "SELECT * FROM users WHERE username='$username'");

    if(mysqli_num_rows($check) > 0){

        $otp = rand(100000,999999);

        mysqli_query($conn,
        "INSERT INTO password_resets(username,otp)
        VALUES('$username','$otp')");

        $msg = "OTP sent ✔ (Demo OTP: $otp)";
    }
    else{
        $error = "Username not found ❌";
    }
}

/* =========================
   STEP 2: VERIFY OTP + RESET PASSWORD
========================= */
if(isset($_POST['verify'])){

    $username = $_POST['username'];
    $otp = $_POST['otp'];
    $newpass = $_POST['new_password'];

    $check = mysqli_query($conn,
    "SELECT * FROM password_resets 
     WHERE username='$username' AND otp='$otp'
     ORDER BY id DESC LIMIT 1");

    if(mysqli_num_rows($check) > 0){

        mysqli_query($conn,
        "UPDATE users 
         SET password='$newpass' 
         WHERE username='$username'");

        $msg = "Password Reset Successful ✔";
    }
    else{
        $error = "Invalid OTP ❌";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password OTP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f1f2f6;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .box{
            width:400px;
            background:white;
            padding:25px;
            border-radius:12px;
            box-shadow:0 5px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>

<div class="box">

    <h4 class="text-center mb-3">Forgot Password</h4>

    <?php if($msg){ ?>
        <div class="alert alert-success"><?php echo $msg; ?></div>
    <?php } ?>

    <?php if($error){ ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>

    <!-- STEP 1 + STEP 2 FORM -->
    <form method="POST">

        <label>Username</label>
        <input type="text" name="username" class="form-control mb-2" required>

        <button name="send_otp" class="btn btn-primary w-100 mb-3">
            Send OTP
        </button>

        <hr>

        <label>OTP</label>
        <input type="text" name="otp" class="form-control mb-2">

        <label>New Password</label>
        <input type="text" name="new_password" class="form-control mb-3">

        <button name="verify" class="btn btn-success w-100">
            Verify & Reset Password
        </button>

    </form>

</div>

</body>
</html>
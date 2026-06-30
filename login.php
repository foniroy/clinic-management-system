<?php
session_start();
include "db.php";

$error = "";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    // ⚠️ NOTE: plain password used (you can upgrade later)
    $sql = "SELECT * FROM users 
            WHERE username='$username' 
            AND password='$password'";

    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    if($row){

        // SESSION SET
        $_SESSION['user'] = $row['name'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['id']   = $row['id'];

        // ROLE BASED REDIRECT
        if($row['role']=="admin"){
            header("Location: admin_dashboard.php");
            exit();
        }
        elseif($row['role']=="doctor"){
            header("Location: doctor_dashboard.php");
            exit();
        }
        else{
            header("Location: dashboard.php");
            exit();
        }

    } else {
        $error = "Invalid Username or Password ❌";
    }
}
?>

<!DOCTYPE html>

<html>
<head>
<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(120deg,#1d2b64,#f8cdda);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.box{
    width:400px;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

.title{
    text-align:center;
    font-weight:bold;
    margin-bottom:20px;
}
</style>

</head>

<body>

<div class="box">

<h3 class="title">🏥 Clinic Login</h3>

<?php if($error){ ?>

```
<div class="alert alert-danger text-center">
    <?php echo $error; ?>
</div>
```

<?php } ?>

<form method="POST">

```
<label>Username</label>
<input type="text" name="username" class="form-control mb-2" required>

<label>Password</label>
<input type="password" name="password" class="form-control mb-3" required>

<button name="login" class="btn btn-primary w-100">
    Login
</button>

<div class="text-center mt-3">
    <a href="forgot_password.php" style="text-decoration:none;">
        Forgot Password?
    </a>
</div>
```

</form>

</div>

</body>
</html>

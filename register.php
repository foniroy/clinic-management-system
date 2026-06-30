<?php
include "db.php";

$msg = "";
$error = "";

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];

    // check duplicate username
    $check = mysqli_query($conn,
    "SELECT * FROM users WHERE username='$username'");

    if(mysqli_num_rows($check) > 0){
        $error = "Username already exists ❌";
    }
    else{

        mysqli_query($conn,
        "INSERT INTO users(name,username,password,phone,role)
        VALUES('$name','$username','$password','$phone','$role')");

        $msg = "Account created ✔ Now login";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card p-4 shadow" style="max-width:450px;margin:auto;">

<h3 class="text-center">Register</h3>

<?php if($msg){ ?>
    <div class="alert alert-success text-center">
        <?php echo $msg; ?>
    </div>
<?php } ?>

<?php if($error){ ?>
    <div class="alert alert-danger text-center">
        <?php echo $error; ?>
    </div>
<?php } ?>

<form method="POST">

    <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>

    <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>

    <input type="text" name="password" class="form-control mb-2" placeholder="Password" required>

    <input type="text" name="phone" class="form-control mb-2" placeholder="Phone Number" required>

    <select name="role" class="form-control mb-3">
        <option value="patient">Patient</option>
        <option value="doctor">Doctor</option>
        <option value="admin">Admin</option>
    </select>

    <button name="register" class="btn btn-primary w-100">
        Register
    </button>

</form>

<!-- LOGIN + BACK BUTTON -->
<div class="mt-3 d-flex justify-content-between">

    <!-- LOGIN BUTTON -->
    <a href="login.php" class="btn btn-success btn-sm">
        Login
    </a>

    <!-- BACK BUTTON -->
    <a href="index.php" class="btn btn-secondary btn-sm">
        Back
    </a>

</div>

</div>

</div>

</body>
</html>
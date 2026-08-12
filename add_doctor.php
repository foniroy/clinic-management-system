<?php
require_once 'auth.php';

include "db.php";


if (!isset($_SESSION['id']) || $_SESSION['role'] != "admin") {
    header("Location: login.php");
    exit();
}


if (isset($_POST['save_doctor'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $specialization = mysqli_real_escape_string($conn, $_POST['specialization']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $query = "INSERT INTO doctors (name, specialization, phone)
              VALUES ('$name', '$specialization', '$phone')";

    if (mysqli_query($conn, $query)) {
        $success = "Doctor added successfully!";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Doctor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card p-4 shadow" style="max-width:500px; margin:auto;">

        <h3 class="text-center mb-3">Add Doctor (Admin Only)</h3>

        <?php if (isset($success)) { ?>
            <div class="alert alert-success text-center">
                <?php echo $success; ?>
            </div>
        <?php } ?>

        <?php if (isset($error)) { ?>
            <div class="alert alert-danger text-center">
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <form method="POST">

            <input
                type="text"
                name="name"
                class="form-control mb-2"
                placeholder="Doctor Name"
                required
            >

            <input
                type="text"
                name="specialization"
                class="form-control mb-2"
                placeholder="Specialization"
                required
            >

            <input
                type="text"
                name="phone"
                class="form-control mb-3"
                placeholder="Phone Number"
                required
            >

            <button
                type="submit"
                name="save_doctor"
                class="btn btn-success w-100"
            >
                Save Doctor
            </button>

        </form>

        <div class="text-center mt-3">
            <a href="admin_dashboard.php" class="btn btn-secondary">
                ← Back to Dashboard
            </a>
        </div>

    </div>

</div>

</body>
</html>
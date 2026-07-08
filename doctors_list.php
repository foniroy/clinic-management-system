<?php
include "db.php";

/* =========================
   ADD DOCTOR
========================= */
if(isset($_POST['add_doctor'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $specialist = mysqli_real_escape_string($conn, $_POST['specialist']);

    mysqli_query($conn,
    "INSERT INTO doctors(name, phone, specialist)
     VALUES('$name', '$phone', '$specialist')");

    header("Location: doctors_list.php");
    exit();
}

/* =========================
   DELETE DOCTOR
========================= */
if(isset($_GET['delete_id'])){
    $id = intval($_GET['delete_id']);

    mysqli_query($conn, "DELETE FROM doctors WHERE id=$id");

    header("Location: doctors_list.php");
    exit();
}

/* =========================
   FETCH DOCTORS
========================= */
$result = mysqli_query($conn, "SELECT * FROM doctors ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Doctor List</h3>

        <!-- BACK BUTTON -->
        <a href="admin_dashboard.php" class="btn btn-secondary">
            ⬅ Back
        </a>
    </div>

    <!-- ADD DOCTOR FORM -->
    <div class="card p-3 mb-4 shadow">

        <h5 class="mb-3">➕ Add New Doctor</h5>

        <form method="POST">

            <input type="text" name="name" class="form-control mb-2" placeholder="Doctor Name" required>

            <input type="text" name="phone" class="form-control mb-2" placeholder="Phone" required>

            <input type="text" name="specialist" class="form-control mb-2" placeholder="Specialist" required>

            <button type="submit" name="add_doctor" class="btn btn-primary w-100">
                Add Doctor
            </button>

        </form>

    </div>

    <!-- DOCTOR TABLE -->
    <table class="table table-bordered text-center">

        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Specialist</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php if(mysqli_num_rows($result) > 0){ ?>

            <?php while($row = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['specialist'] ?></td>
                    <td><?= $row['phone'] ?></td>
                    <td>
                        <a href="doctors_list.php?delete_id=<?= $row['id'] ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Delete this doctor?')">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>

        <?php } else { ?>
            <tr>
                <td colspan="5">No doctors found</td>
            </tr>
        <?php } ?>
        </tbody>

    </table>

</div>

</body>
</html>
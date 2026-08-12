<?php
require_once 'auth.php';
?>
<?php
include "db.php";

/* =========================
   DELETE APPOINTMENT
========================= */
if(isset($_GET['delete_id'])){
    $id = intval($_GET['delete_id']);

    mysqli_query($conn, "DELETE FROM appointments WHERE id=$id");

    header("Location: appointments_list.php");
    exit();
}

/* =========================
   FETCH APPOINTMENTS
========================= */
$result = mysqli_query($conn, "SELECT * FROM appointments ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Appointments List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <!-- HEADER + BACK -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Appointments List</h3>

        <a href="admin_dashboard.php" class="btn btn-secondary">
            ⬅ Back
        </a>
    </div>

    <table class="table table-bordered text-center">

        <!-- TABLE HEADER -->
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

        <?php if(mysqli_num_rows($result) > 0){ ?>

            <?php while($row = mysqli_fetch_assoc($result)){ ?>

                <tr>

                    <td><?= $row['id']; ?></td>

                    <!-- Patient Name -->
                    <td>
                        <?= !empty($row['patient_name']) ? $row['patient_name'] : 'N/A'; ?>
                    </td>

                    <!-- Doctor Name -->
                    <td>
                        <?= !empty($row['doctor_name']) ? $row['doctor_name'] : 'N/A'; ?>
                    </td>

                    <!-- Date -->
                    <td>
                        <?= !empty($row['appointment_date']) ? $row['appointment_date'] : 'N/A'; ?>
                    </td>

                    <!-- TIME (IMPORTANT FIX) -->
                    <td>
                        <?= !empty($row['appointment_time']) ? $row['appointment_time'] : 'N/A'; ?>
                    </td>

                    <!-- STATUS -->
                    <td>
                        <?php if($row['status']=="pending"){ ?>
                            <span class="badge bg-warning">Pending</span>

                        <?php } elseif($row['status']=="confirmed"){ ?>
                            <span class="badge bg-success">Approved</span>

                        <?php } else { ?>
                            <span class="badge bg-danger">Cancelled</span>
                        <?php } ?>
                    </td>

                    <!-- ACTION -->
                    <td>

                        <a href="update_appointment.php?id=<?= $row['id']; ?>&status=confirmed"
                           class="btn btn-success btn-sm">
                            Approve
                        </a>

                        <a href="update_appointment.php?id=<?= $row['id']; ?>&status=cancelled"
                           class="btn btn-danger btn-sm">
                            Cancel
                        </a>

                        <!-- DELETE -->
                        <a href="appointments_list.php?delete_id=<?= $row['id']; ?>"
                           class="btn btn-dark btn-sm"
                           onclick="return confirm('Are you sure you want to delete this appointment?')">
                            Delete
                        </a>

                    </td>

                </tr>

            <?php } ?>

        <?php } else { ?>

            <tr>
                <td colspan="7">No appointments found</td>
            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

</body>
</html>
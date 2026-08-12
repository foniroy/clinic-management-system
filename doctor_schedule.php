<?php
require_once 'auth.php';
?>
<?php
include "db.php";

$result = mysqli_query($conn, "
    SELECT * FROM appointments 
    ORDER BY appointment_date ASC, appointment_time ASC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Schedule</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

<h3 class="text-center mb-3">📅 Doctor Schedule</h3>

<table class="table table-bordered text-center">

    <thead class="table-dark">
        <tr>
            <th>Doctor</th>
            <th>Patient</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>

    <?php while($row = mysqli_fetch_assoc($result)){ ?>

        <tr>
            <td><?= $row['doctor_name'] ?></td>
            <td><?= $row['patient_name'] ?></td>
            <td><?= $row['appointment_date'] ?></td>
            <td><?= $row['appointment_time'] ?></td>
            <td>
                <?php if($row['status']=="pending"){ ?>
                    <span class="badge bg-warning">Pending</span>
                <?php } elseif($row['status']=="confirmed"){ ?>
                    <span class="badge bg-success">Approved</span>
                <?php } else { ?>
                    <span class="badge bg-danger">Cancelled</span>
                <?php } ?>
            </td>
        </tr>

    <?php } ?>

    </tbody>

</table>

</div>

</body>
</html>
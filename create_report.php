<?php
require_once 'auth.php';

include "db.php";

if($_SESSION['role'] != "doctor"){
    exit("Access Denied ❌ Only Doctor");
}

$doctor_name = $_SESSION['user'];

// doctor এর নিজের appointment list আনবো
$appointments = mysqli_query($conn,
"SELECT * FROM appointments WHERE status='confirmed'");

if(isset($_POST['submit'])){

    $patient_id = $_POST['patient_id'];
    $patient_name = $_POST['patient_name'];
    $appointment_id = $_POST['appointment_id'];   // ✅ এখানে বসবে
    $report_text = $_POST['report_text'];

    $sql = "INSERT INTO reports
    (patient_id, patient_name, doctor_name, appointment_id, report_text, status)
    VALUES
    ('$patient_id','$patient_name','$doctor_name','$appointment_id','$report_text','pending')";

    mysqli_query($conn,$sql);

    echo "<script>alert('Report Sent to Admin ✔');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card p-4 shadow" style="max-width:600px;margin:auto;">

<h3 class="text-center mb-3">Doctor Report System</h3>

<form method="POST">

    <!-- PATIENT ID -->
    <label>Patient ID</label>
    <input type="number" name="patient_id" class="form-control mb-2" required>

    <!-- PATIENT NAME -->
    <label>Patient Name</label>
    <input type="text" name="patient_name" class="form-control mb-2" required>

    <!-- APPOINTMENT SELECT -->
    <label>Select Appointment</label>
    <select name="appointment_id" class="form-control mb-3" required>

        <option value="">-- Choose Appointment --</option>

        <?php while($a = mysqli_fetch_assoc($appointments)){ ?>
            <option value="<?php echo $a['id']; ?>">
                ID: <?php echo $a['id']; ?> | <?php echo $a['patient_name']; ?> | <?php echo $a['date']; ?>
            </option>
        <?php } ?>

    </select>

    <!-- REPORT -->
    <label>Report</label>
    <textarea name="report_text" class="form-control mb-3" required></textarea>

    <button name="submit" class="btn btn-primary w-100">
        Send Report to Admin
    </button>

</form>

</div>

</div>

</body>
</html>
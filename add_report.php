<?php
require_once 'auth.php';

include "db.php";

if(!isset($_SESSION['id']) || $_SESSION['role']!="doctor"){
    header("Location: login.php");
    exit();
}

$doctor_id = $_SESSION['id'];
$doctor_name = $_SESSION['user'];

$msg = "";

if(isset($_POST['submit'])){

    $patient_id = $_POST['patient_id'];
    $patient_name = $_POST['patient_name'];
    $appointment_id = $_POST['appointment_id'];
    $report_text = $_POST['report_text'];

    $sql = "INSERT INTO reports 
    (patient_id,patient_name,doctor_name,appointment_id,report_text,status)
    VALUES
    ('$patient_id','$patient_name','$doctor_name','$appointment_id','$report_text','pending')";

    if(mysqli_query($conn,$sql)){
        $msg = "Report Saved Successfully ✔";
    } else {
        $msg = "Error: ".mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Report</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

<h3>Add Report</h3>

<?php if($msg){ ?>
<div class="alert alert-info"><?php echo $msg; ?></div>
<?php } ?>

<form method="POST">

<input type="number" name="patient_id" placeholder="Patient ID" class="form-control mb-2" required>

<input type="text" name="patient_name" placeholder="Patient Name" class="form-control mb-2" required>

<input type="number" name="appointment_id" placeholder="Appointment ID" class="form-control mb-2" required>

<textarea name="report_text" placeholder="Report" class="form-control mb-2" required></textarea>

<button name="submit" class="btn btn-primary">
Submit Report
</button>

</form>

</div>

</body>
</html>
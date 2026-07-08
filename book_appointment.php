<?php
session_start();
include "db.php";

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['book'])){

    $patient_id = $_SESSION['id'];
    $patient_name = $_SESSION['user'];

    $doctor_id = intval($_POST['doctor_id']);
    $date = $_POST['date'];
    $time = $_POST['time'];

    $doc = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT name FROM doctors WHERE id=$doctor_id")
    );

    $doctor_name = $doc['name'];

    /* CHECK TIME SLOT (IMPORTANT) */
    $check = mysqli_query($conn,"
        SELECT * FROM appointments 
        WHERE doctor_id='$doctor_id' 
        AND appointment_date='$date' 
        AND appointment_time='$time'
    ");

    if(mysqli_num_rows($check) > 0){
        echo "<script>alert('This time slot is already booked!');</script>";
    }
    else{

        mysqli_query($conn,"
            INSERT INTO appointments
            (patient_id, patient_name, doctor_id, doctor_name, appointment_date, appointment_time, status)
            VALUES
            ('$patient_id','$patient_name','$doctor_id','$doctor_name','$date','$time','pending')
        ");

        header("Location: book_appointment.php?success=1");
        exit();
    }
}

$doctors = mysqli_query($conn, "SELECT * FROM doctors");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

<h3 class="text-center mb-4">Book Appointment</h3>

<?php if(isset($_GET['success'])){ ?>
    <div class="alert alert-success text-center">
        Appointment Booked ✔
    </div>
<?php } ?>

<form method="POST">

    <select name="doctor_id" class="form-control mb-2" required>
        <option value="">Select Doctor</option>
        <?php while($row = mysqli_fetch_assoc($doctors)){ ?>
            <option value="<?= $row['id'] ?>">
                <?= $row['name'] ?>
            </option>
        <?php } ?>
    </select>

    <input type="date" name="date" class="form-control mb-2" required>

    <input type="time" name="time" class="form-control mb-2" required>

    <button class="btn btn-primary w-100" name="book">
        Book Appointment
    </button>

</form>

</div>

</body>
</html>
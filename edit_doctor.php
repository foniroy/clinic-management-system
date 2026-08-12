<?php
require_once 'auth.php';


$conn = mysqli_connect("localhost","root","","ClinicManagementSystem");

// 🔒 SECURITY CHECK (ONLY ADMIN)
if(!isset($_SESSION['user']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    echo "Access Denied ❌ Only Admin can access this page";
    exit();
}

// check id
if(!isset($_GET['id'])){
    echo "Invalid Request ❌";
    exit();
}

$id = $_GET['id'];

// fetch doctor data
$result = mysqli_query($conn,"SELECT * FROM doctors WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if(!$row){
    echo "Doctor Not Found ❌";
    exit();
}

// update process
if($_POST){

    $name = $_POST['name'];
    $specialization = $_POST['specialization'];
    $phone = $_POST['phone'];

    $sql = "UPDATE doctors SET 
            name='$name',
            specialization='$specialization',
            phone='$phone'
            WHERE id=$id";

    if(mysqli_query($conn,$sql)){
        $success = "Doctor Updated Successfully 👍";
    } else {
        $error = "Update Failed ❌";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Doctor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card p-4 shadow" style="max-width:500px;margin:auto;">

        <h3 class="text-center mb-3">Edit Doctor (Admin Only)</h3>

        <?php if(isset($success)){ ?>
            <div class="alert alert-success text-center">
                <?php echo $success; ?>
            </div>
        <?php } ?>

        <?php if(isset($error)){ ?>
            <div class="alert alert-danger text-center">
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <form method="POST">

            <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control mb-2" required>

            <input type="text" name="specialization" value="<?php echo $row['specialization']; ?>" class="form-control mb-2" required>

            <input type="text" name="phone" value="<?php echo $row['phone']; ?>" class="form-control mb-2" required>

            <button class="btn btn-primary w-100">Update</button>

        </form>

        <div class="text-center mt-3">
            <a href="view_doctors.php">← Back</a>
        </div>

    </div>

</div>

</body>
</html>
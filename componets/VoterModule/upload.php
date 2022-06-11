<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Upload</title>
    <link rel="stylesheet" href="./css/upload.css">

</head>

<body>
    <div class="uploading-data">
        <div class="imgs">
            <img src="../images/undraw_fill_form_re_cwyf.svg" alt="">
        </div>
        <div class="container" id="container">

            <div class="progress-bar" id="progress-bar">

            </div>
        </div><br>

        <h1 style="color: red;">Verification In Progress!Don't reload page</h1>

    </div>

</body>


</html>
<?php
session_start();
include '../connection.php';

if (isset($_POST['submit'])) {
    $name = $_POST['student_name'];
    $course = $_POST['course'];
    $sem = $_POST['sem'];
    $spid = $_POST['spid'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $status = 0;
    if (isset($_FILES['file'])) {
        $files = $_FILES['file'];
        $filename = $files['name'];
        $filetmp = $files['tmp_name'];
        $destinationfile = '../upload/' . $filename;
        move_uploaded_file($filetmp, $destinationfile);
    }
}

$insertquery = "INSERT INTO `votertb`(`spid`, `name`, `courseId`, `sem`, `email`, `password`, `photo`, `status`) VALUES ('$spid','$name','$course','$sem','$email','$pass','$destinationfile','$status')";
//updated today
?>
<script>
    function redirectPage() {
        <?php
        $i = mysqli_query($con, $insertquery);
        if ($i <= 0) {
        ?>
            window.location = "./voter_registration.php";
        <?php
        } else {
        ?>
            window.location = "../common/login.php";
        <?php
        }

        ?>

    }
    setTimeout("redirectPage()", 10000);
</script>
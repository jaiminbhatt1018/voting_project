<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Upload</title>
    <link rel="stylesheet" href="./upload.css">

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
    $agenda = $_POST['agenda'];
    $aproved_status = 0;
    $status = 0;
    if (isset($_FILES['file'])) {
        $files = $_FILES['file'];
        $filename = $files['name'];
        $filetmp = $files['tmp_name'];
        $destinationfile = '../upload/' . $filename;
        move_uploaded_file($filetmp, $destinationfile);
    }
}

$insertquery = "insert into candidatetb(candidate_spid, name, email, password, agenda, approved_status, voting_status, courseid, sem, photo) values ('$spid','$name','$email','$pass','$agenda','$aproved_status','$status','$course','$sem','$destinationfile')";
//updated today
?>
<script>
    function redirectPage() {
        <?php
        $i = mysqli_query($con, $insertquery);
        if (mysqli_affected_rows($con) <= 0) {
        ?>
            window.location = "./candidate_registration.php";
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
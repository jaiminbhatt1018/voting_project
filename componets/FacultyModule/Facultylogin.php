<?php
//include '../connection.php';
session_start();
$con = mysqli_connect("localhost", "root", "", "electiondb");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://use.fontawesome.com/1643093b1e.js"></script>
    <link rel="stylesheet" href="login.css">
    <title>login</title>
    <link rel="stylesheet" href="Facultylogin.css">
</head>

<body>

    <div class="container">
        <div class="login_pass_detail">
            <h1 style="color: darkorange; font-size:50px;">V.N.S.G.U </h1><br>
            <h1 style="font-size:40px;">Students Election Portal</h1><br>

            <form action="#" method="POST" enctype="multipart/form-data">
                <h2 style="font-size:50px;"> Faculty Login</h1>

                    <input class="form_input" type="text" id="email" name="email" placeholder="Email" /><br>


                    <input class="form_input" type="password" id="pass" name="pass" placeholder="Password" /><br>
                    <button type="submit" name="submit"> Login </button><br><br>
            </form>
        </div>
        <img src="./undraw_teacher_-35-j2.svg" alt="">
    </div>
</body>

</html>
<?php
if (isset($_POST['submit'])) {

    $pass = $_POST['pass'];
    $email = $_POST['email'];

    $query = "SELECT * FROM `facultytb` WHERE email='$email' and password='$pass'";
    $displayquery = mysqli_query($con, $query);
    $result = mysqli_fetch_array($displayquery);
    if ($result) {
        $_SESSION['faculty_email'] = $result['email'];
        $_SESSION['password'] = $result['password'];
        $_SESSION['sem'] = $result['sem_incharge'];
        header("location:FacultyConformation.php");
    } else {
?><script>
            alert('LOGIN FAILED! wrong email or PASSWORD!')
        </script> <?php
                }
            }

                    ?>
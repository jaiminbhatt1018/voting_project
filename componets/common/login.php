<?php
session_start();
include '../connection.php';
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

</head>

<body>

    <div class="container">
        <div class="login_pass_detail">
            <h1 style="color: darkorange; font-size:50px;">V.N.S.G.U </h1><br>
            <h1 style="font-size:40px;">Students Election Portal</h1><br>

            <form action="#" method="POST" enctype="multipart/form-data">
                <h2 style="font-size:50px;"> Student login</h1>

                    <input class="form_input" type="text" id="Email" name="email" placeholder="Email" /><br>


                    <input class="form_input" type="password" id="pass" name="pass" placeholder="Password" /><br>
                    <button type="submit" name="submit"> Login </button><br><br>
                    <p>Didn't Registered Yet?</p><a href="student_registration.php" style="color: green ;font-size:26px;">Register Now</a>
            </form>
        </div>
        <img src="../images/undraw_secure_login_pdn4.svg" alt="">
    </div>
</body>

</html>
<?php
if (isset($_POST['submit'])) {


    $pass = $_POST['pass'];
    $email = $_POST['email'];

    $con = mysqli_connect($servername, $username, $password, $db);
    $query = "select * from votertb where email='$email'and password='$pass'";
    $displayquery = mysqli_query($con, $query);

    if ($displayquery->num_rows > 0) {
        $result = mysqli_fetch_array($displayquery);
        $_SESSION['spid'] = $result['spid'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['password'] = $result['password'];
        header("location:../VoterModule/profile/myprofile.php");
    } else {
?><script>
            alert('LOGIN FAILED! wrong MOBILE NUMBER or PASSWORD!')
        </script> <?php
                }
            }
            exit();
                    ?>
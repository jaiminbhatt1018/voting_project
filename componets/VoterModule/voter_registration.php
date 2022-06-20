<?php
session_start();
include '../connection.php';
$sql = "select * from electioninfotb where electionid=1";
$query = mysqli_query($con, $sql);
$result = mysqli_fetch_array($query);
if (date("d-m-y") > $result["registrationEndDate"]) {
    header("location:../common/login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student registration form</title>
    <script src="https://use.fontawesome.com/1643093b1e.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="../jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/register.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body class="body">
    <div class="pass-alert d-flex flex-row justify-content-center mx-2">

    </div>

    <div class="main d-flex flex-row justify-content-center align-items-center">

        <div class="img">
            <div class="headings">
                <h2> <b style="color:#ca3b00 ">V.N.S.G.U</b> Student Election Portal</h2>
                <h1>Voter Registration</h1>
                <hr />
            </div>
            <img src="../images/undraw_mobile_encryption_cl5q.svg" alt="" srcset="">
        </div>
        <div class=" container registration_detail ">

            <div class="details d-flex flex-column  justify-content-center container mt-5">
                <div class="icon">
                    <i class="fa fa-user-circle-o fa-5x" style="font-size:44px"></i>
                </div>

                <form action="upload.php" method="POST" enctype="multipart/form-data">


                    <label for="rollno">SPID : </label>
                    <input type="number" name="spid" id="spid" placeholder=" Ex:2019008852 " required /><br>

                    <label for="student_name">NAME : </label>
                    <input type="text" name="student_name" id="student_name" placeholder=" Ex: Bhatt Jaimin Urvishkumar" required /><br>


                    <select name="course" id="course" class="course" required>
                        <option value=0 id="course_val">--Select Course--</option>
                        <?php
                        $sql = "select * from coursetb ";
                        $query = mysqli_query($con, $sql);
                        while ($record = mysqli_fetch_array($query)) { ?>

                            <option style="font-size:15px" value="<?php echo $record['courseId'] ?>"> <?php echo $record['courseName'] ?> </option>;
                        <?php
                        }
                        ?>

                    </select>

                    <div id="sem-select">
                        <select id="sem" name="sem" required>
                            <option value=0>--Select Semester--</option>
                        </select>
                    </div>


                    <label for="email">EMAIL : </label>
                    <input type="email" name="email" id="email" placeholder=" Ex: jaiminbhatt.mscit19@vnsgu.ac.in" required />
                    <br>



                    <label for="password">PASSWORD : </label>
                    <input type="password" name="password" id="password" class="mb-0 pb-0" placeholder="Ex : jaimin123@ " required />
                    <p class="guidlines">
                    <ul class="guidlines">
                        <li id="UpperCase">1 Upper Case</li>
                        <li id="Digit">1 Digit </li>
                        <li id="SpChar">1 Special Caracters</li>
                    </ul>
                    </p>
                    <br>



                    <label for="file">UPLOAD IMAGE : </label>
                    <input id="photo" name="file" style="border:none" type="file" placeholder="uplode photo" required />
                    <br>


                    <button class="btn btn-primary w-50" type="submit" name="submit"> Register </button>

                </form>
            </div>

        </div>


    </div>
    <script src="./validation.js"></script>
    <script>
        $('#course').on("change", function() {

            var course = this.value;


            $.ajax({

                url: "load_sem.php",
                type: "POST",
                data: {
                    course: course
                },
                cache: false,
                success: function(result) {
                    alert(result);
                    $("#sem").html(result);
                }

            });
        });
        var myCarousel = document.querySelector('#myCarousel')
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 1500,
            wrap: false
        })
    </script>
</body>


</html>
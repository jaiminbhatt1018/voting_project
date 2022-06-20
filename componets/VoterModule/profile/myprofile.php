<?php
session_start();
include '../../connection.php';

$sql = "select * from electioninfotb where electionid=1";
$query = mysqli_query($con, $sql);
$result = mysqli_fetch_array($query);
if (date("d-m-y") < $result["VotingStartDate"]) {
  header("location:../error.html");
}
$email = $_SESSION['email'];
$pass = $_SESSION['password'];
$query = "select * from votertb where email='$email' and password='$pass'";
$displayquery = mysqli_query($con, $query);
$result = mysqli_fetch_array($displayquery);

$courseId = $result['courseId'];
$query = "select * from coursetb where courseId='$courseId' ";
$displayquery = mysqli_query($con, $query);
$Course_result = mysqli_fetch_array($displayquery);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://use.fontawesome.com/1643093b1e.js"></script>
  <link rel="stylesheet" href="../css/profile.css">

  </script>

</head>

<body>
  <div class="container">
    <table class="bio">
      <thead>

      </thead>
      <tbody class="profile">

        <tr>

          <td style="padding-left:40px"><img id="photo" src="../../upload/<?php echo $result['photo'] ?>" height="100px
" width="100px"></td>
        </tr>

        <tr>
          <td>Spid : &nbsp</td>
          <td><?php echo $result['spid']; ?></td>
        </tr>
        <tr style="background-color: white;border-radius: 30px; width :110%; margin-left:4%">
          <td>Name : </td>
          <td><?php echo $result['name']; ?></td>
        </tr>

        <tr>
          <td>Course :</td>
          <td><?php echo $Course_result['courseName'] ?></td>
        </tr>
        <tr>
          <td>Sem : &nbsp&nbsp</td>
          <td><?php echo $result['sem']; ?></td>
        </tr>
        <tr>
          <td>Email : &nbsp</td>
          <td style="font-size: 1.3rem;"><?php echo $result['email']; ?></td>
        </tr>

        <tr>
          <td>Voting Status : </td>
          <td id="status"><?php echo $result['status'] == 0 ? "Not voted" : "Voted" ?></td>
        </tr>
        <tr>
          <td><button class="edit"><a href="" style="text-decoration:none; color:white; font-size:1.5rem;">Edit</a></button></td>
        </tr>
      </tbody>
    </table>
    <div class="list">
      <div class="msg mx-5">

      </div>

      <div class="imgs">
        <table class="table candidate_list">
          <thead>



          </thead>
          <tbody class="mx-3">

            <?php
            $approved = 1;
            $candidate = "select * from candidatetb where approved_status = $approved";
            $query = mysqli_query($con, $candidate);
            while ($record = mysqli_fetch_array($query)) {
            ?>
              <tr>
                <td><img src="../../upload/<?php echo $record['photo']; ?>" width="100px" height="100px" class="rounded"></td>
                <td style="font-size: 20px; font-weight:bolder"><?php echo $record['name']; ?></td>
                <td><button class="btn btn-lg accesscamera"><a class="vote_btn" onclick="setC_id('<?php echo $record['candidate_spid']; ?>')" data-toggle="modal" data-target=".photoModal">Vote Now</a></button></td>

              </tr>
            <?php
            } ?>


            <script>
              var status = document.getElementById('status').innerText;
              document.getElementById('status').style.color = 'red';

              if (status == "Voted") {

                document.getElementById('status').style.color = 'green';

                var ele = document.getElementsByClassName("vote_btn");
                for (let i = 0; i < ele.length; i++) {
                  ele[i].disabled = true;
                  ele[i].innerText = "Already Voted"
                }
                ele = document.getElementsByClassName("accesscamera");
                for (let i = 0; i < ele.length; i++) {
                  ele[i].disabled = true;
                }
                ele = ` <div style="font-size: 20px;" class="alert d-flex justify-content-start alert-success alert-dismissible my-2" id="myAlert">

                  You Have Already Voted Successfully!.
                  <a style="color: black; margin-left:70%; font-size:16px" href="#" class="close"><i class="fa fa-times"></i></a>
                  </div>`
                $(".msg").append(ele);

              } else {
                console.log("not changed1");

              }



              function show_alert() {
                if (status == "Voted") {
                  $(".vote_btn").click(function() {
                    $("#myAlert").alert("open");
                  });

                }

              }
            </script>
          </tbody>
        </table>

      </div>



      <div class="modal fade photoModal" id="photoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Capture Photo</h5>

              <i class="fa fa-times" data-dismiss="modal" aria-label="Close"></i>

            </div>
            <div class="modal-body">
              <div>
                <div id="my_camera" class="d-block mx-auto rounded overflow-hidden"></div>
              </div>
              <div id="results" class="d-none"></div>
              <form method="post" id="photoForm">
                <input type="hidden" id="photoStore" name="photoStore" value="">
                <input type="text" id="candidate_id" name="c_id" value="<?php ?>" hidden>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-warning mx-auto text-white" id="takephoto">Capture Photo</button>
              <button type="button" class="btn btn-warning mx-auto text-white d-none" id="retakephoto">Retake</button>
              <button type="submit" class="btn btn-warning mx-auto text-white d-none" id="uploadphoto" form="photoForm">Upload</button>
            </div>
          </div>
        </div>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

      <script src="./plugin/sweetalert/sweetalert.min.js"></script>
      <script src="./plugin/webcamjs/webcam.min.js"></script>
      <script src="main.js"></script>

</body>
<script>
  function setC_id(id) {
    $('#candidate_id').prop('value', id);

  }

  function send_cid(id) {

    $.ajax({
      url: '../../common/givevote.php',
      type: 'POST',
      data: {
        c_id: id
      },
      success: function() {
        setTimeout(() => {
          window.location = "./myprofile.php"
        }, 2000)
      }

    });


  }
</script>

</html>
<?php
session_start();
include "../connection.php";
$query = "select * from candidatetb";
mysqli_query($con, $query);
$total_candidate = mysqli_affected_rows($con);
$query = "select * from candidatetb where approved_status=1";
mysqli_query($con, $query);
$total_approved = mysqli_affected_rows($con);
$total_pending = $total_candidate - $total_approved;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- CSS only -->
  <link rel="stylesheet" href="../Navbar.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="./Facultyconfirmation.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://use.fontawesome.com/1643093b1e.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>


<body>
  <div class="nav_component ">
  </div>

  <div class="section_main d-flex flex-row">
    <div class="table_div">

      <table class="table">

        <tbody class="d-flex flex-column">

          <tr class="mb-5"></tr>
          <tr class="mb-5 mx-4  rounded ">
            <th scope="row"><img src="../images/monitor.png" width="30px" height="30px" /></th>
            <td><a id="Dashboard" class="Dashboard" href="#"> Dashboard</a></td>
          </tr>



          <tr class="mb-5 mx-4  rounded ">
            <th scope="row"><i class="fa fa-list"></i></th>
            <td><a id="list"> Nominations List</a></td>
          </tr>



          <tr class="mb-5 mx-4  rounded ">
            <th scope="row "><i class="fa fa-eye"></i> </th>
            <td><a id="viewResult"> View Results</a></td>
          </tr>



          <tr class="mb-5 mx-4  rounded " style="background-color: darkorange;">
            <th scope="row "><i class="fa fa-pie-chart"></i> </th>
            <td><a id="stats" href="">Faculty Statastics</a> </td>
          </tr>



        </tbody>

      </table>
    </div>
    <div class="container ">
      <div class="Total d-flex flex-row p-3 justify-content-left">
        <div class="card my-3 bg-primary mx-2">
          <h2>Total Nominations : <?php echo $total_candidate ?> </h2>
        </div>

        <div class="card  my-3 bg-success mx-2 ">
          <h2>Total Approved : <?php echo $total_approved ?></h2>
        </div>
        <div class="card  my-3 bg-danger mx-2">
          <h2>Not Approved or Pending : <?php echo $total_pending ?></h2>
        </div>
      </div>
      <div class="container aproved_list ">
        <div class="mx-2 my-2" id="mydiv" data-aos="zoom-in-up" data-aos-duration="500">

        </div>
      </div>
    </div>
    <form method="post" id="photoForm">
      <input type="text" id="c_id" name="c_id" value="<?php ?>" hidden>
    </form>
  </div>
</body>

<script>
  AOS.init();
</script>
<script>
  var count = 0;
  $(document).ready(function() {

    $("#Dashboard").click(function() {
      let ele = ` <table class="table candidate_list " data-aos="zoom-in-up" data-aos-duration="500" >
            <thead>
              <th scope="col">Spid</th>
              <th scope="col">Photo</th>
              <th scope="col">Name</th>
              <th scope="col">Sem</th>

            </thead>
            <tbody>

              <?php
              $sem = $_SESSION['sem'];
              $candidate = "select * from candidatetb where approved_status=1 and sem=$sem";
              $query = mysqli_query($con, $candidate);
              while ($record = mysqli_fetch_array($query)) {
              ?>
                <tr>
                  <th scope="row"><?php echo $record['candidate_spid']; ?></th>
                  <td><img src="../upload/<?php echo $record['photo']; ?>" width="100px" height="100px" class="rounded"></td>
                  <td><?php echo $record['name']; ?></td>
                  <td><?php echo $record['sem']; ?></td>
                </tr>
              <?php
              } ?>
            </tbody>
          </table>`
      $("#mydiv").html("");
      $('#mydiv').append(ele);
    });
    $("#list").click(function() {

      let element = `<table class="table candidate_list "data-aos="zoom-in-up" data-aos-duration="500">
      <thead>
      <th scope="col">Spid</th>
      <th scope="col">Photo</th>
      <th scope="col">Name</th>
      <th scope="col">Sem</th>
      <th scope="col">Course</th>
      <th scope="col" colspan=2 >Request</th>
      </thead>
            <tbody>
             
              <?php
              $sem = $_SESSION['sem'];
              $candidate = "select * from candidatetb where approved_status=0 and sem=$sem";
              $query = mysqli_query($con, $candidate);

              while ($record = mysqli_fetch_array($query)) {
              ?>
                <tr>
                  <th scope="row"><?php echo $record['candidate_spid']; ?></th>
                  <td><img src="../upload/<?php echo $record['photo']; ?>" width="100px" height="100px" class="rounded"></td>
                  <td><?php echo $record['name']; ?></td>
                  <td><?php echo $record['sem']; ?></td>
                  <td><button class="btn btn-success btn-lg "><a onclick="approve(<?php echo $record['candidate_spid']; ?>) ">Approve</a></button></td>
                  <td><button class="btn btn-danger btn-lg "><a onclick="reject(<?php echo $record['candidate_spid']; ?>) ">Reject</a></button></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>`
      $("#mydiv").html("");
      $('#mydiv').append(element);




    });
  });

  function reload() {
    window.location = "./FacultyConformation.php"
  }

  function approve(id) {

    $.ajax({
      url: './aprove.php',
      type: 'POST',
      data: {
        c_id: id
      },
      success: function(d) {
        console.log(d);
        if (d == true) {
          swal({
            title: 'Candidate Aproved successfully',
            text: ' Success',
            icon: 'success',
            buttons: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
            timer: 2000
          })
          setTimeout(reload, 2000);

        } else {
          swal({
            title: 'Error',
            text: 'Something went wrong',
            icon: 'error'
          })
        }

      }
    });
  }

  function reject(id) {

    $.ajax({
      url: './reject.php',
      type: 'POST',
      data: {
        c_id: id
      },
      success: function(d) {

        if (d == true) {
          swal({
            title: 'Candidate Rejected ',
            text: 'Nomination will be deleted!',
            icon: 'error',
            buttons: true,
            closeOnClickOutside: false,
            closeOnEsc: false,
            timer: 2000
          })
          setTimeout(reload, 2000);
        } else {
          swal({
            title: 'Error',
            text: 'Something went wrong',
            icon: 'error'
          })
        }

      }
    });
  }
</script>

<script src="../VoterModule/profile/plugin/sweetalert/sweetalert.min.js"></script>


<<html>

  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {
        packages: ["corechart"]
      });
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        $("#mydiv").html("");
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Approval Rate', <?php echo $total_approved ?>],
          ['Rejection Rate', <?php echo $total_pending ?>],

        ]);

        var options = {
          title: 'My Daily Activities',
          pieHole: 0.5,
          width: 1000,
          height: 500,
          animation: {
            "startup": true
          }
        };

        var chart = new google.visualization.PieChart(document.getElementById('mydiv'));
        chart.draw(data, options);
      }
      $("#viewResult").on('click', function() {

        google.charts.load('current', {
          'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
          $("#mydiv").html("");
          var data = google.visualization.arrayToDataTable([
            <?php
            $sql = "select * from resulttb";
            $query = mysqli_query($con, $sql);
            while ($record = mysqli_fetch_array($query)) {
            ?>[' ', 'votes'],
              ['<?php echo $record['name'] ?>', <?php echo $record['votes'] ?>],
            <?php
            }
            ?>
          ]);

          var options = {
            chart: {
              title: 'Live Voting Results....',
              subtitle: 'V.N.S.G.U, Students Elections: 2022-2023',
            },
            width: 1020,
            height: 400,
            animation: {
              "startup": true
            },
            titleTextStyle: {
              fontSize: 22
            }
          };


          let ele = `<br><button class="btn btn-success btn-lg">Publish Result</button>`

          var chart = new google.charts.Bar(document.getElementById('mydiv'));

          chart.draw(data, google.charts.Bar.convertOptions(options));
          $("#mydiv").append(ele);
        }


      });
    </script>

</html>
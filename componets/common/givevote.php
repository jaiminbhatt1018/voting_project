<?php
session_start();
include '../connection.php';
$candidate_id = $_POST['c_id'];
$sql = "select * from resulttb where spid=" . $candidate_id;

$query = mysqli_query($con, $sql);
$record = mysqli_fetch_array($query);
$votes = $record['votes'] + 1;
$update_sql = "update resulttb set votes='$votes' where spid=" . $candidate_id;
$upd_query = mysqli_query($con, $update_sql);

$update_status = "UPDATE votertb set `status` = 1 where `spid`=" . $_SESSION['spid'];
$i = mysqli_query($con, $update_status);

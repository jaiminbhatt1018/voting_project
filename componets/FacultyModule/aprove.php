
<?php
session_start();
include '../connection.php';
$spid = $_POST['c_id'];

$query = "select * from candidatetb where candidate_spid=$spid";
$displayquery = mysqli_query($con, $query);
$record = mysqli_fetch_array($displayquery);
$c_id = $record['candidate_spid'];
$c_name = $record['name'];
$initial_votes = 0;
$sql = "insert into resulttb(spid,name,votes,percentage) values  ($c_id,'$c_name',$initial_votes,0.0)";
$vote_query = mysqli_query($con, $sql);
if ($vote_query > 0) {
    $sql = "update candidatetb set approved_status = 1 where candidate_spid=$c_id";
    $res = mysqli_query($con, $sql);
    if (mysqli_affected_rows($con) > 0) {
        echo (true);
    }
} else {
    echo die(false);
}

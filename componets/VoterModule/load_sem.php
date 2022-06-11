<?php
include "../connection.php";
$course = $_POST['course'];
echo $course;
$sql = "select * from coursetb where courseId=$course";
$query = mysqli_query($con, $sql);
$record = mysqli_fetch_array($query);
$count = 1;
while ($count <= $record['TotalSem']) {
?>

    <option style="font-size:15px" value="<?php echo $count ?>"> <?php echo $count ?> </option>;
<?php
    $count++;
}
?>
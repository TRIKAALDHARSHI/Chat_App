<?php
$room = $_POST['room'];
include 'db_connect.php';

$sql = "SELECT msg, stime, ip FROM msgs WHERE room = '$room'";
$res = "";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
     $res = $res . '<div class="container">';
     $res = $res . $row['ip'];
     $res = $res . '<p>'.$row['msg'].'</p>';
     $res = $res . ' <span class="time-right">'.$row['stime'].'</span>';
     $res = $res . '</div>';
  }
}
echo $res;
?>
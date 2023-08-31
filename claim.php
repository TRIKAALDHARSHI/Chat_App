<?php
$room = $_POST['room'];

if(strlen($room)>20  or strlen($room)<2 ){
  $message = "Please choose a name between 2 to 20 characters";
  echo '<script language="javascript"> window.location="http://localhost/chatroom"; alert("'.$message.'") ; 
  </script>';
}

else if(!ctype_alnum($room)){
  $message = "Please choose an alphanumeric room name";
  echo '<script language="javascript"> window.location="http://localhost/chatroom"; alert("'.$message.'") ; 
   </script>';
}

else{
  include 'db_connect.php';
}

$sql = "SELECT * FROM `rooms` WHERE roomname = '$room' ";
$result = mysqli_query($conn, $sql);
if($result){
  if (mysqli_num_rows($result) > 0){
    $message = "Room name already exists";
    echo '<script language="javascript"> window.location="http://localhost/chatroom"; alert("'.$message.'") ; 
     </script>';
  }
  else{
    $sql = "INSERT INTO `rooms` (`sno`, `roomname`, `sname`) VALUES (NULL, '$room', current_timestamp())";
    if(mysqli_query($conn, $sql));
    $message = "Room name created";
    echo '<script language="javascript">';
    echo 'window.location="http://localhost/chatroom/rooms.php?roomname=' . $room . '";';
    echo '</script>';
    
  }
}
else{
  echo "Error".mysqli_error($conn);
}
?>


<?php
  $roomname  = $_GET['roomname'];
  include 'db_connect.php';
  $sql = "SELECT * FROM rooms WHERE roomname = '$roomname'";
  $result = mysqli_query($conn, $sql);
  if($result){
      if(mysqli_num_rows($result) == 0){
        $message = "Room name does not exists";
        echo '<script language="javascript"> window.location="http://localhost/chatroom"; alert("'.$message.'") ; 
         </script>';
      }
  }
  else{
    echo "Error:" . mysqli_error($conn);
  }
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      margin: 0 auto;
      max-width: 800px;
      padding: 0 20px;
    }

    .container {
      border: 2px solid #dedede;
      background-color: #f1f1f1;
      border-radius: 5px;
      padding: 10px;
      margin: 10px 0;
    }

    .darker {
      border-color: #ccc;
      background-color: #ddd;
    }

    .container::after {
      content: "";
      clear: both;
      display: table;
    }

    .container img {
      float: left;
      max-width: 60px;
      width: 100%;
      margin-right: 20px;
      border-radius: 50%;
    }

    .container img.right {
      float: right;
      margin-left: 20px;
      margin-right: 0;
    }

    .time-right {
      float: right;
      color: #aaa;
    }

    .time-left {
      float: left;
      color: #999;
    }

    .anyClass {
      height: 360px;
      overflow-y: scroll;
    }

    .form-control {
      width: 80%;
      padding: 8px 10px;
      outline: none;
    }

    .btn {
      padding: 8px 0;
      width: 18%;
    }

    .input-container {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-top: 30px;
    }
  </style>
</head>

<body>

  <h2>Chat Messages -
    <?php echo "$roomname" ?>
  </h2>

  <div class="container">
    <div class="anyClass">
    </div>
  </div>
  <div class="input-container">
    <input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="Type here...">
    <button class="btn btn-primary" name="submitmsg" id="submitmsg">Send</button>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script type="text/javascript">
  setInterval(runFunction, 1000);
  function runFunction() {
    $.post("htcon.php", { room: '<?php echo $roomname ?>' },
      function (data, status) {
        document.getElementsByClassName('anyClass')[0].innerHTML = data
        console.log(data)
      }
    )
  }
</script>

<script type="text/javascript">
  $("#submitmsg").click(function () {
    let clientmsg = $('#usermsg').val();
    $.post("postmsg.php", { text: clientmsg, room: '<?php echo $roomname ?>', ip: '<?php echo $_SERVER["REMOTE_ADDR"] ?>' },
      function (data, status) {
        document.getElementsByClassName('anyClass')[0].innerHTML = data
      })
    $("#usermsg").val("");
    return false;
  })
</script>

</html>
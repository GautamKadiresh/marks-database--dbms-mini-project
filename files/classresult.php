<?php
    include("check_login.php");
    include("config.php");
    $sem=$_SESSION["sem"];
    echo "<h1>$sem</h1>"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>class Result</title>
    <style>
    p{font-size:20px;}
    input{border-radius: 5px;width: 300px; padding-left: 10px; text-align:center;}
    th{font-size: 25px;width:150px;text-align:center;}
      td{ width:150px;font-size:20px;text-align:center;height:40px;}
      table{width:100%;margin-top:20px;margin-bottom:20px;  }
      tr:nth-child(even) {background-color: rgba(256,256,256,0.6);}
      tr:nth-child(odd) {background-color: rgba(180,180,180,0.6);}
      .a{padding-bottom:20px;}
    </style>
</head>
<body style="background-image: url('hello.jpg');background-size: cover;"><br>
    <div class="container" style="border-radius:10px;background-color:rgba(180,180,180,0.6)">
        <h1 style="text-align: center"><b>CLASS RESULT</b></h1>
        <div style="text-align: right;">
          <h3 >Hello, <?php echo strtoupper($user); ?></h1>
          <p><a href="welcome.php"><button class="btn btn-default"><b>HOME</b></button></a>  <a href="logout.php"><button class="btn btn-default"><b>LOGOUT</b></button></a></p>
          <br>
        </div>
    </div><br><br>
    <div class="row">
        <div class='col-sm-3'></div>
        <div class='col-sm-6'>
            <table>
                <tr><th>SEM</th><th>USN</th><th>NAME</th><th>AVERAGE</th></tr>
                <?php
                    
                ?>
            </table>
        </div>
        <div class='col-sm-3'></div>
    </div>
</body>
</html>
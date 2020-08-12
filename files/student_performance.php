<?php
include("check_login.php");
include("config.php");

?>

  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <title>Student Performance</title>
    <style>
    p{font-size:20px;}
    input{border-radius: 5px;width: 300px; padding-left: 10px; text-align:center;}
    </style>
    <script type="text/javascript">
    history.pushState(null, null, '<?php echo $_SERVER["REQUEST_URI"]; ?>');
    window.addEventListener('popstate', function(event) {
    window.location.assign("http://127.0.0.1/studentdb/marks.php");
    });
  </script>
  </head>
  <br>
  <body style="background-image: url('hello.jpg');background-size: cover;">
    <div class="container" style="border-radius:10px;background-color:rgba(180,180,180,0.6)">
        <h1 style="text-align: center"><b>STUDENT PERFORMANCE</b></h1>
        <div style="text-align: right;">
          <h3 >Hello, <?php echo strtoupper($user); ?></h1>
            <p><a href="welcome.php"><button class="btn btn-default"><b>HOME</b></button></a>  <a href="logout.php"><button class="btn btn-default"><b>LOGOUT</b></button></a></p>
          <br>
        </div>
    </div>
    <br>
    <div>
    <div class="" style="margin-left:550px;margin-right:550px;border-radius:10px;background-color:rgba(180,180,180,0.6);text-align: center;" ><br>
        <form action="student_performance.php" style="text-align:center;" method="post">
            <p>USN<br><input type="text" name="usn" autocomplete="off" maxlength="10" required></p><br>
            <p><button type="submit" class="btn btn-default" name='sub'>SUBMIT</button> <a href="marks.php"><button type="button" class="btn btn-primary">CANCEL</button></a> </p><br>
        </form>
    </div><br><br><html lang="en" dir="ltr">
    </div>
    <br><br>
    <?php
    if(isset($_POST["sub"])){
      $usn=strtoupper(trim($_POST["usn"]));
      $_SESSION["usn"]=$usn;
      header("location: result.php");
    }
    ?>
  </body>
</html>

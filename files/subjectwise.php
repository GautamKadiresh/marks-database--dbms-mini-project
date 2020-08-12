<?php
    include("check_login.php");
    include("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>Batch Result</title>
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
    <script type="text/javascript">
    history.pushState(null, null, '<?php echo $_SERVER["REQUEST_URI"]; ?>');
    window.addEventListener('popstate', function(event) {
    window.location.assign("http://127.0.0.1/studentdb/marks.php");
    });
  </script>
</head>
<body style="background-image: url('hello.jpg');background-size: cover;"><br>
    <div class="container" style="border-radius:10px;background-color:rgba(180,180,180,0.6)">
        <h1 style="text-align: center"><b>BATCH RESULTS</b></h1>
        <div style="text-align: right;">
          <h3 >Hello, <?php echo strtoupper($user); ?></h1>
          <p><a href="welcome.php"><button class="btn btn-default"><b>HOME</b></button></a>  <a href="logout.php"><button class="btn btn-default"><b>LOGOUT</b></button></a></p>
          <br>
        </div>
    </div><br><br>
    <div class='row'>
    <div class="col-sm-4"></div>
    <div class="col-sm-4" style="border-radius:10px;background-color:rgba(180,180,180,0.6);text-align: center;" ><br>
        <form action="semwise.php" style="text-align:center;" method="post">
            <p>BATCH CODE: <br><input type="text" name="code" autocomplete="off" maxlength="4" required></p><br>
            <p>BRANCH: <br><input type="text" name="branch" autocomplete="off" maxlength="4" required></p><br>
            <p><button type="submit" name='sub' class="btn btn-default"> SUBMIT</button> <a href="marks.php"><button type="button" class="btn btn-primary">CANCEL</button></a> </p><br>
        </form>
    </div>
    <div class="col-sm-4"></div>
    </div>
    <br>
    <div class='row'>
    <div class="col-sm-2"></div>
    <div class="col-sm-8" style="border-radius:10px;background-color:rgba(180,180,180,0.6);">
    <?php

        if(isset($_POST["sub"])){
            
            $_SESSION["bcode"]=strtoupper(trim($_POST["code"]));
            $_SESSION["branch"]=strtoupper(trim($_POST["branch"]));
            header("location: classwise.php");
        }
    ?>
    </div>
    <div class="col-sm-2"></div>
    </div>
</body>
</html>
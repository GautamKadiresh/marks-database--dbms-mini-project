<?php
include("check_login.php");
include("config.php");
$usn = $_SESSION["usn"];
$sem = $_SESSION["sem"];
if(isset($_POST["sub"])){
  $scode=strtoupper(trim($_POST["scode"]));
  $sub=mysqli_query($link,"SELECT * FROM subject WHERE subject_code= '$scode' and sem=$sem;");
  if(mysqli_num_rows($sub)>=1){
      $tid=strtoupper(trim($_POST["tid"]));
      $teach=mysqli_query($link,"SELECT * FROM teacher WHERE tid = '$tid';");
      if(mysqli_num_rows($teach)>=1){
          $marks=trim($_POST["marks"]);
          $checkmarks=mysqli_query($link,"SELECT * FROM marks WHERE usn = '$usn' and subject='$scode' and sem=$sem;");
          if(mysqli_num_rows($checkmarks)>=1){
            echo "<script>
            alert('Marks for the following student and subject has already been added!');
            window.location.href='add_usnmark.php';
            </script>";
            exit;
          }
          else{
            $row=mysqli_query($link,"SELECT branch_code,batch_code FROM student WHERE usn='$usn';");
            $res=$row->fetch_assoc();
            $branch=$res["branch_code"];
            $batch=$res["batch_code"];
            $rowid=mysqli_query($link,"SELECT max(id) FROM marks;");
            $id=0;
            if($rowid){
              $resid=$rowid->fetch_assoc();
              $id=$resid["max(id)"]+1;
            }
            else{$id=1;}
            mysqli_query($link,"INSERT INTO marks VALUES($id,'$usn','$tid','$branch',$sem,'$batch','$scode',$marks);");
            echo "<script>
            alert('1 row added !');
            window.location.href='add_usnmark.php';
            </script>";
        exit;
          }
      }
      else{
        echo "<script>
        alert('Teacher does not exist!');
        window.location.href='add_usnmark.php';
        </script>";
        exit;
      }
  }
  else{
    echo "<script>
    alert('Subject Code does not exist or Sem does not match with the subject code!');
    window.location.href='add_usnmark.php';
    </script>";
    exit;
  }
}
?>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <title>Add Marks</title>
    <style>
    p{font-size:20px;}
    input{border-radius: 5px;width: 300px; padding-left: 10px; text-align:center;}
    </style>
  </head>
  <br>
  <body style="background-image: url('hello.jpg');background-size: cover;">
    <div class="container" style="border-radius:10px;background-color:rgba(180,180,180,0.6)">
        <h1 style="text-align: center"><b>ADD MARKS</b></h1>
        <div style="text-align: right;">
          <h3 >Hello, <?php echo strtoupper($user); ?></h1>
            <p><a href="welcome.php"><button class="btn btn-default"><b>HOME</b></button></a>  <a href="logout.php"><button class="btn btn-default"><b>LOGOUT</b></button></a></p>
          <br>
        </div>
    </div><br>
    <div class="col-sm-4"></div>
    <div class="col-sm-4" style="border-radius:10px;background-color:rgba(180,180,180,0.6);text-align: center;" ><br>
        <h3>USN: <?php echo strtoupper($usn);?><br> SEMESTER: <?php echo strtoupper($sem);?></h3><br>
        <form action="add_usnmark.php" style="text-align:center;" method="post">
            <p>SUBJECT CODE: <br><input type="text" name="scode" autocomplete="off" maxlength="8" required></p><br>
            <p>TEACHER ID <br><input type="text" name="tid" autocomplete="off" maxlength="10" required></p><br>
            <p>MARKS<br> <input type="number" name="marks" autocomplete="off" min="0" max="100" required></p>
            <p><button type="submit" class="btn btn-default" name='sub'>SUBMIT</button> <a href="marks.php"><button type="button" class="btn btn-primary">CANCEL</button></a> </p><br>
        </form>
    </div><br><br>
    <br><br>
  </body>
</html>

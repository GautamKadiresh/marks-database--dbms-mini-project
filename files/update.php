<?php
    include("check_login.php");
    include("config.php");
    $id=$_SESSION["id"];
    $sql="SELECT * FROM marks WHERE id= $id;";
    $res=mysqli_query($link,$sql);
    $row=$res->fetch_assoc();
    $usn=$row["usn"];
    $tid=$row["teacher"];
    $sem=$row["sem"];
    $scode=$row["subject"];
    $mark=$row["marks"];
    $sql="SELECT branch_code,batch_code FROM student WHERE usn= '$usn';";
    $res1=mysqli_query($link,$sql);
    $row1=$res1->fetch_assoc();
    $branch=$row1["branch_code"];
    $batch=$row1["batch_code"];
    if(isset($_POST["sub"])){
      $nusn=strtoupper($_POST["nusn"]);
      $ntid=strtoupper($_POST["ntid"]);
      $nsem=$_POST["nsem"];
      $nscode=strtoupper($_POST["nscode"]);
      $nmark=$_POST["nmark"];
      $checkusn = mysqli_query($link,"SELECT * FROM student WHERE usn='$nusn';");
      $countUSN= mysqli_num_rows($checkusn);
      if($countUSN==1){//check student
        $row1=$checkusn->fetch_assoc();
        $nbranch=$row1["branch_code"];
        $nbatch=$row1["batch_code"];
        $checktid = mysqli_query($link,"SELECT * FROM teacher WHERE tid='$ntid';");
        $counttid= mysqli_num_rows($checktid);
        if($counttid==1){// check teacher
          $check_sub=mysqli_query($link,"SELECT * FROM subject WHERE subject_code='$nscode' and branch_code='$nbranch' and sem=$nsem;");
          $count_sub=mysqli_num_rows($check_sub);
          if($count_sub>=1){
            $update = "UPDATE marks SET usn='$nusn', teacher='$ntid', branch='$nbranch', sem=$nsem, batch='$nbatch', subject='$nscode', marks=$nmark WHERE id=$id;";
            $res=mysqli_query($link,$update);
            if($res){
                echo "<script>
                alert('1 row updated !');
                 window.location.href='viewdel_marks.php';
                </script>";
                exit;
            }
            else{
                echo "<script>
                alert('Row cannot be updated!');
                window.location.href='viewdel_marks.php';
                </script>";
                exit;    
            }
          }
          else{
            echo "<script>
                alert('Subject does not exist or Subject does not belong to branch or sem of the Student!');
                window.location.href='viewdel_marks.php';
                </script>";
                exit;
          }
        }
        else{
            echo "<script>
            alert('Teacher ID doesn't exist exists!');
            window.location.href='viewdel_marks.php';
            </script>";
            exit;
          }
      }
      else{
          echo "<script>
          alert('USN doesn't exists!');
          window.location.href='viewdel_marks.php';
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
    <title>Update Marks</title>
    <style>
    p{font-size:20px;}
    input{border-radius: 5px;width: 300px; padding-left: 10px; text-align:center;height:30px;font-size:20px;}
    </style>
  </head>
  <br>
  <body style="background-image: url('hello.jpg');background-size: cover;">
    <div class="container" style="border-radius:10px;background-color:rgba(180,180,180,0.6)">
        <h1 style="text-align: center"><b>UPDATE MARKS</b></h1>
        <div style="text-align: right;">
          <h3 >Hello, <?php echo strtoupper($user); ?></h1>
            <p><a href="welcome.php"><button class="btn btn-default"><b>HOME</b></button></a>  <a href="logout.php"><button class="btn btn-default"><b>LOGOUT</b></button></a></p>
          <br>
        </div>
    </div ><br>
    <div class="col-sm-4"></div>
    <div class="col-sm-4" style="border-radius:10px;background-color:rgba(180,180,180,0.6);text-align: center;"><br>
    <form action="update.php" method="POST">
        <p>USN</p><input type="text" name="nusn" value="<?php echo $usn;?>" required><br><br>
        <p>TEACHER ID</p><input type="text" name="ntid" value="<?php echo $tid;?>" required><br><br>
        <p>SEMESTER</p><input type="number" name="nsem" min="1" max="8" value="<?php echo $sem;?>" required><br><br>
        <p>SUBJECT CODE</p><input type="text" name="nscode" value="<?php echo $scode;?>" required><br><br>
        <p>MARKS</p><input type="number" name="nmark" min="0" max="100" value="<?php echo $mark;?>" required><br><br><br>
        <p><button type="submit" class="btn btn-default" name='sub'>UPDATE</button> <a href="viewdel_marks.php"><button type="button" class="btn btn-primary">CANCEL</button></a> </p><br>
    </form>    
    </div><br><br>
    <br><br>
  </body>
</html>

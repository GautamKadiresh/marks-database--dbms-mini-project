<?php
include("check_login.php");
?>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <title>Marks Analysis</title>
    <style>
    .z{border-radius:10px;background-color:rgba(180,180,180,0.6); margin-left: 30px; transition:0.4s;}
    .z:hover{
      background-color: rgb(180,180,180);
    }
    </style>
  </head>
  <br>
  <body style="background-image: url('hello.jpg');background-size: cover;">
    <div class="container" style="border-radius:10px;background-color:rgba(180,180,180,0.6)">
        <h1 style="text-align: center"><b>MARKS ANALYSIS</b></h1>
        <div style="text-align: right;">
          <h3 >Hello, <?php echo strtoupper($user); ?></h1>
            <p><a href="welcome.php"><button class="btn btn-default"><b>HOME</b></button></a>  <a href="logout.php"><button class="btn btn-default"><b>LOGOUT</b></button></a></p>
          <br>
        </div>
    </div>
    <br><br>
    <div class="row" >
        <div class="col-lg-1"></div>
        <div class="col-lg-3 z" >
          <a href="add_marks.php"><center><img src="analyseplus.png" height="150" width="150"  ></center></a>
          <h4 style="text-align:center; ">ADD MARKS</h4>
        </div>
        <div class="col-lg-3 z" >
          <a href="viewdel_marks.php"><center><img src="analysesearch.png" height="150" width="150"  ></center></a>
          <h4 style="text-align:center; ">VIEW / DELETE / UPDATE MARKS</h4>
        </div>
        <div class="col-lg-3 z" >
          <a href="student_performance.php"><center><img src="student.png" height="150" width="150"  ></center></a>
          <h4 style="text-align:center; ">STUDENT PERFORMANCE ANALYSIS</h4>
        </div>
    </div>
    <div class="row" style="margin-top:20px">
    <div class="col-lg-1"></div>
    <div class="col-lg-3 z" >
          <a href="teacher_performance.php"><center><img src="teacher.png" height="150" width="150"  ></center></a>
          <h4 style="text-align:center; ">TEACHER PERFORMANCE ANALYSIS</h4>
        </div>
    <div class="col-lg-3 z" >
        <a href="semwise.php"><center><img src="batch.png" height="150" width="150"  ></center></a>
        <h4 style="text-align:center; ">BATCH PERFORMANCE ANALYSIS</h4>
    </div>
    <div class="col-lg-3 z" >
        <a href="markswise.php"><center><img src="subjects.png" height="150" width="150"  ></center></a>
        <h4 style="text-align:center; ">SUBJECT-WISE ANALYSIS</h4>
    </div>
    </div>
    <br>
    </div>
    <br><br>

  </body>
</html>

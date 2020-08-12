<?php
    include("check_login.php");
    include("config.php");
    $usn=$_SESSION["usn"];
?>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <title>Student Performance</title>
    <style>
    p{font-size:20px;}
    input{border-radius: 5px;width: 300px; padding-left: 10px; text-align:center;}
      th{font-size: 25px;width:150px;text-align:center;}
      td{ width:150px;font-size:20px;text-align:center;}
      table{width:100%;}
      tr:nth-child(even) {background-color: rgba(256,256,256,0.6);}
      tr:nth-child(odd) {background-color: rgba(180,180,180,0.6);}
      .a{padding-bottom:20px;}
    </style>

  </head>
  <br>
  <body style="background-image: url('hello.jpg');background-size: cover;">
  <script type="text/javascript">
    history.pushState(null, null, '<?php echo $_SERVER["REQUEST_URI"]; ?>');
    window.addEventListener('popstate', function(event) {
    window.location.assign("http://127.0.0.1/studentdb/student_performance.php");
    });
  </script>
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
    <?php
     
      $sql="SELECT * FROM student WHERE usn='$usn';";
      $res=mysqli_query($link,$sql);
      $count=mysqli_num_rows($res);
      if($count>=1){
          $marks="SELECT sem,sum(marks)/count(*) as average FROM marks WHERE usn='$usn' GROUP BY sem ORDER BY sem;";
          $markres=mysqli_query($link,$marks);
          $countmarks=mysqli_num_rows($markres);
          if($countmarks>0){
              echo "<div class='row'><div class='col-sm-4' ></div>
              <div class='col-sm-4 a' style='border-radius:10px;background-color:rgba(180,180,180,0.6);text-align: center;'><br>
              <center> <h2>USN: $usn</h2><br>
              <table class='table-stripped'>
              <tr>
              <th height='20'>SEMSTER</th>
              <th height='20'>AVERAGE</th>
              <th height='20'>RESULT</th>
              </tr>";
              while($subres=$markres->fetch_assoc())
              {
                  $semester=$subres["sem"];
                  $avg=$subres["average"];
                  echo "<tr><form action='result.php' method='POST'>
                  <td>".$semester."</td>
                  <td>".$avg."</td>
                  <td><button type='submit' class='btn btn-success' style='margin-top:2px;margin-bottom:2px;' name='result' value=".$semester.">RESULT</button>
                  </form></tr>";
              }
              echo "</table></center></div><div class='col-sm-4' ></div></div><br>";
          }
          else{
              echo "<script>
          alert('No marks to display!');
          window.location.href='student_performance.php';
          </script>";
          exit;
          }
      }
      else{
          echo "<script>
      alert('Student does not exist! ');
      window.location.href='student_performance.php';
      </script>";
      exit;
      }

      if(isset($_POST["result"])){
        $sem=$_POST["result"];
        $sql="SELECT s.subject_name as sub,m.marks as marks FROM subject s, marks m WHERE m.usn='$usn' and s.subject_code=m.subject and m.sem= $sem ORDER BY s.subject_code;";
        $res=mysqli_query($link,$sql);
        echo "<div class='col-sm-3'></div><div class='col-sm-6' style='border-radius:10px;background-color:rgba(180,180,180,0.6);text-align: center;'><center>
        <h3>SEMESTER: $sem</h3>
        <table>
        <tr><th>SUBJECT</th><th>MARKS</th></tr>;";
        while($row=$res->fetch_assoc()){
          echo "<tr><td>".$row["sub"]."</td>";
          echo "<td>".$row["marks"]."</td></tr>";
        }
        echo "</table><br></div><div class='col-sm-3'></div>";
      }
    ?>
  </body>
</html>

<?php
    include("check_login.php");
    include("config.php");
    $tid=$_SESSION["tid"];
?>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <title>Teacher Performance</title>
    <style>
    p{font-size:20px;}
    input{border-radius: 5px;width: 300px; padding-left: 10px; text-align:center;}
      th{font-size: 25px;width:150px;text-align:center;}
      td{ width:150px;font-size:20px;text-align:center;height:40px;}
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
    window.location.assign("http://127.0.0.1/studentdb/teacher_performance.php");
    });
  </script>
    <div class="container" style="border-radius:10px;background-color:rgba(180,180,180,0.6)">
        <h1 style="text-align: center"><b>TEACHER PERFORMANCE</b></h1>
        <div style="text-align: right;">
          <h3 >Hello, <?php echo strtoupper($user); ?></h1>
            <p><a href="welcome.php"><button class="btn btn-default"><b>HOME</b></button></a>  <a href="logout.php"><button class="btn btn-default"><b>LOGOUT</b></button></a></p>
          <br>
        </div>
    </div>
    <br>
    <div>
    <?php
     
      $sql="SELECT * FROM teacher WHERE tid='$tid';";
      $res=mysqli_query($link,$sql);
      $count=mysqli_num_rows($res);
      if($count>=1){
          $marks="SELECT t.tid,t.fname AS tname,m.subject AS scode,s.subject_name AS sname,avg(m.marks) AS average FROM teacher t,marks m,subject s WHERE t.tid=m.teacher AND tid='$tid' AND s.subject_code=m.subject GROUP BY m.subject ;";
          $markres=mysqli_query($link,$marks);
          $countmarks=mysqli_num_rows($markres);
          if($countmarks>0){
              echo "<div class='row'><div class='col-sm-1' ></div>
              <div class='col-sm-10 a' style='border-radius:10px;background-color:rgba(180,180,180,0.6);text-align: center;'><br>
              <center><table class='table-stripped'>
              <tr>
              <th height='20'>TEACHER ID</th>
              <th height='20'>NAME</th>
              <th height='20'>SUBJECT CODE</th>
              <th height='20'>SUBJECT</th>
              <th height='20'>AVERAGE</th>
              </tr>";
              while($subres=$markres->fetch_assoc())
              {
                  $tname=$subres["tname"];
                  $avg=$subres["average"];
                  $sname=$subres["sname"];
                  $scode=$subres["scode"];
                  echo "<tr><form action='result.php' method='POST'>
                  <td>".$tid."</td>
                  <td>".$tname."</td>
                  <td>".$scode."</td>
                  <td>".$sname."</td>
                  <td>".$avg."</td>
                  </form></tr>";
              }
              echo "</table></center></div><div class='col-sm-1' ></div></div><br>";
          }
          else{
              echo "<script>
          alert('No marks to display!');
          window.location.href='teacher_performance.php';
          </script>";
          exit;
          }
      }
      else{
          echo "<script>
      alert('Teacher does not exist! ');
      window.location.href='teacher_performance.php';
      </script>";
      exit;
      }
    ?>
  </body>
</html>
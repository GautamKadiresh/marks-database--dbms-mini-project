<?php
include("check_login.php");
include("config.php");
?>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <title>Marks Analysis</title>
    <style media="screen">
      th{font-size: 25px;width:150px;padding-left:10px;}
      td{ width:150px;font-size:20px;padding-left:10px;}
      table{width:95%;}
      tr:nth-child(even) {background-color: rgba(256,256,256,0.6);}
      tr:nth-child(odd) {background-color: rgba(180,180,180,0.6);}
      .a{padding-bottom:20px;}
    </style>
    <script type="text/javascript">
    history.pushState(null, null, '<?php echo $_SERVER["REQUEST_URI"]; ?>');
    window.addEventListener('popstate', function(event) {
    window.location.assign("http://127.0.0.1/studentdb/semwise.php");
    });
  </script>
  </head>
  <br>
  <body style="background-image: url('hello.jpg');background-size: cover;">
    <div class="container" style="border-radius:10px;background-color:rgba(180,180,180,0.6)">
        <h1 style="text-align: center"><b>CLASS-WISE RESULTS</b></h1>
        <div style="text-align: right;">
          <h3 >Hello, <?php echo strtoupper($user); ?></h1>
            <p><a href="welcome.php"><button class="btn btn-default"><b>HOME</b></button></a>  <a href="logout.php"><button class="btn btn-default"><b>LOGOUT</b></button></a></p>
          <br>
        </div>
    </div>
    <br><br>
    <?php
      $bcode=$_SESSION["bcode"];
      $branch=$_SESSION["branch"];
      $checkbatch = mysqli_query($link,"SELECT * FROM batch WHERE batch_code ='$bcode'");
      $countBatch= mysqli_num_rows($checkbatch);
      if($countBatch==1){
          $checkbranch = mysqli_query($link,"SELECT * FROM branch WHERE branch_code ='$branch'");
          $countBranch= mysqli_num_rows($checkbranch);
          if($countBranch==1){
              $sql="select m.sem as sem,m.branch as branch,m.batch as batch,avg(m.marks) as average from marks m where m.batch='$bcode' and m.branch='$branch' group by m.sem; ";
              $res=mysqli_query($link,$sql);
              $count=mysqli_num_rows($res);
              if($count>0){
                  echo "<div class='col-sm-3'></div><div class='col-sm-6'><table><tr><th>SEM</th><th>BRANCH</th><th>BATCH</th><th>AVERAGE</th><th>RESULT</th></tr>";
                  while($row=$res->fetch_assoc()){
                      $batch=$row["batch"];
                      $branch=$row["branch"];
                      $avg=$row["average"];
                      $sem=$row["sem"];
                      $but="$batch $branch $sem";
                      echo "<tr><form action='classwise.php' method='POST'><td>".$sem."</td><td>".$branch."</td><td>".$batch."</td><td>".$avg."</td><td><button type='submit' name='classres' value='$but' class='btn btn-success'>RESULT</button></td></form></tr>";
                  }
                  echo "</div></table>";
              }
              else{
                  echo "<script>
                  alert('No marks to display!');
                  window.location.href='semwise.php';
                  </script>";
              }
          }
          else{
              echo "<script>
              alert('Branch does not exists!');
              window.location.href='semwise.php';
              </script>";
          exit;
          }
          
      }
      else{
          echo "<script>
          alert('Batch does not exists!');
          window.location.href='semwise.php';
          </script>";
          exit;
      }
      echo "<br><br>";
      if(isset($_POST["classres"])){
        $val=$_POST["classres"];
            $_SESSION["batch"]= strtok($val, " ");
            $_SESSION["branch"]=strtok(" ");
            $_SESSION["sem"]=strtok(" ");
        $branch=$_SESSION["branch"];
        $batch=$_SESSION["batch"];
        $sem=$_SESSION["sem"];
        $sql="SELECT s.usn as usn,s.fname as name,avg(m.marks) as average FROM student s,marks m WHERE s.usn=m.usn and m.sem=$sem GROUP BY s.usn,m.sem ORDER BY avg(m.marks) desc";
        $res=mysqli_query($link,$sql);
        $count=mysqli_num_rows($res);
        if($count>0){
          echo "<div><table><tr><th>USN</th><th>NAME</th><th>AVERAGE</th></tr>";
          while($row=$res->fetch_assoc()){
            $usn=$row["usn"];
            $name=$row["name"];
            $avg=$row["average"];
            echo "<tr><td>$usn</td><td>$name</td><td>$avg</td></tr>";
          }
      }
      else{
        echo "<h1 style='border-radius:10px;background-color:rgba(180,180,180,0.6)'>NO ROWS TO DISPLAY!</h1>";
      }
      }
    ?>
    <br><br>

  </body>
</html>

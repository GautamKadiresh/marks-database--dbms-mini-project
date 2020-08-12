<?php
    include("check_login.php");
    include("config.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $bname=strtoupper(trim($_POST["name"]));
        $bcode=strtoupper(trim($_POST["code"]));
        $checkBranch = mysqli_query($link,"SELECT * FROM branch WHERE branch_code ='$bcode'");
        $countBranch= mysqli_num_rows($checkBranch);
        if($countBranch==0){
            $checkBranch = mysqli_query($link,"INSERT INTO branch VALUES('$bcode','$bname');");
            echo "<script>
            alert('Branch has been added successfully!');
            window.location.href='branch.php';
            </script>";
          }
          else{
            echo "<script>
            alert('Branch already exists!');
            window.location.href='add_branch.php';
            </script>";
            exit;
          }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>Add Branch</title>
    <style>
    p{font-size:20px;}
    input{border-radius: 5px;width: 300px; padding-left: 10px; text-align:center;}
    </style>
</head>
<body style="background-image: url('hello.jpg');background-size: cover;"><br>
    <div class="container" style="border-radius:10px;background-color:rgba(180,180,180,0.6)">
        <h1 style="text-align: center"><b>ADD BRANCH</b></h1>
        <div style="text-align: right;">
          <h3 >Hello, <?php echo strtoupper($user); ?></h1>
          <p><a href="welcome.php"><button class="btn btn-default"><b>HOME</b></button></a>  <a href="logout.php"><button class="btn btn-default"><b>LOGOUT</b></button></a></p>
          <br>
        </div>
    </div><br><br>
    <div class="col-sm-4"></div>
    <div class="col-sm-4" style="border-radius:10px;background-color:rgba(180,180,180,0.6);text-align: center;" ><br>
        <form action="add_branch.php" style="text-align:center;" method="post">
            <p>BRANCH CODE: <br><input type="text" name="code" autocomplete="off" maxlength="3" required></p><br>
            <p>BRANCH NAME: <br> <input type="text" name="name" autocomplete="off" maxlength="30" required></p><br>
            <p><button type="submit" class="btn btn-default"> SUBMIT</button> <a href="batch.php"><button type="button" class="btn btn-primary">CANCEL</button></a> </p><br>
        </form>
    </div>
</body>
</html>
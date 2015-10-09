<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/home.css" rel="stylesheet">

</head>

<body>

    
    <div class="wrap">

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php">Home</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        
                        <a href="myprofile.php"> 
                        <?php  

     $Conn = mysql_connect('localhost', 'root', "") or die(mysql_error());
        mysql_select_db('myDB');
session_start();
    
                        $username = $_SESSION["username"];
                        $query = "Select * from Users where username = '$username';";
                        $res = mysql_query($query) or die(mysql_error());
                        $row = mysql_fetch_assoc($res);
                        $fname = $row['fname'];
                        $lname = $row['lname'];
                        $_SESSION['fname']=$fname;
                        $_SESSION['lname']=$lname;
                        echo $fname; ?> &nbsp; <?php echo $lname;
                            ?>
                        </a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


<a class="purchase"> Purchase Successful! </a>
<form action = "home.php" >
<input type="submit" class ="button23" name="submit" value="Go to Homepage"/>
</form>

<?php

$username = $_SESSION['username'];
        $query = "Select * from Cart where username = '$username' ;";
        $res = mysql_query($query) or die(mysql_error());
        while($row = mysql_fetch_assoc($res)){
          $pname = $row['pname'];
            $price = $row['price'];
          $query2 = "Insert into History (username, pname, price) values ('$username', '$pname', '$price'); ";
          $res2 = mysql_query($query2) or die(mysql_error());
          }

          $query3 = "Delete from Cart where username = '$username' ;" ;
          $res3 = mysql_query($query3) or die(mysql_error());

          mysql_close();



        


?>



    <div class="container">

        <hr>

        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; A.Rahman ElZamzamy & A.Rahman Kamel</p>
                </div>
            </div>
        </footer>

    </div>

    <script src="js/jquery.js"></script>

    <script src="js/bootstrap.min.js"></script>

</div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Index</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/shop-homepage.css" rel="stylesheet">

</head>

<body>
<?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "myDB";
        $port = "3306";
  $usernameErr = $passwordErr= $general= "";
$username = $password = "";
$Conn = mysql_connect('localhost', 'root', "") or die(mysql_error());
        mysql_select_db('myDB');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
     $Conn = mysql_connect('localhost', 'root', "") or die(mysql_error());
        mysql_select_db('myDB');
    
            $username = $_POST['username'];
            $password = $_POST['password'];
   $username = $_POST['username'];
    $pass = $_POST['password'];
            if(empty($_POST['username'])){
            $usernameErr = "Please Enter your username.";
            } else
            if(empty($_POST['password'])){
            $passwordErr = "Please enter your password.";
            } else {
                $query = "Select username from Users
                    where username = '$username' AND
                    password = '$password'
                    ";
                $res = mysql_query($query) or die(mysql_error());
                $numRows = mysql_num_rows($res);
                if($numRows>0){
                    session_start();
                    $_SESSION['username']=$username;
                    header("location: home.php");
                    die();
               }
                else {
                $general = "Username and/or password is incorrect.";
                }

            
            }

        }

    ?>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="signup.php">SignUp</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
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

    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <div class="logophoto" >
                <img src="http://blog.tmimgcdn.com/wp-content/uploads/2015/02/eShop.jpg?1c2514" alt="eShop" style="width:304px; height:228px; ">
                    </div>
                <div class = "loginss" >
                <!-- <button type="button">Login</button> -->
                <!-- <button type="button">Login</button> -->
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="list-group">
                    Username: <input type="text" style="color:black" name="username" value="<?php echo $username;?>"><br>
                    <span class="error"><?php echo $usernameErr;?></span>
                    <br />
                    Password: <input type="password" style="color:black" name="password" value="<?php echo $password;?>"><br>
<span class="error"><?php echo $passwordErr;?></span>
                    <span class="error"><?php echo $general;?></span>
                </div>
                
                <input type="submit" class ="loginbutton" name="submit" value="Login"/>
                </form>
            </div>
            </div>

            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="image1.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="image3.png" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="image2.jpg" alt="">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>

                </div>

                <?php
                    $query = "SELECT stock FROM Products WHERE pid = 1";
                    $res = mysql_query($query)or die(mysql_error());
                    $staff = mysql_fetch_assoc($res);
                    $result = $staff['stock'];
                    ?>

                <div class="row">                    
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="mac.jpg" alt="macpro 13" style="width:320px;height:150px;">
                            <div class="caption">
                                <h4 class="pull-right">$499.99</h4>
                                <?php if($result > 0){ ?>
                                    <a href="signup.php?name1=macbook 13 inch laptop&price=500" class="buybutton"> Buy</a>
                                    
                                <?php } else { ?>
                                    <a href="" class="buybutton">Out of stock</a>
                                <?php } ?>
                                <!-- <a href="confirm.php" class="buybutton">Buy</a> -->
                                </h4>
                                <p>macbook 13 inch laptop.</p></br>

                            </div>
                            <div class="ratings">
                               <?php
                                $Stock = $result." in stock";
                                echo"$Stock";
                                ?>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                    $query = "SELECT stock FROM Products WHERE pid = 2";
                    $res = mysql_query($query)or die(mysql_error());
                    $staff = mysql_fetch_assoc($res);
                    $result = $staff['stock'];
                    ?>


                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="canon.jpg" alt="canon pro cam" style="width:320px;height:150px;">
                            <div class="caption">
                                <h4 class="pull-right">$299.99</h4>
                                <?php if($result > 0){ ?>
                                    <a href="signup.php?name1=Canon professional camera&price=300" class="buybutton">Buy</a>

                                <?php } else { ?>
                                    <a href="" class="buybutton">Out of stock</a>
                                <?php } ?>
                                </h4>
                                <p>Canon professional camera.</p>
                            </div>
                            <div class="ratings">
                                <?php
                                $Stock = $result." in stock";
                                echo"$Stock";
                                ?>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                    $query = "SELECT stock FROM Products WHERE pid = 3";
                    $res = mysql_query($query)or die(mysql_error());
                    $staff = mysql_fetch_assoc($res);
                    $result = $staff['stock'];
                    ?>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="guess.jpg" alt="guess purse" style="width:320px;height:150px;">
                            <div class="caption">
                                <h4 class="pull-right">$74.99</h4>
                                <?php if($result > 0){ ?>
                                    <a href="signup.php?name1=Guess women genuine leather purse&price=75" class="buybutton">Buy</a>
                                <?php } else { ?>
                                    <a href="" class="buybutton">Out of stock</a>
                        
                                <?php } ?>
                                </h4>
                                <p>Guess women genuine leather purse.</p>
                            </div>
                            <div class="ratings">
                                <?php
                                $Stock = $result." in stock";
                                echo"$Stock";
                                ?>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                    $query = "SELECT stock FROM Products WHERE pid = 4";
                    $res = mysql_query($query)or die(mysql_error());
                    $staff = mysql_fetch_assoc($res);
                    $result = $staff['stock'];
                    ?>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="ralph.jpg" alt="Ralph Lauren shirt" style="width:320px;height:150px;">
                            <div class="caption">
                                <h4 class="pull-right">$49.99</h4>
                                <?php if($result > 0){ ?>
                                    <a href="signup.php?name1=Ralph Lauren polo shirt&price=50" class="buybutton">Buy</a>
                                    
                                <?php } else { ?>
                                    <a href="" class="buybutton">Out of stock</a>
                                <?php } ?>
                                </h4>
                                <p>Ralph Lauren polo shirt.</p>
                            </div>
                            <div class="ratings">
                                <?php
                                $Stock = $result." in stock";
                                echo"$Stock";
                                ?>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                    $query = "SELECT stock FROM Products WHERE pid = 5";
                    $res = mysql_query($query)or die(mysql_error());
                    $staff = mysql_fetch_assoc($res);
                    $result = $staff['stock'];
                    ?>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="fred.jpg" alt="Fred Perry shoes" style="width:320px;height:150px;">
                            <div class="caption">
                                <h4 class="pull-right">$94.99</h4>
                                <?php if($result > 0){ ?>
                                    <a href="signup.php?name1=Fred Perry men shoes&price=95" class="buybutton">Buy</a>
                                    
                                <?php } else { ?>
                                    <a href="" class="buybutton">Out of stock</a>
                                <?php } ?>
                                </h4>
                                <p>Fred Perry men shoes.</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">18 in stock</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                
                    </div>

                </div>

            </div>

        </div>

    </div>

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

</body>

</html>

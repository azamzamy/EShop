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
<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<meta charset=utf-8 />
<title>JS Bin</title>
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style>
  article, aside, figure, footer, header, hgroup, 
  menu, nav, section { display: block; }
</style>
</head>

<body>
    
          <?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        
        $uploadOk = 1;
    } else {
        
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
      $Conn = mysql_connect('localhost', 'root', "") or die(mysql_error());
mysql_select_db('myDB');
        
        $up =  basename( $_FILES["fileToUpload"]["name"]);
        echo $up;
        $username = $_SESSION['username'];
        $query = "Update users set avatar = '$up' where username = 
    '$username' ; ";
        $result = mysql_query($query) or die(mysql_error());
        
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
}
?>
          
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

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row carousel-holder">
                    <div class="col-md-12">
                    
                        <?php

$id=$_SESSION['username'];
$result3 = mysql_query("SELECT * FROM Users where username='$username'");
while($row3 = mysql_fetch_array($result3))
{ 
$fname=$row3['fname'];
$lname=$row3['lname'];
$username=$row3['username'];
$email=$row3['email'];
$picture=$row3['avatar'];
$gender=$row3['gender'];
}
?>
                        <div class = "uploader">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
    <input type="file" onchange="readURL(this);" name="fileToUpload" id="fileToUpload">
     <input type="submit" class = "button22" value="Upload Image" name="submit">
</form>
                            <div class="history" >
                            <form action="history.php">
         <input type="submit" class = "button22" value="View History" name="submit" >
</form>
                                </div>
          </div>
                        
     <script>                   function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
         </script>
                        
                        
                        
<table width="398" border="0" align="center" cellpadding="0">
  <tr>
    <td height="26" colspan="2">Your Profile Information </td>
	<td><div  align="right" ><a href="index.php">Logout</a></div></td>
  </tr>
  <tr>
    <td width="300" rowspan="20">
        <img src="<?php echo $picture ?>" width="129" height="129" alt="no image found"/>

      </td>
      
    <td width="82" valign="top"><div align="left">FirstName:</div></td>
    <td width="165" valign="top"><?php echo $fname ?></td>
  </tr>
  <tr>
    <td valign="top"><div align="left">LastName:</div></td>
    <td valign="top"><?php echo $lname ?></td>
  </tr>
  <tr>
    <td valign="top"><div align="left">Gender:</div></td>
    <td valign="top"><?php echo $gender ?></td>
  </tr>
  <tr>
    <td valign="top"><div align="left">Username:</div></td>
    <td valign="top"><?php echo $username ?></td>
  </tr>
  <tr>
    <td valign="top"><div align="left">Email: </div></td>
    <td valign="top"><?php echo $email ?></td>
  </tr>
</table>
<p align="center"><a href="index.php"></a></p>
                        
                    </div>
                </div>
            </div>
        </div>
        
        
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <div class="foobar">
                    <p>Copyright &copy; A.Rahman ElZamzamy & A.Rahman Kamel 2015</p>
                </div>
                </div>
            </div>
        </footer>
</div>
    

    <script src="js/jquery.js"></script>

    <script src="js/bootstrap.min.js"></script>

</div>
</body>

</html>

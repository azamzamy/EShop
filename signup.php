<html>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/shop-homepage.css" rel="stylesheet">

<body>
    <?php
    
     $Conn = mysql_connect('localhost', 'root', "") or die(mysql_error());
        mysql_select_db('myDB');
    
    $fname = $lname = $username = $gender = $pass = $repass = $email = ""; 
    $fnameErr = $lnameErr = $usernameErr = $genderErr = $passErr = $repassErr = $emailErr =   "";
 
    function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    if(empty($_POST["fname"])) {
  $fnameErr = "First Name is required.";
  } else {
  $fname = test_input($_POST["fname"]);
      if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
  $fnameErr = "Only letters and white space allowed"; 
      }
  }
    
    if(empty($_POST["lname"])) {
  $lnameErr = "Last Name is required.";
  } else {
    $lname = test_input($_POST["lname"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
  $lnameErr = "Only letters and white space allowed"; 
      }
    }

  if(empty($_POST["username"])) {
  $usernameErr = "Username is required.";
  } else {
    $username = test_input($_POST["username"]);
         if (!ctype_alnum($username)) {
  $usernameErr = "Only letters and numbers are allowed"; 
         }

      $result = mysql_query("SELECT username FROM Users WHERE username = '$username'") or die(mysql_error());
      if(mysql_num_rows($result) != 0) {
     $usernameErr = "Username already exists, please choose another username.";
}
    }
  
    if(empty($_POST["gender"])) {
  $gender = "Please select gender.";
  }
  
    if(empty($_POST["pass"])) {
  $passErr = "Please enter your password.";
  } else {
    $pass = test_input($_POST["pass"]);
            if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $pass)) {
    $passErr = "the password does not meet the requirements!";
            }
    }
  
    if(empty($_POST["repass"])) {
  $pass = "Password confirmation is required.";
  } else {
    $repass = test_input($_POST["repass"]);
        if($pass != $repass){
        $repassErr = "Passwords do not match!";
        }
            
    }
    
    if(empty($_POST["email"])) {
  $emailErr = "Email is required.";
  } else {
    $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $emailErr = "Invalid email format!"; 
}
    }
  
    
    if($fnameErr == "" && $lnameErr == "" && 
       $usernameErr == "" && $genderErr == "" &&
       $passErr == "" && $repassErr == "" &&
       $emailErr == ""){
    $query = mysql_query("INSERT INTO Users(username, fname, lname, password, email, gender)
    VALUES
    (
    '$username', '$fname', '$lname', '$pass', '$email', '$gender'
    );
    ") or die(mysql_error());
            session_start();
        $_SESSION['username'] = $username;
         
         header('Location: index.php');
        die();
         
             
    }
}


    ?>
    
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <p style="color:yellow"> * Required Field. </p>
        <br />
        First name: <input type="text" style="color:black" id="fname" name="fname" value="<?php echo $fname;?>" />
        <span class="error">*<?php echo $fnameErr;?></span>
        <br> <br />
    Last name: <input type="text" style="color:black" id="lname" name="lname" value="<?php echo $lname;?>" />
        <span class="error">*<?php echo $lnameErr;?></span>
        <br><br />
    Username: <input type="text" style="color:black" name="username" id="username" value="<?php echo $username;?>" />   
        <span class="error">*<?php echo $usernameErr;?></span>
<br />
    Remember your username as you will be signing in with it.
    <br /> <br />
        Gender: <br />
    <input type="radio" id = "gender" name="gender" 
           /> Male<br />
    <input type="radio" id = "gender" name="gender" 
           /> Female
        
        
        <br><br />
    Password: <input type="password" id="pass" name="pass" value="<?php echo $pass;?>" style="color:black"/>
        <span class="error">*<?php echo $passErr;?></span>
        <br> <br />
    Confirm Password: <input type="password" name="repass" style="color:black" id="repass" value="<?php echo $repass;?>" >
        <span class="error">*<?php echo $repassErr;?></span>
        <br> <br />
    Email: <input type="text" style="color:black" id="email" name="email" value="<?php echo $email;?>" />
        <span class="error">*<?php echo $emailErr;?></span>
    <br><br />
        <input type="submit" style="color:black" name="submit" value="Submit"> 
    </form>
        </body>
</html>
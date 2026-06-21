<?php
include('connection/connect.php');
?>
<script>
function validateEmail() {
  email = document.getElementById('email').value;
  if (email.includes("@") && email.includes(".")) {
    return true;
  } else {
    alert("Please enter a valid email with a domain like .com");
    return false;
  }
}
</script>
<?php

if (isset($_POST['submit'])) {
    $uname = $_POST['username'];
    $pwd = md5($_POST['password']);
    $email = $_POST['email'];

    // Query to check the credentials
    $select = "SELECT pwd FROM users WHERE username = '$uname' and email= '$email'";
    $res = mysqli_query($con, $select);
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // Assuming password verification is successful
        $row = mysqli_fetch_assoc($res);

        if ($pwd == $row['pwd']) {  // Password match check using MD5
            $_SESSION['login'] = "Login Success";
            $_SESSION['user'] = $uname;
            header("Location: " . SITEURL . 'index.php'); // Redirect to the home page
            exit(); // Stop further script execution
        }  
         else {
            $_SESSION['login'] = "Password did not match";
            header("Location: " . SITEURL . 'login.php'); // Redirect back to login page
            exit();
        }
    } else {
        $_SESSION['login'] = "failed to login.";
        header("Location: " . SITEURL . 'login.php'); // Redirect back to login page
        exit();
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
              body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            min-height:100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .container {
            height: 50%;
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .container h2 {
            text-align: center;
            margin-bottom: 20px;

        }
        form{
            display: flex;
            flex-direction: column;
        }
        
        .container input[type="text"],
        .container input[type="password"],
         .container input[type="email"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        
        .container input[type="submit"] {
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        
        .container input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
       <?php
        if (isset($_SESSION['register'])) {
            echo $_SESSION['register'];
            unset($_SESSION['register']);
        }
       if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if (isset($_SESSION['nologin'])) {
            echo $_SESSION['nologin'];
            unset($_SESSION['nologin']);
        }
        ?>

        <form action="login.php" method="post" onsubmit = "return validateEmail()" >
            <input type="email" name="email" id="email" placeholder="Email" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" pattern=".{8,}" 
                     title="Password must be at least 8 characters long" required>
            <input type="submit" name="submit" value="Login">
           <p> Don't have an account?<a href="register.php">Register</a></p>
        </form>
    </div>
</body>
</html>
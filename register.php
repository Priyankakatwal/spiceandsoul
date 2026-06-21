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
            height: 60%;
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
        .container input[type="email"],
        .container input[type="password"] {
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
        <h2>Register</h2>
       <?php if(isset($_SESSION['register'])){
    echo $_SESSION['register'];
    unset($_SESSION['register']);
}
?>
        <form action="" method="post"  onsubmit = "return validateEmail()">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" pattern=".{8,}" 
                     title="Password must be at least 8 characters long" name="password" placeholder="Password" required>
            <input type="password" pattern=".{8,}" 
            title="Password must be at least 8 characters long" name="confirmpassword" placeholder="Confirm Password" required>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="submit" name="submit" value="Register">
            <p>Already have an account?<a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>
<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirmpassword']);
    $email =($_POST['email']);

    // Check if the passwords match
    if ($password === $confirm_password) {
        
        $insert = "INSERT INTO users(username, pwd, email) VALUES('$username', '$password', '$email')";
        $res= mysqli_query($con,$insert) or die("Insertion error");

        if ($res) {
            $_SESSION['register'] = "Registered Successfully.";
            header("location: " . SITEURL . 'login.php');
        } else {
            $_SESSION['register'] = "Failed to register.";
            header("location: " . SITEURL . 'register.php');
        }
    } else {
        $_SESSION['register'] = "Passwords do not match.";
        header("location: " . SITEURL . 'register.php');
    }
}
?>
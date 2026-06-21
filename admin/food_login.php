<?php
include('../connection/connect.php');
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
<html>
    <head>
        <title>food login</title>
    <style>
        .login{
   width: 30%;
    min-width: 300px;
    background: #fff;
    border: none;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    margin: 10% auto;
    padding: 30px 25px;
    box-sizing: border-box;
}
.loginbody{
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f2f4f8;
    margin: 0;
    padding: 0;
}
.login h1 {
    margin-bottom: 25px;
    color: #333;
    font-size: 24px;
    text-align: center;
}
.labelstyle {
    font-weight: 600;
    color: #444;
    display: block;
    margin-bottom: 6px;
    text-align: left;
}
.inputstyle{
     width: 100%;
    padding: 10px 2px;
    margin-bottom: 0px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.inputstyle:focus{
      border-color: #007BFF;
    outline: none;
}
.loginbtn{
     width: 100%;
    padding: 12px;
    background-color: #007BFF;
    color: white;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
.loginbtn:hover{
    background-color: #0056b3;
}
    </style>
    </head>
    <body class="loginbody">
        <div class="login">
            <h1>Login</h1>
            <?php
             if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                        if(isset($_SESSION['nologin']))
                {
                    echo $_SESSION['nologin'];
                    unset($_SESSION['nologin']);
                }
            ?>
        <form method="POST" onsubmit="return validateEmail()">
        <label class="labelstyle">Username:</label>
        <input class="inputstyle" type="text" name="username" required><br><br>
        <label class="labelstyle">Email:</label>
        <input class="inputstyle" id= "email" type="email" name="email" required><br><br>
        <label class="labelstyle">Password:</label>
        <input class="inputstyle" type="password" name="pwd"  pattern=".{8,}" 
                     title="Password must be at least 8 characters long" required><br><br>
        <button class="loginbtn" name="login" type="submit">Login</button>
    </form>
        </div>
    </body>
</html>
<?php 
if(isset($_POST['login'])){
    $uname=$_POST['username'];
    $pwd=md5($_POST['pwd']);
    $email= $_POST['email'];
    $select="select * from admin_tbl where username='$uname' and password='$pwd' and email= '$email'";
    $res= mysqli_query($con,$select) or die("selection error");
    $count=mysqli_num_rows($res);
    if($count==1){
        $_SESSION['login']="Login Successful";
        $_SESSION['user']=$uname;
        header('location:'.SITEURL.'admin/admin_page.php');
    }
    else{
        $_SESSION['login']="Usename or password or email did not match.";
        header('location:'.SITEURL.'admin/food_login.php');
    }
}
?>
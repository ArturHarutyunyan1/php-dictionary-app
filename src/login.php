<?php
session_start();
error_reporting(0);
class Login
{
    public $host     = 'localhost';
    public $user     = 'root';
    public $password = '';
    public $db       = 'registration';
    public $conn;

    public function __construct()
    {
        $this -> conn = mysqli_connect($this -> host, $this -> user, $this -> password, $this -> db);

        if($this -> conn -> connect_error){
            die("Connection failed");
            exit();
        }
    }
    public function __destruct()
    {
        mysqli_close($this -> conn);
    }

    public function login(){
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($this -> conn, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($this -> conn, $password);

        $sql    = "SELECT * FROM `users` WHERE email='$email' AND password='$password'";

        $result = mysqli_query($this -> conn, $sql);

        $rows   = mysqli_num_rows($result);

        if($rows == 0){
            echo "<p class='error'>Email or password is incorrect. Please try again</p>";
        }

        $verification_check = mysqli_fetch_object($result);

        if($verification_check -> verificated_at == null){
            if($rows != 0){
                header("Location: verification.php?email=" . $email);
            }
        }else{
            $_SESSION['email'] = $email;
            header("Location: ../index.php");
        }

    }
}

$login = new Login();

if(isset($_POST['email'])){
    $login -> login($_POST['email']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form class="input-form" method="post">
        <div class="header">
            <h1>Sign In</h1>
            <p>Don't have an account? <a href="reg.php">Sign Up</a></p>
        </div>
        <div class="col">
            <input type="email" name="email" placeholder="Email Address">
        </div>
        <div class="col">
            <input type="password" name="password" placeholder="Password">
        </div>
        <div class="col">
            <button name="login">Sign In</button>
        </div>
    </form>
</body>
</html>
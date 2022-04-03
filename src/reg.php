<?php
error_reporting(0);
class Reg
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

    public function registration()
    {
        $name     = stripslashes($_REQUEST['name']);
        $name     = mysqli_real_escape_string($this -> conn, $name);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($this -> conn, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($this -> conn, $password);


        $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

        $mailTo  = $email;
        $subject = "Email verification code";
        $body    = "Your verification code \n $verification_code";

        $email_check = "SELECT * FROM `users` WHERE email LIKE ?";

        $stmt  = $this -> conn -> prepare($email_check);
        $stmt -> execute([$email]);

        $check = $stmt -> fetch();

        if($check){
            echo "<p class='error'>This email address is already in use!</p>";
        }else{
            $sql = "INSERT INTO `users` (`name`, `email`, `password`, `verification_code`, `verificated_at`) VALUES ('$name', '$email', '$password', '$verification_code', NULL)";
            $result = mysqli_query($this -> conn, $sql);
            
            if($result){
                mail($mailTo, $subject, $body);
                header("Location: verification.php?email=" . $email);

                if(!mail($mailTo, $subject, $body)){
                    echo "<p class='error'>Something went wrong. Please try again</p>";
                }
            }else{
                echo "<p class='error'>Something went wrong. Please try again</p>";
            }
        }
    }
}

$reg = new Reg();

if(isset($_REQUEST['name'])){
    $reg -> registration($_REQUEST['name']);
}

echo $getErr;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form class="input-form">
        <div class="header">
            <h1>Sign up with your email</h1>
            <p>Already have an account? <a href="login.php">Sign in</a></p>
        </div>
        <div class="col">
            <input type="text" name="name" placeholder="Full Name" required>
        </div>
        <div class="col">
            <input type="email" name="email" placeholder="Email Address" required>
        </div>
        <div class="col">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="col">
            <button name="create">Create Account</button>
        </div>
    </form>
</body>
</html>
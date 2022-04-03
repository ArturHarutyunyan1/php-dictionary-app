<?php
error_reporting(0);
class Verification
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

    public function verify()
    {
        $email             = $_POST['email'];
        $verification_code = $_POST['verification_code'];

        $sql = "UPDATE `users` SET verificated_at= NOW() WHERE email='$email' AND verification_code='$verification_code'";

        mysqli_query($this -> conn, $sql);

        if(mysqli_affected_rows($this -> conn) == 0){
            echo"<p class='error'>Invalid verification code</p>";
        }else{
            header("Location: login.php");
        }
    }
}

$verify    = new Verification();
if(isset($_POST['verify'])){
    $verify -> verify($_POST['verify']);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form class="input-form" method="post">
        <div class="header">
            <h1>Verify your email</h1>
            <p>Verification code sent to <span><?php echo $_GET['email'] ?></span></p>
        </div>
        <div class="col">
            <input type="hidden" value="<?php echo $_GET['email'] ?>" name="email">
            <input type="text" name="verification_code" placeholder="Verification Code">
        </div>
        <div class="col">
            <button name="verify">Verify</button>
        </div>
    </form>
</body>
</html>
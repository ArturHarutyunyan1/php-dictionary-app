<?php
error_reporting(0);
class App
{
    public $host     = 'localhost';
    public $username = 'root';
    public $password = '';
    public $db       = 'dict';
    public $conn;
    public $msg;
    public function __construct()
    {
        $this -> conn = mysqli_connect($this -> host, $this -> username, $this -> password, $this -> db);

        if($this -> conn -> connect_error){
            die("Connection Failed");
            exit();
        }
    }

    public function __destruct()
    {
        mysqli_close($this -> conn);
    }

     function search(){
       $searchValue = mysqli_real_escape_string($this -> conn, trim(htmlentities($_POST['search-value'])));
       $searchValue = "%$searchValue%";

       $sql = "SELECT * FROM `oedict` WHERE word LIKE ? LIMIT 30";

       $stmt = $this -> conn -> prepare($sql);
       $stmt -> bind_param('s', $searchValue);
       $stmt -> execute();

       $result = $stmt -> get_result();
       if($result -> num_rows === 0){
           header("Location: 404.html");
           exit();
       }

       return $result;
    }
}

$app = new App();

if(isset($_POST['search'])){
    $app -> search($_POST['search']);
}

$searchData = new App();
$result = $searchData -> search();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>English Dictionary</title>
    <link rel="stylesheet" href="./src/assets/css/style.css">
    <link rel="shortcut icon" href="./src/assets/img/dictionary.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="header">
        <form class="search-form" method="post">
            <div class="input-line">
                <input type="text" name="search-value" class="search-value" placeholder="Type something">
                <button name="search">
                    <i class="fa fa-search"></i>
                </button>
            </div>
            <p class="error-message">You must fill in the input field</p>
        </form>
    </div>
    <div class="container">
        <?php while($value = $result -> fetch_assoc()) {?>
            <div class="col">
                <h1><?php echo $value['word'] ?></h1>
                <p><?php  echo $value['meaning'] ?></p>
            </div>
        <?php }?>
    </div>
    <script src="./src/assets/js/script.js"></script>
</body>
</html>
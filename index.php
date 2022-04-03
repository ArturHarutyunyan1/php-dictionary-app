<?php

include('./src/auth.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./src/style.css">
</head>
<body>
    <h1>Welcome <?php echo $_SESSION['email'] ?>!</h1>
    <a href="./src/logout.php">
        <button>Log Out</button>
    </a>
</body>
</html>
<?php
$errors = [];
$errorMessage = '';
error_reporting(0);
if(!empty($_POST)){
    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $connect = mysqli_connect("localhost", "your_db_login", "your_db_password", "your_db_name");
    $sql = "INSERT INTO `messages`(`name`, `email`, `message`)
            VALUES ('$name','$email','$message')";
    $result = mysqli_query($connect, $sql);
    mysqli_close($connect);

    if(empty($name)){
        $errors[] = 'Name is empty'; 
    }else if(empty($email)){
        $errors[] = 'Email is empty';
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = 'Email is invalid';
    }else if(empty($message)){
        $errors[] = 'Message is empty';
    }

    if(!empty($errors)){
        $allErrors = join('<br/>', $errors);
        $errorMessage = "{$allErrors}";
    }else{
        $emailTo    = 'receiver_email_address';
        $subject    = "New email from $name";
        $paragraphs = ["$message", "Email: {$email}", "Name: {$name}"];
        $body       = join(PHP_EOL, $paragraphs);

        if (mail($emailTo, $subject, $body)) {
            header('Location: thank-you.html');
        } else {
            $errorMessage = "Something went wrong. Please try again";
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <form class="form" method="post">
        <div class="card">
            <div class="header">
                <h1>Contact Us</h1>
            </div>
            <div class="col">
                <input type="text" name="name" placeholder="Name">
            </div>
            <div class="col">
                <input type="email" name="email" placeholder="Email">
            </div>
            <div class="col">
                <textarea name="message" placeholder="Message"></textarea>
            </div>
            <div class="col">
                <button name="send">Send</button>
            </div>
            <p class="error-message"></p>
            <p><?php echo $errorMessage?></p>
        </div>
    </form>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js" integrity="sha512-jjkKtALXHo5xxDA4I5KJyEtYCAqHyOPuWwYFGWGQR2RgOIEFTQsZSDEC5GCdoAKMa8Yay/C+jMW8LCSZbb6YeA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="script/script.js"></script>
</body>
</html>
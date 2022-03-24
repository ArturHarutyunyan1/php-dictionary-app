<?php

if(isset($_POST['submit'])){
    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName  = htmlspecialchars($_POST['lastName']);
    $email     = htmlspecialchars($_POST['email']);
    $number    = htmlspecialchars($_POST['number']);
    $message   = htmlspecialchars($_POST['message']);

    $receiver    = "receiver email address";
    $subject     = "From: $firstName $lastName";
    $messageBody = "$message \n  Email Address: $email \n Phone Number: $number";
    $sender      = "From: $email";

    if(mail($receiver, $sender, $messageBody, $subject)){
        echo "<script>alert('Your message has been successfully sent!')</script>";
    }else{
        echo "<script>alert('Your message has been successfully sent!')</script>";
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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body{
    width: 100%;
    height: 100vh;
    background: royalblue;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    font-family: 'Roboto', sans-serif;
}

.content{
    width: 700px;
    height: 550px;
    background: white;
    border-radius: 5px;
}

.header{
    width: 90%;
    margin: auto;
    text-align: center;
    padding-top: 25px;
    border-bottom: 1px solid black;
}

.form{
    width: 80%;
    margin: auto;
    padding-top: 3.5rem;
}

.row{
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.row-item{
    width: 47%;
}

input{
    width: 100%;
    height: 50px;
    border-radius: 5px;
    border: 1px solid black;
    outline: none;
    padding-left: 15px;
    font-size: 20px;
    margin-bottom: 25px;
}

textarea{
    width: 100%;
    height: 150px;
    padding: 15px;
    font-size: 20px;
    border-radius: 5px;
    border: 1px solid black;
    outline: none;
    resize: none;
}

.submit{
    width: 70%;
    margin: auto;
}

button{
    width: 100%;
    height: 50px;
    background: black;
    color: white;
    font-size: 20px;
    border-radius: 5px;
    border: none;
    margin-top: 25px;
    cursor: pointer;
}


/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

@media (max-width: 768px){
    .map-content{
        width: 90%;
        height: auto;
        padding: 1rem;
    }
    .row{
        flex-direction: column;
    }
    .form{
        width: 100%;
        margin: auto;
        padding-top: 2rem;
    }
    .row-item{
        width: 100%;
    }
    input{
       width: 100%;
       padding-left: 15px;
    }
}
    </style>
</head>
<body>
    <form method="post" class="contactForm">
        <div class="content">
            <div class="header">
                <h1>Contact Us</h1>
            </div>
            <div class="form">
                <div class="row">
                    <div class="row-item">
                        <input type="text" name="firstName" placeholder="First Name" required>
                    </div>
                    <div class="row-item">
                        <input type="text" name="lastName" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="row">
                    <div class="row-item">
                        <input type="email" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="row-item">
                        <input type="number" name="number" placeholder="Phone Number" required>
                    </div>
                </div>
                <div class="col">
                    <textarea name="message" placeholder="Message" required></textarea>
                </div>
                <div class="submit">
                    <button name="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
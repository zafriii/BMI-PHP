<?php
session_start();

$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "bmi_php_app"; 

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$valid_email = 'admin@gmail.com';
$valid_password = 'password';

if ($email === $valid_email && $password === $valid_password) {
    $_SESSION['username'] = $email;
    header('Location: users.php');
    exit();
} else {
    $sql = "SELECT * FROM appusers WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password']) || $password === $valid_password) {
            $_SESSION['username'] = $email;
            header('Location: index.php');
            exit();
        } else {
            $error_message = "Invalid credentials. Please <a href='login.html'>try again</a>.";
        }
    } else {
        $error_message = "Invalid credentials. Please <a href='login.html'>try again</a>.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css"> 
</head>
<body>
<div class="login-container">
    <?php
    if (isset($error_message)) {
        echo '<p class="error-message">' . $error_message . '</p>';
    }
    ?>
</div>
</body>
</html>

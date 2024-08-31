<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../login.html');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bmi_php_app";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$current_email = $_SESSION['username']; 
$new_username = $_POST['username'];
$new_email = $_POST['email'];

$sql = "UPDATE appusers SET username='$new_username', email='$new_email' WHERE email='$current_email'";

if ($conn->query($sql) === TRUE) {
    
    $_SESSION['username'] = $new_email;
    header('Location: index.php');
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

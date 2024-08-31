<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bmi_php_app";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = trim($_POST['password']);

 //validations   
    
    if (empty($username)) {
        echo "<script>alert('Username is required.')</script>";
        echo "<script>window.location.replace('../register.html');</script>";
        exit();
    }

    
    if (empty($email)) {
        echo "<script>alert('Email is required.')</script>";
        echo "<script>window.location.replace('../register.html');</script>";
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.')</script>";
        echo "<script>window.location.replace('../register.html');</script>";
        exit();
    }

    
    if (empty($password)) {
        echo "<script>alert('Password is required.')</script>";
        echo "<script>window.location.replace('../register.html');</script>";
        exit();
    } elseif (strlen($password) < 6) {
        echo "<script>alert('Password must be at least 6 characters long.')</script>";
        echo "<script>window.location.replace('../register.html');</script>";
        exit();
    }

    
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    
    $sql_check_email = "SELECT * FROM appusers WHERE email = ?";
    $stmt = $conn->prepare($sql_check_email);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result_check_email = $stmt->get_result();

    if ($result_check_email->num_rows > 0) {
        echo "<script>alert('Email already exists. Please use a different email.')</script>";
        echo "<script>window.location.replace('../register.html');</script>";
        exit();
    }

    
    $sql_insert_user = "INSERT INTO appusers (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql_insert_user);
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        session_start();
        $_SESSION['username'] = $email;
        header('Location: index.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

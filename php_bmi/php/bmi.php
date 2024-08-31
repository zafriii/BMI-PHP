<?php
session_start();


if (!isset($_SESSION['username'])) {
    header('Location: ../login.html');
    exit();
}

//sanitize and validate input
function sanitize_input($input) {
    return htmlspecialchars(trim($input));
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bmi_php_app";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate and sanitize input data
$name = isset($_POST['name']) ? sanitize_input($_POST['name']) : '';
$age = isset($_POST['age']) ? intval($_POST['age']) : 0;
$gender = isset($_POST['gender']) ? sanitize_input($_POST['gender']) : '';
$height = isset($_POST['height']) ? floatval($_POST['height']) : 0.0;
$weight = isset($_POST['weight']) ? floatval($_POST['weight']) : 0.0;


if ($height > 0 && $weight > 0) {
    $bmi = $weight / ($height * $height);
} else {
    $bmi = 0;
}


if ($bmi < 18.5) {
    $health_message = "Your BMI indicates that you are underweight. It's important to ensure you're getting enough nutrients.";
} elseif ($bmi >= 18.5 && $bmi < 25) {
    $health_message = "Your BMI is within the healthy range. Keep up the good work with a balanced diet and regular exercise.";
} elseif ($bmi >= 25 && $bmi < 30) {
    $health_message = "Your BMI indicates that you are overweight. Consider adjusting your diet and increasing physical activity.";
} else {
    $health_message = "Your BMI indicates obesity. Consult a healthcare professional for personalized advice and support.";
}


$username = $_SESSION['username'];


$sql_insert_user = "INSERT INTO bmiusers (Name, Age, Gender) VALUES (?, ?, ?)";
$stmt_user = $conn->prepare($sql_insert_user);
$stmt_user->bind_param("sis", $name, $age, $gender);



if ($stmt_user->execute()) {
    $bmi_user_id = $stmt_user->insert_id;

   
    $sql_insert_bmi = "INSERT INTO bmirecords (BMIUserID, Height, Weight, BMI) VALUES (?, ?, ?, ?)";
    $stmt_bmi = $conn->prepare($sql_insert_bmi);
    $stmt_bmi->bind_param("iddd", $bmi_user_id, $height, $weight, $bmi);

    if ($stmt_bmi->execute()) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>BMI Calculation Result</title>
            <link rel="stylesheet" href="../css/bmi.css">
        </head>
        <body>
            <div class="calc-container">
                <div class="calc-items">

                <h2>BMI Calculation Result</h2>
                <p>BMI calculation successful for <?php echo $username; ?>! Your BMI is <?php echo $bmi; ?>.</p>
                <p><?php echo $health_message; ?></p>
                <p><a href="index.php">Back to Home</a></p>

                </div>
                
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Error: " . $sql_insert_bmi . "<br>" . $conn->error;
    }
} else {
    echo "Error: " . $sql_insert_user . "<br>" . $conn->error;
}


$stmt_user->close();
$stmt_bmi->close();
$conn->close();
?>

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

$current_username = $_SESSION['username'];

//1st reg user
$first_user_sql = "SELECT email FROM appusers ORDER BY id ASC LIMIT 1";
$first_user_result = $conn->query($first_user_sql);
$first_user_row = $first_user_result->fetch_assoc();
$first_user_email = $first_user_row['email'];


if ($current_username !== 'admin@gmail.com' && $current_username !== $first_user_email) {
    echo "
    <html>
    <head>
        <style>
            body {
                background-color:#f0f0f0;
                color: #721c24;
                font-family: Arial, sans-serif;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                margin: 0;
            }
            .error-message {
                font-size: 20px;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <p class='error-message'>Unauthorized access!</p>
    </body>
    </html>";
    exit();
}

$sql = "SELECT id, username, email FROM appusers";
$result = $conn->query($sql);

$count_sql = "SELECT COUNT(*) as total_users FROM appusers";
$count_result = $conn->query($count_sql);
$total_users = $count_result->fetch_assoc()['total_users'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
    <title>Admin Dashboard</title>
    <!-- <link rel="stylesheet" href="../css/user.css"> -->
    <link rel="stylesheet" href="../css/userdata.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>
   <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3><span>Admin</span></h3>
        </div>
        
        <div class="side-content">
            <div class="side-menu">
                <ul>
                    <li>
                       <a href="index.php" class="active">
                            <span class="las la-home"></span>
                            <small>Home</small>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="main-content">
        
        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-admin">Dashboard</span>
                </label>
                <div class="header-menu">
                    <div class="user">                                           
                        <span class="las la-power-off"></span>
                        <span><a href="logout.php">Logout</a></span>
                    </div>
                </div>
            </div>
        </header>
        
        <main>
            
          
            <div class="page-content">
            
            <div class="analytics">
            <div class="card">
                <div class="card-head">
                    <h2><?php echo $total_users; ?></h2>
                    <span class="las la-user-friends"></span>
                </div>
                <div class="card-progress">
                    <small>Total Users</small>
                    <div class="card-indicator">
                        <div class="indicator one" style="width: 60%"></div>
                    </div>
                </div>
            </div>
        </div>

                <div class="records table-responsive">
                    <div class="record-header">
                        <h3>Registered Users</h3>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                           
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            
            </div>
            
        </main>
        
    </div>
</body>
</html>

<?php

$conn->close();
?>

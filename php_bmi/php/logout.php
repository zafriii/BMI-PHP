<?php
session_start();
session_destroy();
header('Location: ../login.html');
exit();
echo "You have been logged out. <a href='login.html'>Login again</a>.";
?>

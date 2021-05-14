<?php 

session_start();
echo "logging you out";

session_destroy();
header("Location: /My-Forum/index.php?logoutsuccess=true");
?>
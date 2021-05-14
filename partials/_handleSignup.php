<?php 
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$ShowError = false;
$ShowAlert = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    
    if (isset($_POST['signupName'])) {
        $signupName = $_POST['signupName'];
    }
    if (isset($_POST['signupEmail'])) {
        $signupEmail = $_POST['signupEmail'];
    }
    if (isset($_POST['signupPassword'])) {
        $signupPassword = $_POST['signupPassword'];
    }
    if (isset($_POST['signupCpassword'])) {
        $signupCpassword = $_POST['signupCpassword'];
    }

    // $signupEmail = $_POST["signupEmail"];
    // $signupPassword = $_POST["signupPassword"];
    // $signupCpassword = $_POST["signupCpassword"];

    //check whether this email exist or not
    $ExistSql = "SELECT * FROM `users` WHERE user_email = '$signupEmail'";
    $result = mysqli_query($conn, $ExistSql);
    $NumExistRows = mysqli_num_rows($result);
    if ($NumExistRows > 0){
        // $ShowError = true;
        $ShowError = "Email Is Already In Use, Please Try With Diffrent Email Id.";
    }
    else{
        if ($signupPassword == $signupCpassword){
            $hash = password_hash($signupPassword, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_name`, `user_email`, `user_password`, `timestamp`) 
                    VALUES ('$signupName', '$signupEmail', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                // $ShowAlert = true;
                header('Location:/My-Forum/index.php?signupsuccess=true');
                exit();
            }
           }
        else {
            // $ShowError = "Password Do Not Match";
            header('Location: /My-Forum/index.php?signupsuccess=false');
        }
    }
    // header('Location: /My-Forum/index.php?signupsuccess=false&error=$ShowError');
}

?>
<?php 
// $login = false;
$ShowError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $email = $_POST['LoginEmail'];
    $password = $_POST['LoginPassword'];

    $sql = "SELECT * FROM users WHERE user_email='$email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if($numRows==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['user_password'])){
        // $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['sno'] = $row['sno'];
        $_SESSION['useremail'] = $email;
        // echo "Logged in". $email;
        header("Location:/My-Forum/index.php?loginstatus=true");
        exit();     
        }
            header("Location:/My-Forum/index.php?loginstatus=false");        
    }
}
?>
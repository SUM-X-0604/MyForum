<?php 
session_start();
    echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/My-Forum">My-Forum</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/My-Forum">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="about.php">About</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link active dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Top Categories
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">';

                            $sql = "SELECT category_name, category_id FROM `categories` LIMIT 3";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)){
                                echo '<a class="dropdown-item" href="threadelist.php?catid=' . $row['category_id'] . ' ">' . $row['category_name'] .  ' </a>';
                            }

                        echo '</div>
                            </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="contact.php" tabindex="-1" aria-disabled="true">Contact</a>
                        </li>
                    </ul>';
                        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=="true"){
                            echo'<form class="d-flex" action="search.php" method="get">
                                    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                    <p class="text-light my-0 mx-2 text-center">Welcome ' . $_SESSION['useremail'] .'</p> 
                                    <a class="btn btn-outline-success ml-2" href="partials/_logout.php" >Logout</a>
                                    </form>';
                        }
                        else {
                            echo '<form class="d-flex mx-2">
                                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>  
                                  </form>
                                <button class="btn btn-outline-primary mx-2" data-bs-toggle="modal" data-bs-target="#signupModal">Sign-Up</button>
                                <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginModal">Log-In</button>';
                            }
                    echo     
                        '</div>
                        </div>
                    </nav>';


    // Include modals                
    include 'partials/_loginModal.php';
    include 'partials/_signupModal.php';
    include 'partials/_handleSignup.php';

    // Signup Form
    if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true") {
        echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                    <strong>Congrats!</strong> Your Account Has Been Created Now You Can Login.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
    if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="false") {
        echo '<div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
                    <strong>Error!</strong> Your Password Do Not Match. Please Make Sure You Type Same Password.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    // Login Form
    if(isset($_GET['loginstatus']) && $_GET['loginstatus']=="false") {
        echo '<div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
                    <strong>Error!</strong> Your Email Or password Is Incorrect.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }    

    if(isset($_GET['loginstatus']) && $_GET['loginstatus']=="true") {
        echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                    <strong> Successfully Logged In!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }    
    

    // Logout Form
    if(isset($_GET['logoutsuccess']) && $_GET['logoutsuccess']=="true") {
        echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                    <strong> Successfully Logged Out!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }    

    // Signup Error
    // if ($ShowError) {
    //     echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
    //       <strong>Error! </strong> ' . $ShowError . '
    //       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //   </div>';
    //   }

    
 ?>
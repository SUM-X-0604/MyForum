<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>My-Froum</title>
</head>

<body>
    <!-- Database Connection -->
    <?php include 'partials/_dbconnect.php'?>
    <!-- Header -->
    <?php include 'partials/_header.php'?>

    <?php 
    $id = $_GET['threadid']; 
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_user_id = $row['thread_user_id'];

        // Query to find out the username of the user who posted the thread
        $sql2 = "SELECT user_name FROM `users` WHERE sno = '$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by = $row2['user_name'];
    }    
    ?>
    <!-- Header End -->

    <?php
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method=='POST') {
            //Insert into Comment DB
            $comment = $_POST['comment']; 
            $comment = str_replace("<","&lt;", $comment);
            $comment = str_replace(">","&gt;", $comment);
            $sno = $_POST['sno']; 
            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`)
                    VALUES ('$comment', '$id', '$sno', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            $showAlert = true;
            if ($showAlert) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Congrats!</strong> Your Comment Has Been Added Successfully. You Can Check Below.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }

            }
    ?>

    <div class="container my-4 mb-5">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title;?></h1>
            <p class="lead"><?php echo $desc;?></p>
            <!-- <p>This forum is for sharing infrmation with everyone</p>
            <p>No Spam / Advertising / Self-promote in the forums Do not post copyright-infringing material. ...
                Do not post ???offensive??? posts, links or images. ...
                Do not cross post questions. ...
                Do not PM users asking for help. ...
                Remain respectful of other members at all times.</p> -->
            <p>Posted By: <b> <?php echo $posted_by; ?> </b></p>
            <hr class="my-4">
        </div>
    </div>


    <!-- <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method=='POST') {
        //Insert into db
        $th_title = $_POST['title']; 
        $th_desc = $_POST['desc'];
        $sno = $_POST['sno'];
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`)
                VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Congrats!</strong> Your Question Has Been Submitted Successfully. You Can Check Below.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }

    }
    ?> -->

<div class="container my-4 mb-5">
        <h1>Discussions</h1>
        <?php 
            $id = $_GET['threadid']; 
            $sql = "SELECT * FROM `comments` WHERE thread_id= $id";
            $result = mysqli_query($conn, $sql);
            $noResult = true;
            while ($row = mysqli_fetch_assoc($result)) {
                $noResult = false;
                $id = $row['comment_id'];
                $content = $row['comment_content'];
                $comment_time = $row['comment_time'];
                $comment_by = $row['comment_by'];
                $sql2 = "SELECT user_name FROM `users` WHERE sno = '$comment_by'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                
                echo '<div class="media my-3">
                        <img src="img/user-default.png" width="35px" alt="..." class="mr-3">
                        <div class="media-body">
                        <p class="font-weight-bold my-0"><b>By ' . $row2['user_name'] . ' at ' . $comment_time . '</b></p>
                            ' . $content . '
                        </div>
                      </div>';
            } 
            
            if ($noResult) {
                echo '<div class="jumbotron jumbotron-fluid">
                            <div class="container">
                            <h1 class="display-4">No comments available on this category<br><h2>Be the first person to comment...</h2></h1>
                            <h1 class="lead"></h1>
                            </div>
                      </div>';
            } 
        ?>
    </div>


    <?php 
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

    echo 
        '<div class="container mb-5">
        <div class="jumbotron">
            <h1>Add Your Comment</h1>
            <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1" Placeholder="Write Your Comment Here..."></label>
                    <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                    <input type="hidden" name="sno" value="' . $_SESSION["loggedin"]. '" >
                </div>
                <input type="hidden" name="sno" value="' . $_SESSION["sno"] . '" >
                <br>
                <button type="submit" class="btn btn-success">Post Comment</button>
            </form>
        </div>
    </div>';
    }
   
    else{
        echo '
        <div class="container mb-5">
        <h2 class="Lead" style="color:red">Opps! It Look Likes You Are Not Logged In. Please Login First To Post Comments</h2>
        </div>';
    }
    ?>

                                                  

    <!-- Footer -->
    <?php include 'partials/_footer.php' ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>
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
        $id = $_GET['catid']; 
        $sql = "SELECT * FROM `categories` WHERE category_id = $id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $catname = $row['category_name'];
            $catdesc = $row['category_description'];
        }
    ?>

    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method=='POST') {
        //Insert into db
        $th_title = $_POST['title']; 
        $th_desc = $_POST['desc'];

        $th_title = str_replace("<","&lt;", $th_title);
        $th_title = str_replace(">","&gt;", $th_title);

        $th_desc = str_replace("<","&lt;", $th_desc);
        $th_desc = str_replace(">","&gt;", $th_desc);

        $sno = $_POST['sno'];
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`)
                VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Congrats!</strong> Your Qestion Has Been Submitted Successfully. You Can Check Below.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }

    }
    ?>

    <!-- Header End -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> forum</h1>
            <p class="lead"><?php echo $catdesc; ?></p>
            <hr class="my-4">
            <p>This forum is for sharing infrmation with everyone</p>
            <p>No Spam / Advertising / Self-promote in the forums Do not post copyright-infringing material....
                Do not post “offensive” posts, links or images....
                Do not cross post questions....
                Do not PM users asking for help....
                Remain respectful of other members at all times.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>


    <!-- User login checking -->
    <?php 
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

    echo 
        '<div class="container">
            <h1>Ask a Question</h1>
            <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" required>
                </div>
                <input type="hidden" name="sno" value="' . $_SESSION["sno"] . '" >
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Elaborate Your Problem Here...</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
                </div><br>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>';
    }
   
    else{
        echo '
        <div class="container">
        <h2 class="Lead" style="color:red">Opps! It Look Likes You Are Not Logged In. Please Login First</h2>
        </div>';
    }
    ?>


    <div class="container my-4">
        <?php 
            $id = $_GET['catid']; 
            $sql = "SELECT * FROM `threads` WHERE thread_cat_id= $id";
            $result = mysqli_query($conn, $sql);
            $noResult = true;
            while ($row = mysqli_fetch_assoc($result)) {
                $noResult = false;
                $id = $row['thread_id'];
                $title = $row['thread_title'];
                $desc = $row['thread_desc']; 
                $thread_time = $row['timestamp']; 
                $thread_user_id = $row['thread_user_id'];
                $sql2 = "SELECT user_name FROM `users` WHERE sno = '$thread_user_id'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);

                echo '<div class="media my-3">
                        <img src="img/user-default.png" width="35px" alt="..." class="mr-3">
                        <div class="media-body">
                        <p class="font-weigh-bold my-0">By ' . $row2['user_name'] . ' at ' . $thread_time . ' </p><h5 class="mt-0"> 
                        <a class="text-dark" href="thread.php?threadid=' . $id . '">' . $title . '</a> </h5>
                        '. $desc . '
                        </div>
                      </div>';
            }
            if ($noResult) {
                echo '<div class="jumbotron jumbotron-fluid">
                            <div class="container">
                            <h2 class="display-4">No questions available on this category<br><h2>Be the first person to ask...</h2></h2>
                            <h1 class="lead"></h1>
                            </div>
                      </div>';
            }
        ?>
        
    </div>

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
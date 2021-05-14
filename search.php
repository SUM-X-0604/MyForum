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
<style>
.container {
    min-height: 480px;
}
</style>
<body>
    <!-- Header -->
    <!-- Database Connection -->
    <?php include 'partials/_dbconnect.php'?>
    <?php include 'partials/_header.php'?>
    <!-- Header End -->

    <!-- Search result -->
        <div class="container my-4 text-center">
            <h1 class="my-3">Search Result For :- <b>"<?php  echo $_GET['search'] ?>"</b></h1>

        <?php
        $noresult = true;
            $query = $_GET["search"];
            $sql = "SELECT * FROM threads WHERE MATCH (thread_title,thread_desc) against ('$query')";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $thread_id = $row['thread_id'];
                $url = "thread.php?threadid=". $thread_id;
                $noresult = false; 

            echo '<div class="result">
                    <h3><a href=" ' . $url . ' " class="text-dark">' . $title . '</a></h3>
                    <p>' . $desc . '</p>
                  </div>';
            }
            
            if ($noresult) {
                echo '<div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">No result found</h1>
                            <p class="lead"></p>
                        </div>
                        </div>';
            }
        ?>

        </div>


    <!-- End Search result -->

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
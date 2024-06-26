<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>I-Forum</title>
    <style>
    .container {
        min-height: 635px
    }
    </style>
</head>
<body>
    <?php include'partials/_db.conect.php';  ?>
    <?php include'partials/_header.php';  ?>
    <div class="container my-3">
        <h1>Search Result for<i>"<?php echo $_GET['search'] ?>"</i></h1>
        <?php
             $qurry = $_GET['search'];
             $sql = "SELECT * FROM `threads` WHERE MATCH (thread_title,thread_desc) against ('$qurry')";
             $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                 $title = $row['thread_title'];
                 $desc = $row['thread_desc'];
                 $thread_id = $row['thread_id'];
                 $url = "thread.php?threadid=". $thread_id; 

                   echo'<div class="result">
            <h3> <a href="'.$url.'" class="text-dark">'.$title.'</a> </h3>
            <p>'.$desc.'</p>
        </div>';
                }
    ?> 
        <!-- <div class="result">
            <h3> <a href="category/kdinsin" class="text-dark">error</a> </h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere, quas tempore aut omnis quis tempora
                ipsam saepe obcaecati ipsum reiciendis at illum.</p>

        </div> -->
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <?php require'partials/_footer.php'; ?>
</body>
</html>






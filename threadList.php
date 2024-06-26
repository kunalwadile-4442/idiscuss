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
    #ques {
        min-height: 233px
    }
    </style>
</head>

<body>
<?php include 'partials/_db.conect.php'; ?>
    <?php include 'partials/_header.php'; ?>
  

    <?php
        // Sanitize the catid parameter to prevent SQL injection
        $id = intval($_GET['catid']);

        // Fetch category details
        $sql = "SELECT * FROM category WHERE category_id=$id";
        $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $catname = $row['category_name'];
                $catdesc = $row['category_desc'];
          }
    ?>
    <?php 
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
    // Insert thread into DB 
    $th_title = $_POST['title'];
    $th_desc = $_POST['desc'];

    $th_title = str_replace("<","&lt;",$th_title);
    $th_title = str_replace(">","&gt;",$th_title);

    $th_desc = str_replace("<","&lt;",$th_desc);
    $th_desc = str_replace(">","&gt;",$th_desc);

    // Sanitize inputs to prevent SQL injection
    $th_title = mysqli_real_escape_string($conn, $th_title);
    $th_desc = mysqli_real_escape_string($conn, $th_desc);

    $sno = $_POST['sno'];

    // Correct SQL query
    $sql = "INSERT INTO threads (thread_title, thread_desc, thread_cat_id, thread_user_id, timestamp) 
            VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Successful!</strong> Thread Insert Successful...
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>';
            
             // Redirect to the same page
       
           
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!!</strong> Error: ' . mysqli_error($conn) . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>';
    }
}
?>
    <!-- category container start here  -->
    <div class="container my-5">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo htmlspecialchars($catname); ?> forums</h1>
            <p class="lead"><?php echo htmlspecialchars($catdesc); ?></p>
            <hr class="my-4">
            <p>Share the forum for more knowledge peer to peer share img.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>

    <?php 

    if( isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

        echo' <div class="container">
        <h3>Start Discussion</h3>

        <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                 <div class="form-group">
                    <label for="title">Problem Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                    <small class="form-text text-muted">Keep your title short and concise.</small>
                 </div>
                <input type="hidden" name="sno" value="' . $_SESSION["sno"] .'">

                 <div class="form-group">
                     <label for="desc">Elaborate your Problem</label>
                     <textarea class="form-control" name="desc" id="desc" rows="4" placeholder="Describe your problem"
                    required></textarea>
                 </div>
            <button type="submit" class="btn btn-success mb-2">Submit</button>
        </form>

    </div>';

    }
    else{
        echo'<div class="container">

                  <p class="lead">You are not logged in. Please Login to able start Discussion</p>
             </div>';

    }
    
    ?>

    <div class="container" id="ques">
        <h1>Browse Questions...</h1>

        <?php
// Fetch threads for the given category
$sql = "SELECT * FROM threads WHERE thread_cat_id=$id";
$result = mysqli_query($conn, $sql);

if ($result) {
    $noResult = true;
    while ($row = mysqli_fetch_assoc($result)) {
        $noResult = false; // Thread found, so set $noResult to false
        $id = $row['thread_id'];
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $ttime = $row['timestamp'];
        $thread_user_id= $row['thread_user_id'];

        $sql2 = "SELECT user_email FROM users WHERE sno= $thread_user_id";
        $result2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);



        echo '<div class="media my-2">
                <img src="assets/user.jpeg" height="70px" width="70px" class="mr-3 my-2" alt="...">
                <div class="media-body my-2">
                    <p class="my-0"> <b> Ask by : '. $row2['user_email'].' at </b>  <i>'. date("j F, Y", strtotime($ttime)) . ' </i></p>
                    <h5 class="mt-0 my-2"><a class="text-dark" href="thread.php?threadid='. $id .'"> ' . $title . ' </a></h5>
                    ' . $desc . '
                </div>
              </div>';
    }

    // Display the "No Result Found" message only if no threads were found
    if ($noResult) {
        echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <p class="display-4">No Thread Found!!!</p>
                    <p class="lead">Be the First person to ask a Question!!</p>
                </div>
              </div>';
    }
}
?>



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
    <?php require 'partials/_footer.php'; ?>
</body>

</html>
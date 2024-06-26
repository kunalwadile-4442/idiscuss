
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
       #ques{
            min-height:233px
        }
    </style>
</head>

<body>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_db.conect.php'; ?>

    hii

    <?php
        // Sanitize the catid parameter to prevent SQL injection
        $id = intval($_GET['threadid']);

        // Fetch category details
        $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $thread_user_id = $row['thread_user_id']; 
                // query rhe user table to find the original table 
                $sql3 = "SELECT user_email FROM `users` WHERE sno=$thread_user_id";
                $result3 = mysqli_query($conn, $sql3);
                $row3 = mysqli_fetch_assoc($result3);
                $posted_by = $row3['user_email'];
            }
        } else {
            echo "Error retrieving category data: " . mysqli_error($conn);
        }
    ?>

            <?php 
           $method = $_SERVER['REQUEST_METHOD'];
           if ($method == 'POST') {
               // Sanitize inputs to prevent SQL injection
               $comment = mysqli_real_escape_string($conn, $_POST['comment']);
               $thread_id = intval($_GET['threadid']); // Assuming 'threadid' is passed through GET
                $sno = $_POST['sno'];
               // SQL query to insert comment into 'comment' table
               $sql = "INSERT INTO `comment` (`comment_content`, `thread_id`, `comment_time`, `comment_by`) 
                       VALUES ('$comment', '$thread_id', current_timestamp(),'$sno')";
           
               $result = mysqli_query($conn, $sql);
           
               if ($result) {
                   // Success message if comment is inserted
                   echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                           <strong>Successful!</strong> Your Comment has been added.
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                           </button>
                         </div>';
                       
                         
               } else {
                   // Error message if insertion fails
                   echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                           <strong>Error!</strong> Failed to add comment: ' . mysqli_error($conn) . '
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
            <h1 class="display-4"> <?php echo $title; ?></h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <p>Share the forum for more knowledge peer to peer share img.</p>
            <p>Posted by: <strong> <?php echo $posted_by; ?></strong></p>
        </div>
    </div>
    <?php 
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo '<div class="container">
        <h2>Post a Comment</h2>
        <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
            <div class="form-group">
                <label for="title">Type your Comments</label>
                <textarea type="text" class="form-control" id="comment" name="comment" placeholder="Enter comments" required></textarea>
                <input type="hidden" name="sno" value="' . $_SESSION["sno"] . '">
            </div>
            <button type="submit" class="btn btn-success mb-2">Post Comment</button>
        </form>
    </div>';
} else {
    echo '<div class="container">
        <h1 class="py-2">Post a Comment</h1>
        <p class="lead">You are not logged in. Please login to be able to start a comment.</p>
    </div>';
}
?>

    
    <div class="container" id="ques">
        <h1>Discussion...</h1>

        <?php
// Fetch comments for the given thread
$sql = "SELECT * FROM `comment` WHERE thread_id=$id";
$result = mysqli_query($conn, $sql);

$noResult = true;
while ($row = mysqli_fetch_assoc($result)) {
    $noResult = false;
    $comment_id = $row['comment_id'];
    $content = $row['comment_content'];
    $time = $row['comment_time'];
    $thread_user_id = $row['comment_by'];
    // Fetch user email based on the comment_by field
    $sql3 = "SELECT user_email FROM `users` WHERE sno=$thread_user_id";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_assoc($result3);

    // Display the comment with the user email
    echo '<div class="media my-2">
        <img src="assets/user.jpeg" height="70px" width="70px" class="mr-3 my-2" alt="...">
        <div class="media-body my-2">
            <p class="my-0"><b>' . htmlspecialchars($row3['user_email']) . ' at </b><i>' . date("j F, Y", strtotime($time)) . '</i></p>
            ' . htmlspecialchars($content) . '
        </div>
    </div>';
}

if ($noResult) {
    echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
                <p class="display-4">No  Found!!!</p>
                <p class="lead">Be the first person to comment on this thread!</p>
            </div>
          </div>';
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

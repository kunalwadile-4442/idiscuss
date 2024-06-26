
<?php
$showError = "false";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include '_db.conect.php';
    $user_email = $_POST['signupEmail'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['signupcPassword'];
 
    //check email exist 
    $existemailsql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $existemailsql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0){
        $showError = "User name is already Exist!!!";
    } 
    else{
        if($pass == $cpass){
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_pass`) VALUES ('$user_email', '$hash');";
            $result  = mysqli_query($conn,$sql);
            if($result){
                $showError = true;
                header("Location: /forum/index.php?signupsuccess=true");
                exit();
            } 
        }
        else{
            echo" Password Does not match.";
        }
    }
    header("Location: /forum/index.php?signupsuccess=$showError");
}
?> 

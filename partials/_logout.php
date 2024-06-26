<?php 
session_start();
echo 'logging out please wait...';
session_destroy();

header("Location: /forum/index.php");

?>
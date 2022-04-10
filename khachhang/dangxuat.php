<?php
 require_once ('../db/dbhelp.php');
 session_start();
unset($_SESSION['user']);
header('location: trangchu.php');
?>
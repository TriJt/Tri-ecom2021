<?php
 require_once ('../db/dbhelp.php');
 session_start();
unset($_SESSION['useradmin']);
header('location: dangnhapadmin.php');
?>
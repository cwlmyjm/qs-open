<?php
include "function.php";
login($_POST['username'],$_POST['password'],connection());
echo "<script>window.location.href='index.php';</script>";
?>
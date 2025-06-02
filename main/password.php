<?php 
$password='123';
$password= password_hash($password, PASSWORD_DEFAULT);
echo $password;
?>
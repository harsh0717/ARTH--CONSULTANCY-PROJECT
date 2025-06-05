<?php
if (isset($_POST['user_name']) && isset($_POST['password'])) {
    function validate_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
    }
    $user_name = validate_input($_POST['user_name']);
	$password = validate_input($_POST['password']);
    
}
else{
    $em="unknown error occurred";
    header("location: ../login.php?error=$em");
    exit();
}
?>

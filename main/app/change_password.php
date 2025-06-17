<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_SESSION['role']) && isset($_SESSION['id']) ) {


if (isset($_POST['password']) && isset($_POST['new_password']) && isset($_POST['conform_password']) && $_SESSION['role'] == 'employee') {
    include "../DB_connection.php";

    function validate_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

   
    $password = validate_input($_POST["password"]);
    $new_password = validate_input($_POST["new_password"]);
    $conform_password = validate_input($_POST["conform_password"]);
    $id = $_SESSION['id'];

    if (empty($password) || empty($new_password) || empty($conform_password)) {
        $em = "Password is required";
	    header("Location: ../change_password.php?error=". urlencode($em));
	    exit();
    } elseif ($conform_password != $new_password) {
        $em = "New password and confirm password do not match";
        header("Location: ../change_password.php?error=" . urlencode($em) . "&id=" . urlencode($id));
        exit();
    } else {
        
        include "model/User.php";
        $user=get_user_by_id($conn, $id);


        if ($user) {
            if (password_verify($password, $user['password'])) {

                $new_password = password_hash($new_password, PASSWORD_DEFAULT);


                $data = array($new_password,$id);
                update_password($conn, $data,);

                $em = "Password Update Successfully";
                header("Location: ../change_password.php?success=" . urlencode($em) . "&id=" . urlencode($id));
                exit();
            }else{
                $em = "Incorrect Password";
                header("Location: ../change_password.php?error=" . urlencode($em));
                exit();
            }
        }else{
            $em = "Unknown error occurred";
            header("Location: ../change_password.php?error=" . urlencode($em));
            exit();
        }

    }
} else {
    $em = "Unknown error occurred";
    header("Location: ../change_password.php?error=" . urlencode($em));
    exit();
}

} 
else{
    $em = "Login First";
    header("Location: ../login.php?error=" . urlencode($em));
    exit();
}
?>
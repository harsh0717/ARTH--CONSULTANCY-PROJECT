<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {


    if (isset($_POST['full_name']) && isset($_POST['dob']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['address']) && $_SESSION['role'] == 'employee') {
        include "../DB_connection.php";

        function validate_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }


        $full_name = validate_input($_POST["full_name"]);
        $password = validate_input($_POST["password"]);
        $new_password = validate_input($_POST["new_password"]);
        $conform_password = validate_input($_POST["conform_password"]);
        $dob = validate_input($_POST["dob"]);
        $email = validate_input($_POST["email"]);
        $phone = validate_input($_POST["phone"]);
        $address = validate_input($_POST["address"]);
        $id = $_SESSION['id'];

        if (empty($full_name)) {
            $em = "Full Name is required";
            header("Location: ../edit_profile.php?error=" . urlencode($em) . "&id=" . urlencode($id));
            exit();
        } elseif (empty($dob)) {
            $em = "Dob is required";
            header("Location: ../edit_profile.php?error=" . urlencode($em) . "&id=" . urlencode($id));
            exit();
        }elseif (empty($email)) {
            $em = "Email is required";
            header("Location: ../edit_profile.php?error=" . urlencode($em) . "&id=" . urlencode($id));
            exit();
        }elseif (empty($phone)) {
            $em = "Phone number is required";
            header("Location: ../edit_profile.php?error=" . urlencode($em) . "&id=" . urlencode($id));
            exit();
        }elseif (empty($address)) {
            $em = "Address is required";
            header("Location: ../edit_profile.php?error=" . urlencode($em) . "&id=" . urlencode($id));
            exit();
        }
        else {

            include "model/User.php";
            $user=get_user_by_id($conn, $id);

            $data = array($full_name,$dob,$email,$phone,$address,$id);
            update_profile($conn, $data,);

            $em = "update Successfully";
            header("Location: ../edit_profile.php?success=" . urlencode($em) . "&id=" . urlencode($id));
            exit();
               
            
        }
    } else {
        $em = "Unknown error occurred";
        header("Location: ../edit_profile.php?error=" . urlencode($em));
        exit();
    }
} else {
    $em = "Login First";
    header("Location: ../login.php?error=" . urlencode($em));
    exit();
}

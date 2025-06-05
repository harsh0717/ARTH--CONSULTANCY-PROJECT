<?php
if (isset($_POST['user_name']) && isset($_POST['password'])) {
    include "../DB_connection.php";
    function validate_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $user_name = validate_input($_POST['user_name']);
    $password = validate_input($_POST['password']);

    if (empty($user_name)) {
        $em = "Please Enter User Name";
        header("location: ../login.php?error=$em");
        exit();
    } elseif (empty($password)) {
        $em = "Please Enter Password";
        header("location: ../login.php?error=$em");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_name]);
    }
} else {
    $em = "unknown error occurred";
    header("location: ../login.php?error=$em");
    exit();
}

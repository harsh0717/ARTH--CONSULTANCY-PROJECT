<?php
session_start();

function fail(string $message, string $oldUser = ''): void
{
    $_SESSION['flash_error']   = $message;
    $_SESSION['old_user_name'] = $oldUser;
    header('Location: ../login.php');
    exit;
}

if (!isset($_POST['user_name'], $_POST['password'])) {
    fail('Unknown error occurred');
}
function clean(string $v): string
{
    return htmlspecialchars(stripslashes(trim($v)));
}

$user_name = clean($_POST['user_name']);
$password  = clean($_POST['password']);

if ($user_name === '')  fail('User name is required');
if ($password  === '')  fail('Password is required', $user_name);

require_once '../DB_connection.php';  

$sql  = 'SELECT id, username, password, role FROM users WHERE username = ? LIMIT 1';
$stmt = $conn->prepare($sql);
$stmt->execute([$user_name]);

if (!$stmt->rowCount()) {
    fail('User not found', $user_name);
}

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!password_verify($password, $user['password'])) {
    // ⇢ user exists but wrong password
    fail('Password is incorrect', $user_name);
}

/* ---------- success ------------------------------------------------------ */
$_SESSION['id']       = $user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['role']     = $user['role'];

header('Location: ../index.php');
exit;

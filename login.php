<?php
include 'config.php';

header('Content-Type: application/json');

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    if (password_verify($password, $user['password'])) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Wrong password']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Email does not exist']);
}

$conn->close();
?>

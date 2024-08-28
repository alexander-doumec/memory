<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

error_log("Received registration request for username: $username");

if (empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'error' => 'Username and password are required']);
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
if (!$stmt) {
    error_log("Prepare failed: " . $db->error);
    echo json_encode(['success' => false, 'error' => 'Database error']);
    exit;
}

$stmt->bind_param("ss", $username, $hashedPassword);

if ($stmt->execute()) {
    error_log("User registered successfully: $username");
    echo json_encode(['success' => true]);
} else {
    error_log("Registration failed: " . $stmt->error);
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}

$stmt->close();
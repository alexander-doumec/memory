<?php
session_start();
require_once 'config.php';

if (isset($_POST['score']) && isset($_SESSION['user_id'])) {
    $score = intval($_POST['score']);
    $userId = $_SESSION['user_id'];

    $stmt = $db->prepare("INSERT INTO games (user_id, score) VALUES (?, ?)");
    $stmt->bind_param("ii", $userId, $score);
    
    if ($stmt->execute()) {
        $db->query("UPDATE users SET total_score = total_score + $score WHERE id = $userId");
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}
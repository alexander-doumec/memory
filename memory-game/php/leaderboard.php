<?php
require_once 'config.php';

$result = $db->query("SELECT username, total_score FROM users ORDER BY total_score DESC LIMIT 10");
$leaderboard = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($leaderboard);
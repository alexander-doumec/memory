<?php
$db = new mysqli('localhost','memory-game');
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
$db->set_charset("utf8mb4");

// Test de connexion
if ($db->ping()) {
    echo "Connection etablished !";
} else {
    echo "Connection error ! : " . $db->error;
}

?>
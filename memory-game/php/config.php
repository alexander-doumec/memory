<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new mysqli('localhost','memory-game');
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
$db->set_charset("utf8mb4");

// Connection test
if ($db->ping()) {
    echo "Connection successful!";
} else {
    echo "Connection error: " . $db->error;
}

?>
<?php
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user_id = $_GET['user_id'];

    try {
        $stmt = $conn->prepare("SELECT * FROM language_preferences WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $user_id]);
        $preferences = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode($preferences);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

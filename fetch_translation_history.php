<?php
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user_id = $_GET['user_id'];

    try {
        $stmt = $conn->prepare("SELECT * FROM translations WHERE user_id = :user_id ORDER BY translation_date DESC");
        $stmt->execute([':user_id' => $user_id]);
        $history = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($history);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

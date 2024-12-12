<?php
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user_id = $_GET['user_id'];

    try {
        $stmt = $conn->prepare("SELECT * FROM translations WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $user_id]);
        $history = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=translation_history.csv');

        $output = fopen('php://output', 'w');
        fputcsv($output, array_keys($history[0]));

        foreach ($history as $row) {
            fputcsv($output, $row);
        }
        fclose($output);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

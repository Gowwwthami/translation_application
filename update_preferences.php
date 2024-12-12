<?php
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $default_source_language = $_POST['default_source_language'];
    $default_target_language = $_POST['default_target_language'];
    $tone_preference = $_POST['tone_preference'];

    try {
        $stmt = $conn->prepare("REPLACE INTO language_preferences (user_id, default_source_language, default_target_language, tone_preference) VALUES (:user_id, :default_source_language, :default_target_language, :tone_preference)");
        $stmt->execute([
            ':user_id' => $user_id,
            ':default_source_language' => $default_source_language,
            ':default_target_language' => $default_target_language,
            ':tone_preference' => $tone_preference
        ]);
        echo "Preferences updated successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<?php
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $source_language = $_POST['source_language'];
    $target_language = $_POST['target_language'];
    $text_input = $_POST['text_input'];
    $translated_text = $_POST['translated_text'];

    try {
        $stmt = $conn->prepare("INSERT INTO translations (user_id, source_language, target_language, text_input, translated_text, translation_date) VALUES (:user_id, :source_language, :target_language, :text_input, :translated_text, NOW())");
        $stmt->execute([
            ':user_id' => $user_id,
            ':source_language' => $source_language,
            ':target_language' => $target_language,
            ':text_input' => $text_input,
            ':translated_text' => $translated_text
        ]);
        echo "Translation logged successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

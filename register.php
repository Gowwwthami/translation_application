<?php
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $preferred_language = $_POST['preferred_language'];

    try {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, preferred_language, account_created) VALUES (:name, :email, :password, :preferred_language, NOW())");
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $password,
            ':preferred_language' => $preferred_language
        ]);
        echo "User registered successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

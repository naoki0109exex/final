<?php
$dsn = 'mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1516807-final;charset=utf8mb4';
$username = 'LAA1516807';
$password = 'Pass0109';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_POST['id'];

        $stmt = $pdo->prepare("DELETE FROM painting WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header('Location: index.php'); // 一覧表示画面にリダイレクト

    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }

    $pdo = null;
} else {
    echo "Invalid request.";
}
?>

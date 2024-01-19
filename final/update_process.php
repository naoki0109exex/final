<?php
$dsn = 'mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1516807-final;charset=utf8mb4';
$username = 'LAA1516807';
$password = 'Pass0109';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_POST['id'];
        $name = $_POST['name'];
        $artist = $_POST['artist'];
        $year = $_POST['year'];
        $category = $_POST['category'];
        $image = $_POST['image'];

        $stmt = $pdo->prepare("UPDATE painting SET name = :name, artist = :artist, year = :year, category = :category, image = :image WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':artist', $artist);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':image', $image);

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

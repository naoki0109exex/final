<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Delete Painting</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Delete Painting</h1>

<?php
$dsn = 'mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1516807-final;charset=utf8mb4';
$username = 'LAA1516807';
$password = 'Pass0109';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM painting WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $painting = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($painting) {
            // 確認メッセージを表示
            echo "<p>本当に削除しますか？</p>";
            echo "<p>{$painting['name']} by {$painting['artist']}</p>";
            echo "<form action='delete_process.php' method='post'>";
            echo "<input type='hidden' name='id' value='{$painting['id']}'>";
            echo "<input type='submit' value='削除'>";
            echo "</form>";
        } else {
            echo "Invalid ID.";
        }

    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }

    $pdo = null;
} else {
    echo "Invalid request.";
}
?>

</body>
</html>

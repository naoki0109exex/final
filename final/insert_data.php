<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新しい作品を追加</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>新しい作品を追加</h1>

<?php
$dsn = 'mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1516807-final;charset=utf8mb4';
$username = 'LAA1516807';
$password = 'Pass0109';

// POST リクエストがある場合、データを挿入する
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO painting (name, artist, year, category, image) VALUES (:name, :artist, :year, :category, :image)";
        
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':artist', $artist);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':image', $image);

        // POST データを取得
        $name = $_POST['name'] ?? '';
        $artist = $_POST['artist'] ?? '';
        $year = $_POST['year'] ?? '';
        $category = $_POST['category'] ?? '';
        $image = $_POST['image'] ?? '';

        // プリペアドステートメントを実行
        $stmt->execute();

        echo "データの挿入が成功しました。";

    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }

    $pdo = null;
}

?>

<!-- フォームを表示 -->
<form action="" method="post">
    <label for="name">作品名:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="artist">アーティスト:</label>
    <input type="text" id="artist" name="artist" required><br>

    <label for="year">制作年:</label>
    <input type="text" id="year" name="year" required><br>

    <label for="category">カテゴリー:</label>
    <input type="text" id="category" name="category" required><br>

    <label for="image">画像パス:</label>
    <input type="text" id="image" name="image" required><br>

    <input type="submit" value="作品を追加">
</form>

</body>
</html>

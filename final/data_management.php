<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Data Management</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Data Management</h1>

<?php
$dsn = 'mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1516807-final;charset=utf8mb4';
$username = 'LAA1516807';
$password = 'Pass0109';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT id, name, artist, year, category, image FROM painting");
    $paintings = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Artist</th><th>Year</th><th>Category</th><th>Actions</th></tr>";

    foreach ($paintings as $painting) {
        echo "<tr>";
        echo "<td>{$painting['id']}</td>";
        echo "<td>{$painting['name']}</td>";
        echo "<td>{$painting['artist']}</td>";
        echo "<td>{$painting['year']}</td>";
        echo "<td>{$painting['category']}</td>";
        echo "<td><a href='update.php?id={$painting['id']}'>Update</a> | <a href='delete.php?id={$painting['id']}'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";

    // 新しい作品を挿入するページへのリンク
    echo "<p><a href='insert_data.php'>新しい作品を追加する</a></p>";

} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}

$pdo = null;
?>

</body>
</html>

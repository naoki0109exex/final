



<link rel="stylesheet" href="css/style.css">


<?php
$dsn = 'mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1516807-final;charset=utf8mb4';
$username = 'LAA1516807';
$password = 'Pass0109';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_GET['id'] ?? null;

    if (!$id) {
        die('Invalid ID');
    }

    $stmt = $pdo->prepare("SELECT * FROM painting WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $painting = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "<h2>{$painting['name']}</h2>";
    echo "<p>Artist: {$painting['artist']}</p>";
    echo "<p>Year: {$painting['year']}</p>";
    echo "<p>Category: {$painting['category']}</p>";
    echo "<img src='{$painting['image']}' alt='{$painting['name']}'>";

} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}

$pdo = null;
?>

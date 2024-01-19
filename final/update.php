<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Update Painting</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Update Painting</h1>

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
            // フォームを表示
            echo "<form action='update_process.php' method='post'>";
            echo "<input type='hidden' name='id' value='{$painting['id']}'>";
            echo "<label for='name'>Name:</label><input type='text' name='name' value='{$painting['name']}' required><br>";
            echo "<label for='artist'>Artist:</label><input type='text' name='artist' value='{$painting['artist']}' required><br>";
            echo "<label for='year'>Year:</label><input type='text' name='year' value='{$painting['year']}' required><br>";
            echo "<label for='category'>Category:</label><input type='text' name='category' value='{$painting['category']}' required><br>";
            echo "<label for='image'>Image Path:</label><input type='text' name='image' value='{$painting['image']}' required><br>";
            echo "<input type='submit' value='Update Painting'>";
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

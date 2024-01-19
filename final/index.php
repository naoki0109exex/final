<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Art Gallery</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>Art Gallery</h1>

    <!-- カテゴリの選択用フォーム -->
    <form method="get" action="index.php">
        <label for="category">カテゴリ選択:</label>
        <select name="category" id="category">
            <option value="">すべてのカテゴリ</option>
            <?php
            $dsn = 'mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1516807-final;charset=utf8mb4';
            $username = 'LAA1516807';
            $password = 'Pass0109';


            try {
                $pdo = new PDO($dsn, $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // カテゴリの取得
                $categoryStmt = $pdo->query("SELECT DISTINCT category FROM painting");
                $categories = $categoryStmt->fetchAll(PDO::FETCH_COLUMN);

                // カテゴリのオプションを生成
                foreach ($categories as $category) {
                    echo "<option value='{$category}'>{$category}</option>";
                }

            } catch (PDOException $e) {
                echo "エラー: " . $e->getMessage();
            }

            $pdo = null;
            ?>
        </select>
        <input type="submit" value="絞り込む">
    </form>

    <?php
    try {
                            // メニューへのリンク
                            echo "<div class='menu'>";
                            echo "<ul>";
                            echo "<li><a href='index.php'>Art Gallery</a></li>";
                            echo "<li><a href='data_management.php'>Data Management</a></li>";
                            echo "</ul>";
                            echo "</div>";
                            
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // カテゴリの絞り込み
        $categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';

        $stmt = $pdo->prepare("SELECT id, name, artist, year, category, image FROM painting 
                               WHERE (:categoryFilter = '' OR category = :categoryFilter)");
        $stmt->bindParam(':categoryFilter', $categoryFilter);
        $stmt->execute();

        $paintings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($paintings as $painting) {
            echo "<div class='art-piece'>";
            echo "<h2>{$painting['name']}</h2>";
            echo "<p>Artist: {$painting['artist']}</p>";
            echo "<p>Year: {$painting['year']}</p>";
            echo "<p>Category: {$painting['category']}</p>";
            echo "<img src='{$painting['image']}' alt='{$painting['name']}'>";
            echo "</div>";
        }



    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }

    $pdo = null;
    ?>

</div>

</body>
</html>

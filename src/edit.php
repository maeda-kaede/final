<!-- edit.php -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>選手データ編集</title>
    <a href="menu.php">メニューへ戻る</a>
</head>
<body>
    <h2>選手データ編集</h2>

    <?php
    $host = "mysql220.phy.lolipop.lan";
    $dbname = "LAA1517458-final";
    $user = "LAA1517458";
    $pass = "Pass0506";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
        die();
    }

    $playerID = $_GET['id'] ?? '';

    try {
        $sql = "SELECT * FROM player WHERE playerID = :playerID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':playerID', $playerID, PDO::PARAM_INT);
        $stmt->execute();
        $player = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching player data: " . $e->getMessage();
    }

    // 以下はフォームの部分
    ?>
    <form action="kousin.php" method="post">
        <input type="hidden" name="playerID" value="<?php echo $playerID; ?>">
        <label for="playername">名前</label>
        <input type="text" name="playername" value="<?php echo $player['playername']; ?>">
        <br>
        <label for="nationality">国籍</label>
        <input type="text" name="nationality" value="<?php echo $player['nationality']; ?>">
        <br>
        <label for="position">ポジション</label>
        <input type="text" name="position" value="<?php echo $player['position']; ?>">
        <br>
        <label for="club">クラブ</label>
        <input type="text" name="club" value="<?php echo $player['club']; ?>">
        <br>
        <input type="submit" value="更新">
    </form>
</body>
</html>

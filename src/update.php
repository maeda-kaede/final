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

// 選手データを取得
$query = "SELECT playerID, playername, nationality, position, club FROM player";
$stmt = $pdo->query($query);
$players = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>選手データ</title>
    <a href="menu.php">メニューへ戻る</a>
</head>
<body>
    <h2>選手データ</h2>
    <form action="edit.php" method="post">
        <table border="2">
            <tr>
                <th>選手ID</th>
                <th>名前</th>
                <th>国籍</th>
                <th>ポジション</th>
                <th>クラブ</th>
                <th>編集</th>
            </tr>
            <?php
            foreach ($players as $player) {
                ?>
                <tr>
                    <td><?php print($player['playerID']) ?></td>
                    <td><?php print($player['playername']) ?></td>
                    <td><?php print($player['nationality']) ?></td>
                    <td><?php print($player['position']) ?></td>
                    <td><?php print($player['club']) ?></td>
                    <td><a href="edit.php?id=<?php print($player['playerID']) ?>">更新</a></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </form>
</body>
</html>

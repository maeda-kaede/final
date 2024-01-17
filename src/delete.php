<?php
const server = "mysql220.phy.lolipop.lan";
const dbname = "LAA1517458-final";
const user = "LAA1517458";
const pass = "Pass0506";

$connect = 'mysql:host='. server . ';dbname='. dbname . ';charset=utf8';

// データベースに接続
try {
    $pdo = new PDO($connect, user, pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// データの削除がリクエストされた場合
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    // データベースからデータを削除
    $deleteID = $_POST["delete"];
    $deleteQuery = "DELETE FROM player WHERE playerID = :id";
    $deleteStmt = $pdo->prepare($deleteQuery);
    $deleteStmt->bindParam(":id", $deleteID, PDO::PARAM_INT);
    $deleteStmt->execute();
}

// データの表示
$query = "SELECT playerID, playername, nationality, position, club FROM player";
$stmt = $pdo->query($query);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player 削除</title>
    <a href="menu.php">メニューへ戻る</a>

</head>
<body>
    <h2>Player 削除</h2>

    <table border="1">
        <tr>
            <th>Player ID</th>
            <th>Name</th>
            <th>Nationality</th>
            <th>Position</th>
            <th>Club</th>
            <th>Action</th>
        </tr>
        <?php
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>{$row['playerID']}</td>";
            echo "<td>{$row['playername']}</td>";
            echo "<td>{$row['nationality']}</td>";
            echo "<td>{$row['position']}</td>";
            echo "<td>{$row['club']}</td>";
            echo "<td>";
            // 削除ボタン
            echo "<form method='post' action=''>";
            echo "<input type='hidden' name='delete' value='{$row['playerID']}'>";
            echo "<input type='submit' value='Delete'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
const server = "mysql220.phy.lolipop.lan";
const dbname = "LAA1517458-final";
const user = "LAA1517458";
const pass = "Pass0506";

$connect = 'mysql:host=' . server . ';dbname=' . dbname . ';charset=utf8';

// データベースに接続
try {
    $pdo = new PDO($connect, user, pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// フォームが送信された場合
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $playerID = $_POST["playerID"];
    $playername = $_POST["playername"]; // Corrected variable name
    $nationality = $_POST["nationality"];
    $position = $_POST["position"];
    $club = $_POST["club"];

    // データをデータベースに挿入
    $insertQuery = "INSERT INTO player (playerID, playername, nationality, position, club) VALUES (:playerID, :playername, :nationality, :position, :club)";
    $insertStmt = $pdo->prepare($insertQuery);
    $insertStmt->bindParam(":playerID", $playerID, PDO::PARAM_STR);
    $insertStmt->bindParam(":playername", $playername, PDO::PARAM_STR);
    $insertStmt->bindParam(":nationality", $nationality, PDO::PARAM_STR);
    $insertStmt->bindParam(":position", $position, PDO::PARAM_STR);
    $insertStmt->bindParam(":club", $club, PDO::PARAM_STR);
    $insertStmt->execute();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player 登録</title>
    <a href="menu.php">メニューへ戻る</a>
</head>
<body>
    <h2>Player 登録</h2>

    <form method="post" action="">
        <label for="playerID">ID:</label>
        <input type="text" id="playerID" name="playerID" required><br>

        <label for="playername">Name:</label>
        <input type="text" id="playername" name="playername" required><br>

        <label for="nationality">Nationality:</label>
        <input type="text" id="nationality" name="nationality" required><br>

        <label for="position">Position:</label>
        <input type="text" id="position" name="position" required><br>

        <label for="club">Club:</label>
        <input type="text" id="club" name="club" required><br>

        <input type="submit" value="登録">
    </form>
</body>
</html>

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
    $name = $_POST["name"];
    $nationality = $_POST["nationality"];
    $position = $_POST["position"];
    $club = $_POST["club"];

    // データをデータベースに挿入
    $insertQuery = "INSERT INTO player (playerID, name, nationality, position, club) VALUES (:playerID, :name, :nationality, :position, :club)";
    $insertStmt = $pdo->prepare($insertQuery);
    $insertStmt->bindParam(":playerID", $playerID, PDO::PARAM_STR); // 修正
    $insertStmt->bindParam(":name", $name, PDO::PARAM_STR);
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
    <title>Player Registration</title>
    <a href="menu.php">メニューへ戻る</a>
</head>
<body>
    <h2>Player Registration</h2>

    <form method="post" action="">
        <label for="playerID">ID:</label>
        <input type="text" id="playerID" name="playerID" required><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="nationality">Nationality:</label>
        <input type="text" id="nationality" name="nationality" required><br>

        <label for="position">Position:</label>
        <input type="text" id="position" name="position" required><br>

        <label for="club">Club:</label>
        <input type="text" id="club" name="club" required><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>

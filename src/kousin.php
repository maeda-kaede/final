<!-- kousin.php -->

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $playerID = $_POST["playerID"];
    $playername = $_POST["playername"];
    $nationality = $_POST["nationality"];
    $position = $_POST["position"];
    $club = $_POST["club"];

    $updateQuery = "UPDATE player SET playername = :playername, nationality = :nationality, position = :position, club = :club WHERE playerID = :playerID";
    $updateStmt = $pdo->prepare($updateQuery);
    $updateStmt->bindParam(":playerID", $playerID, PDO::PARAM_INT);
    $updateStmt->bindParam(":playername", $playername, PDO::PARAM_STR);
    $updateStmt->bindParam(":nationality", $nationality, PDO::PARAM_STR);
    $updateStmt->bindParam(":position", $position, PDO::PARAM_STR);
    $updateStmt->bindParam(":club", $club, PDO::PARAM_STR);

    try {
        $updateStmt->execute();
        echo "選手情報が更新されました。 <a href='menu.php'>メニューへ戻る</a>";
    } catch (PDOException $e) {
        echo "Error updating player: " . $e->getMessage();
    }
}
?>

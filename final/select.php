<?php
const server = "mysql220.phy.lolipop.lan";
const dbname = "LAA1517458-final";
const user = "LAA1517458";
const pass = "Pass0506";

$connect = 'mysql:host='. server . ';dbname='. dbname . ';charset=utf8';

try {
    $pdo = new PDO($connect, user, pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT playerID, name, nationality, position, club FROM player";
    $stmt = $pdo->query($query);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Data</title>
    <a href="menu.php">メニューへ戻る</a>
</head>
<body>
    <h2>Player Data</h2>

    <table border="2">
        <tr>
            <th>Player ID</th>
            <th>Name</th>
            <th>Nationality</th>
            <th>Position</th>
            <th>Club</th>
        </tr>
        <?php
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>{$row['playerID']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['nationality']}</td>";
            echo "<td>{$row['position']}</td>";
            echo "<td>{$row['club']}</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>

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

// データベースから全データを取得
$selectQuery = "SELECT * FROM player";
$selectStmt = $pdo->prepare($selectQuery);
$selectStmt->execute();
$players = $selectStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player List</title>
</head>
<body>
    <h2>Player List</h2>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Nationality</th>
                <th>Position</th>
                <th>Club</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($players as $player): ?>
                <tr>
                    <td><?php echo $player["playerID"]; ?></td>
                    <td><?php echo $player["name"]; ?></td>
                    <td><?php echo $player["nationality"]; ?></td>
                    <td><?php echo $player["position"]; ?></td>
                    <td><?php echo $player["club"]; ?></td>
                    <td>
                        <a href="edit.php?edit=<?php echo $player["playerID"]; ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

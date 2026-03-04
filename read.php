<?php
require 'db.php';
$stmt = $pdo->query("SELECT * FROM transactions ORDER BY id ASC");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="read-page">
    <div class="list-container">
        <div class="top-bar">
            <h1 style="margin:0;">Transaction List</h1>
            <a href="index.php" class="btn-add">+ Add New</a>
        </div>

        <?php if (count($rows) === 0): ?>
            <p style="text-align:center; margin-top:20px;">No transactions found.</p>
        <?php else: ?>
        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item</th>
                        <th>Price (₱)</th>
                        <th>Qty</th>
                        <th>Total (₱)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['item']) ?></td>
                        <td><?= number_format($row['price'], 2) ?></td>
                        <td><?= $row['qty'] ?></td>
                        <td><?= number_format($row['total'], 2) ?></td>
                        <td class="action-links">
                            <a href="update.php?id=<?= $row['id'] ?>">Edit</a> |
                            <a href="delete.php?id=<?= $row['id'] ?>"
                               onclick="return confirm('Delete this record?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
<?php
require 'db.php';
require 'functions.php';

$id = $_GET['id'] ?? null;
if (!$id) redirectTo("read.php");

$stmt = $pdo->prepare("SELECT * FROM transactions WHERE id = :id");
$stmt->execute([':id' => $id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) redirectTo("read.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item  = trim($_POST['item']);
    $price = $_POST['price'];
    $qty   = $_POST['qty'];

    if (!validateNumber($price) || !validateNumber($qty)) {
        $error = "Price and Quantity must be greater than zero.";
    } else {
        $total = computeTotal($price, $qty);

        $sql  = "UPDATE transactions
                 SET item=:item, price=:price, qty=:qty, total=:total
                 WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':item'  => $item,
            ':price' => $price,
            ':qty'   => $qty,
            ':total' => $total,
            ':id'    => $id
        ]);

        redirectTo("read.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Transaction</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Edit Transaction</h1>

    <?php if ($error): ?>
        <p class="error-msg"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <fieldset>
        <legend>Update Entry</legend>
        <form method="post">
            <label for="item">Item Name</label>
            <input type="text" id="item" name="item"
                   value="<?= htmlspecialchars($data['item']) ?>" required>

            <label for="price">Price (₱)</label>
            <input type="number" id="price" name="price" step="0.01"
                   value="<?= $data['price'] ?>" required>

            <label for="qty">Quantity</label>
            <input type="number" id="qty" name="qty"
                   value="<?= $data['qty'] ?>" required>

            <input type="submit" value="Update Transaction">
            <div style="text-align: left; margin-top: 15px;">
                <a href="read.php" class="view-link" style="font-size: 18px;">← Back to List</a>
            </div>
        </form>
    </fieldset>
</div>
</body>
</html>
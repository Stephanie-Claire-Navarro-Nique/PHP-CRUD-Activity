<?php
require 'db.php';
require 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item  = trim($_POST['item']);
    $price = $_POST['price'];
    $qty   = $_POST['qty'];

    if (!validateNumber($price) || !validateNumber($qty)) {
        redirectTo("index.php?error=Price+and+Quantity+must+be+greater+than+zero.");
    }

    $total = computeTotal($price, $qty);

    $sql  = "INSERT INTO transactions (item, price, qty, total)
             VALUES (:item, :price, :qty, :total)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':item'  => $item,
        ':price' => $price,
        ':qty'   => $qty,
        ':total' => $total
    ]);

    redirectTo("read.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transaction</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Sample Transaction System</h1>

    <?php if (!empty($_GET['error'])): ?>
        <p class="error-msg"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <fieldset>
        <legend>New Entry</legend>
        <form method="post" action="create.php">
            <label for="item">Item Name</label>
            <input type="text" id="item" name="item"
                   placeholder="e.g. Notebook" required>

            <label for="price">Price (₱)</label>
            <input type="number" id="price" name="price"
                   step="0.01" placeholder="How much?" required>

            <label for="qty">Quantity</label>
            <input type="number" id="qty" name="qty"
                   placeholder="How many?" required>

            <input type="submit" value="Save Transaction">
            
            <div style="text-align: right; margin-top: 15px;">
                <a href="read.php" class="view-link" style="font-size: 18px;">View Transactions →</a>
            </div>
        </form>
    </fieldset>
</div>
</body>
</html>
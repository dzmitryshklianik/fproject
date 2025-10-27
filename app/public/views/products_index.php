<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Products</title>
</head>
<body>
<h1>Products</h1>
<?php foreach ($products as $product): ?>
    <h2><?= htmlspecialchars($product['name']) ?></h2>
    <p><?= htmlspecialchars($product['description']) ?></p>
<?php endforeach; ?>
<a href="/show.php">sss</a>
</body>
</html>
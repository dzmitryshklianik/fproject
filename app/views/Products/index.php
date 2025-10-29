<h1>Products</h1>
<?php foreach ($products as $product): ?>
    <a href="/products/<?= $product['id']?>/show"><h2><?= htmlspecialchars($product['name']) ?></h2></a>
<?php endforeach; ?>
<a href="/show.php">sss</a>
</body>
</html>
<h1>Products</h1>

<a href="/products/new">New Product</a>

<p> Total: <?= $total ?></p>



<?php foreach ($products as $product): ?>
    <a href="/products/<?= $product['id']?>/show">
        <h2><?= htmlspecialchars($product['name']) ?></h2>
    </a>
<?php endforeach; ?>
</body>
</html>
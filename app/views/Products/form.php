<label for="name">Product Name</label>
<input type="text" name="name" id="name" value="<?= $product["name"] ?? "" ?>" placeholder="Product Name">

<?php if (isset($errors['name'])) : ?>
    <p class="error"><?=$errors['name']?></p>
<?php endif;?>

<label for="description">Description</label>
<textarea name="description" id="description"  placeholder="Description"><?= $product["description"] ?? "" ?></textarea>

<button type="submit">Save</button>
<?php



class Products
{
    public function actionIndex()
    {
        require "src/models/product.php";

        $model = new Product();

        $products = $model->getData();

        require "views/products_index.php";
    }

    public function show()
    {
        require "src/views/product_show.php";
        
    }
}

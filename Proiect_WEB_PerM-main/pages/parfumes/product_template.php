<?php

    include_once '../../api/config/config.php';
    include_once "../../api/repository/ProductRepository.php";

    function getProductByName($name){

        $productRepository = new ProductRepository();
        $product = $productRepository -> getProductByInfoUrl($name);

        echo '<div itemscope itemtype="https://schema.org/Product">
            <div class="product-container">
                <a href="https://web-perm.herokuapp.com/pages/product_page/'.$product->getInfoUrl().'_page.php">
                    <div class="product__img">
                        <img width="300" height="320" itemprop="image" alt="perfume_image" src="https://web-perm.herokuapp.com/img/parfumes/'.$product->getInfoUrl().'.webp">
                    </div>
                </a>
                <div class="product__description">
                    <div class="product__info">
                        <div itemprop="name" class="product__info--name">'.$product->getName().'</div>
                        <div itemprop="price" class="product__info--old_price">'.$product->getOldPrice().' lei</div>
                        <div itemprop="price" class="product__info--new_price">'.$product->getNewPrice().' lei</div>
                    </div>
                </div>
            </div>
        </div>';
    }  

?>
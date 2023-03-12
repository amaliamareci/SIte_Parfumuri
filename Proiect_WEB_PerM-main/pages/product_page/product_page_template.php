<?php 

    include_once '../parfumes/product_template.php';
    include_once "../../api/repository/ProductRepository.php";

    function getProductPageByName($name){

        $productRepository = new ProductRepository();
        
        $product = $productRepository -> getProductByInfoUrl($name);
        $ingredients = $productRepository -> getIngredientsByInfoUrl($name);
        $recommended_array = $productRepository -> getRecommendedPerfumesForProductPage($name);;

        $description = sprintf('../../descriptions/%s.html', $product->getInfoUrl());

        echo '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="description" content="Site parfumuri">
                <title>Perfume</title>
                <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/styles.css">
                <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/product.css">
                <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/products.css">
                <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/heart.css">
                <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/comment.css">
            </head>
            <body>
                ';
            include_once "../header.php";
            echo '
                <div itemscope itemtype="https://schema.org/Product">
                    <div class="single-product-container">
                        <div class="single-product__image">
                            <img width="400" height="450" itemprop="image" alt="perfume image" src="https://web-perm.herokuapp.com/img/parfumes/'.$product->getInfoUrl().'.webp">
                        </div>
                        <div class="single-product__info">
                            <div itemprop="name" class="single-product__info--name">'.$product->getName().'</div>
                            <div itemprop="price" class="single-product__info--old_price">'.$product->getOldPrice().' lei</div>
                            <div itemprop="price" class="single-product__info--new_price">'.$product->getNewPrice().' lei</div>
                            
                            <form id="addProductToCartForm" class="add-product" method="POST">
                                <input id="cart__product" value="'.$product->getInfoUrl().'" style="display: none;" readonly>
                                <input id="cart__quantity" aria-label="cantitate" type="number" value="1" min="1">
                                <button type="submit">Adauga in cos</button>
                            </form>

                            <h3>Stocul curent al produsului: <span id="cart__stock">'.$product->getStock().'</span></h3>
                            <span id="error__stock"></span>

                            <div class="heart__box">
                                <button aria-label="favorite" style="text-decoration:none; border:none; background-color: white; padding:0; font-size: 1.2em;">
                                    <span id="button_action" class="fav-btn">
                                        <i id="'.$product->getInfoUrl().'" class="favme fa-solid fa-heart"></i>
                                    </span>
                                </button>
                            </div>

                        <div class="tags">
                            <form action="https://web-perm.herokuapp.com/pages/products/search.php" method="get">
                                <input type="text" value="'.$product->getManufacturer().'" name="search" style="display:none">
                                <button class="tag tag--color-primary" type="submit" style="border:none; padding:.7em; cursor:pointer">#'.$product->getManufacturer().'</button>
                            </form>
                            <form action="https://web-perm.herokuapp.com/pages/products/search.php" method="get">
                                <input type="text" value="'.$product->getGender().'" name="search" style="display:none">
                                <button class="tag tag--color-darker" type="submit" style="border:none; padding:.7em; cursor:pointer">#'.$product->getGender().'</button>
                            </form>
                            <form action="https://web-perm.herokuapp.com/pages/products/search.php" method="get">
                                <input type="text" value="'.$product->getType().'" name="search" style="display:none">
                                <button class="tag tag--color-secondary" type="submit" style="border:none; padding:.7em; cursor:pointer">#'.$product->getType().'</button>
                            </form>
                            <form action="https://web-perm.herokuapp.com/pages/products/search.php" method="get">
                                <input type="text" value="'.$product->getCategory().'" name="search" style="display:none">
                                <button class="tag tag--color-primary" type="submit" style="border:none; padding:.7em; cursor:pointer">#'.$product->getCategory().'</button>
                            </form>
                        </div>

                        </div>
                    </div>

                    <div itemprop="description" class="description">
                        <h2>Descriere</h2>';
                    include_once $description;
                    echo '
                        <br>

                        <h2>Detalii</h2>

                        <table>
                            <tr>
                                <th>Tip produs</th>
                                <td>'.$product->getType().'</td>
                            </tr>
                            <tr>
                                <th>Categorie olfactiva</th>
                                <td>'.$product->getCategory().'</td>
                            </tr>
                            <tr>
                                <th>Cantitate</th>
                                <td>'.$product->getQuantity().' ml</td>
                            </tr>
                            <tr>
                                <th>Ingrediente</th>
                                <td>'.$ingredients[0].'</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="similar">
                    <h2>Produse similare</h2>
                    <div class="products-grid">
                ';
                    getProductByName($recommended_array[0]);
                    getProductByName($recommended_array[1]);
                    getProductByName($recommended_array[2]);
                echo '
                    </div>
                </div>
                <div class="comment">
                <h2>Comentarii</h2>

                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <div class="comment">
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <textarea class="input" placeholder="Write a comment"></textarea>
                            <button class="primaryContained float-right" type="submit">Add Comment</button>
                        </div>
                    </div>
                </div>
                  
                </div>
                ';
                include_once "../footer.html";
                echo'
                <script src="https://web-perm.herokuapp.com/javascript/sidenav.js"></script>
                <script src="https://web-perm.herokuapp.com/javascript/add_to_cart.js"></script>
                <script src="https://web-perm.herokuapp.com/javascript/check_user.js"></script>
                <script src="https://web-perm.herokuapp.com/javascript/product_heart.js"></script>
                <script src="https://kit.fontawesome.com/0f47dad504.js" crossorigin="anonymous"></script>
            </body>
            </html>';
    }

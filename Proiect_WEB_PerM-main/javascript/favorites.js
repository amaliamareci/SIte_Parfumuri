
function getFavoriteProducts() {

    const token = localStorage.getItem('token');

    const Url = "https://web-perm.herokuapp.com/api/v1/pages/favorites.php";

    const params = {
        headers: {
            Authorization: `Bearer ${token}`
        },
        method: 'PUT',
        body: JSON.stringify(localStorage.getItem('user'))
    }

    fetch(Url, params)
        .then(function (data) {
            return data.json();
        }).then(function (res) {

            for (let i = 0; i < res.length; i++) {
                document.getElementById('favorite_products_container').innerHTML += '\
                    <div itemscope itemtype="https://schema.org/Product">\
                        <div class="product-container" >\
                            <a href="https://web-perm.herokuapp.com/pages/product_page/'+ res[i][0] + '_page.php">\
                                <div class="product__img">\
                                    <img itemprop="image" src="https://web-perm.herokuapp.com/img/parfumes/'+ res[i][0] + '.webp">\
                                </div>\
                            </a>\
                            <div class="product__description">\
                                <div class="product__info">\
                                    <div itemprop="name" class="product__info--name">'+ res[i][3] + '</div>\
                                    <div itemprop="price" class="product__info--old_price">'+ res[i][2] + ' lei</div>\
                                    <div itemprop="price" class="product__info--new_price">'+ res[i][1] + ' lei</div>\
                                </div>\
                            </div>\
                        </div >\
                    </div > ';
            }

        });

}


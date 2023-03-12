var shippingRate = 15.00;
var fadeTime = 300;

function getProducts() {

    const token = localStorage.getItem('token');

    const Url = "https://web-perm.herokuapp.com/api/v1/pages/products.php";

    const params = {
        headers: {
            Authorization: `Bearer ${token}`
        },
        method: 'PUT',
        body: JSON.stringify(localStorage.getItem('user'))
    };

    fetch(Url, params)
        .then(function (data) {
            return data.json();
        }).then(function (res) {
            subtotal = 0;
            const root = document.getElementById("add_products");

            for (let i = 0; i < res.length; i++) {
                currentPrice = res[i][4] * res[i][1];
                subtotal += currentPrice;
                /*document.getElementById("add_products").innerHTML +=
                    "<div class='product'> \
                        <div class='product-image'> \
                            <img src='https://web-perm.herokuapp.com/img/parfumes/" + res[i][0] + ".jpg'> \
                        </div> \
                        \
                        <div class='product-details'> \
                            <div class='product-title'>" + res[i][3] + "</div> \
                            <p class='product-description'>" + res[i][2] + "</p> \
                            <p class='product-stock'>" + res[i][5] + "</p> \
                        </div> \
                        \
                        <div class='product-price'>" + res[i][1] + "</div> \
                        \
                        <div class='product-quantity'> \
                            <input type='number' value='" + res[i][4] + "' min='1'> \
                        </div> \
                        \
                        <div class='product-removal'> \
                            <button id='" + res[i][0] + "' class='remove-product'>Sterge</button> \
                        </div> \
                        <div class='product-line-price'>"+ currentPrice + "</div> \
                    </div>";*/

                // product
                const product = document.createElement("div");
                product.setAttribute("class", "product");

                // product image
                const productImage = document.createElement("div");
                productImage.setAttribute("class", "product-image");

                const img = document.createElement("img");
                img.setAttribute("alt", "parfume image");
                img.setAttribute("src", "https://web-perm.herokuapp.com/img/parfumes/" + res[i][0] + ".webp");

                productImage.appendChild(img);

                // product details
                const productDetails = document.createElement("div");
                productDetails.setAttribute("class", "product-details");

                const productTitle = document.createElement("div");
                productTitle.setAttribute("class", "product-title");
                productTitle.appendChild(document.createTextNode(res[i][3]));

                const productDescription = document.createElement("p");
                productDescription.setAttribute("class", "product-description");
                productDescription.appendChild(document.createTextNode(res[i][2]));

                const productStock = document.createElement("p");
                productStock.setAttribute("class", "product-stock");
                productStock.appendChild(document.createTextNode("Stocul produsului: " + res[i][5]));

                productDetails.appendChild(productTitle);
                productDetails.appendChild(productDescription);
                productDetails.appendChild(productStock);

                // product price
                const productPrice = document.createElement("div");
                productPrice.setAttribute("class", "product-price");
                productPrice.appendChild(document.createTextNode(res[i][1]));

                // product quantity
                const productQuantity = document.createElement("div");
                productQuantity.setAttribute("class", "product-quantity");

                const inputQuantity = document.createElement("input");
                inputQuantity.setAttribute("type", "number");
                inputQuantity.setAttribute("value", res[i][4]);
                inputQuantity.setAttribute("min", 1);

                productQuantity.appendChild(inputQuantity);

                // product removal

                const productRemoval = document.createElement("div");
                productRemoval.setAttribute("class", "product-removal");

                const buttonRemoval = document.createElement("button");
                buttonRemoval.setAttribute("id", res[i][0]);
                buttonRemoval.setAttribute("class", "remove-product");
                buttonRemoval.appendChild(document.createTextNode("Sterge"));

                productRemoval.appendChild(buttonRemoval);

                // product total price 

                const productTotal = document.createElement("div");
                productTotal.setAttribute("class", "product-line-price");
                productTotal.appendChild(document.createTextNode(currentPrice));

                // add elements to root

                product.appendChild(productImage);
                product.appendChild(productDetails);
                product.appendChild(productPrice);
                product.appendChild(productQuantity);
                product.appendChild(productRemoval);
                product.appendChild(productTotal);

                root.appendChild(product);

                //

                buttonRemoval.addEventListener('click', () => {
                    console.log('remove button :) ' + res[i][0]);

                    product.style.display = "none";
                    subtotal -= res[i][4] * res[i][1];
                    document.getElementById("cart-subtotal").innerHTML = subtotal;
                    document.getElementById("cart-total").innerHTML = subtotal + 14.99;

                    const token = localStorage.getItem('token');

                    const Url = "https://web-perm.herokuapp.com/api/v1/pages/products.php";

                    const Data = {
                        username: localStorage.getItem('user'),
                        product: res[i][0]
                    };

                    const params = {
                        headers: {
                            Authorization: `Bearer ${token}`
                        },
                        body: JSON.stringify(Data),
                        method: "DELETE"
                    };

                    fetch(Url, params)
                        .then(function (data) {
                            return data;
                        }).then(function (res) {
                            console.log(res);
                        });
                });

            }

            console.log(root);

            document.getElementById("cart-subtotal").innerHTML = subtotal;
            document.getElementById("cart-total").innerHTML = subtotal + 14.99;

        }).catch((error) => {
            console.log('Unauthorized');
        });

}

document.getElementById("checkoutButton").addEventListener('click', () => {
    document.getElementById("error__cart--stock").innerHTML = "";

    const token = localStorage.getItem('token');

    const Url = "https://web-perm.herokuapp.com/api/v1/pages/products.php";

    const params = {
        headers: {
            Authorization: `Bearer ${token}`
        },
        method: 'PUT',
        body: JSON.stringify(localStorage.getItem('user'))
    };

    fetch(Url, params)
        .then(function (data) {
            return data.json();
        }).then(function (res) {
            var canCheckout = 1;

            for (let i = 0; i < res.length; i++) {
                if (res[i][4] > res[i][5]) {
                    canCheckout = 0;
                    break;
                }
            }

            if (canCheckout == 0) {
                console.log("stoc insuficient");
                document.getElementById("error__cart--stock").innerHTML = "Stoc insuficient!";
            } else {
                console.log("stoc ok");
                document.getElementById("error__cart--stock").innerHTML = "";
                window.location.href = "https://web-perm.herokuapp.com/pages/checkout/checkout.php";
            }
        });

});

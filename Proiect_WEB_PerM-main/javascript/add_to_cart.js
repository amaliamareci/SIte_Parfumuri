document.addEventListener("DOMContentLoaded", () => {
    const cartForm = document.querySelector("#addProductToCartForm");

    cartForm.addEventListener("submit", e => {
        e.preventDefault();

        const token = localStorage.getItem('token');
        var productName = document.getElementById("cart__product").value;
        var productQuantity = document.getElementById("cart__quantity").value;
        var productStock = document.getElementById("cart__stock").innerHTML;

        console.log(localStorage.getItem('user'));
        console.log(productName);
        console.log(productQuantity);
        console.log(productStock);
        console.log(productStock - productQuantity);

        const Data = {
            username: localStorage.getItem('user'),
            product: productName,
            quantity: productQuantity
        }

        if(productStock - productQuantity < 0) {
            document.getElementById("error__stock").innerHTML = "Stoc insuficient!";
        } else {
            document.getElementById("error__stock").innerHTML = "";

            const Url = "https://web-perm.herokuapp.com/api/v1/pages/products.php";

            console.log(`Bearer ${token}`);

            const params = {
                headers: {
                    Authorization: `Bearer ${token}`
                },
                body: JSON.stringify(Data),
                method: "POST"
            }

            fetch(Url, params)
                .then(function (data) {
                    return data;
                }).then(function (res) {
                    console.log(res);
                });
        }

    });

});

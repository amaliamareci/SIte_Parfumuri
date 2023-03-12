document.addEventListener("DOMContentLoaded", () => {
    const insertForm = document.querySelector("#insert_product_form");

    insertForm.addEventListener("submit", e => {
        e.preventDefault();

        var name = document.getElementById("name").value;
        var manufacturer = document.getElementById("manufacturer").value;
        var stock = document.getElementById("stock").value;
        var new_price = document.getElementById("new_price").value;
        var old_price = document.getElementById("old_price").value;
        var category = document.getElementById("category").value;
        var quantity = document.getElementById("quantity").value;
        var gender;
        if (document.querySelectorAll('input[name="femei"]')[0].checked)
            gender = 'femeie';
        else if (document.querySelectorAll('input[name="barbati"]')[0].checked)
            gender = 'barbati';
        else if (document.querySelectorAll('input[name="copii"]')[0].checked)
            gender = 'copii';
        var type = document.getElementById("type").value;
        var info_url = document.getElementById("info_url").value;
        var realease_date = document.getElementById("realease_date").value;
        var ingredients = document.getElementById("ingredients").value;
        var photo = document.getElementById("photo").value;
        var description = document.getElementById("description").value;


        const token = localStorage.getItem('token');

        const Url = "https://web-perm.herokuapp.com/api/v1/pages/products.php";
       
        const Data = {
            name: name,
            manufacturer: manufacturer,
            stock: stock,
            new_price: new_price,
            old_price: old_price,
            category: category,
            quantity: quantity,
            gender: gender,
            type: type,
            info_url: info_url,
            realease_date: realease_date,
            ingredients: ingredients,
            photo: photo,
            description: description

        };
        
        const params = {
            headers: {
                Authorization: `Bearer ${token}`
            },
            method: 'PATCH',
            body: JSON.stringify(Data)
        };
    

        fetch(Url, params);
         
    });
});
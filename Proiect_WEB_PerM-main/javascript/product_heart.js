
var token = localStorage.getItem('token');

var Url = "https://web-perm.herokuapp.com/api/v1/pages/favorites.php";

const data = {
    user: localStorage.getItem('user'),
    product: document.querySelector('.favme').id
};

const params = {
    headers: {
        Authorization: `Bearer ${token}`
    },
    method: 'PATCH',
    body: JSON.stringify(data)
};

var checked;
    
getData();
   
async function getData() {
    let result;

        result = await fetch(Url, params).then(function (data) {
            return data.json();
        }).catch((error) => {
            console.log('Unauthorized');
        });
    checked = result;

    if (checked == 1) {
        document.querySelector('.favme').style.color = "red";
    }
}

document.getElementById('button_action').addEventListener("click", () => {
    var t = document.querySelector('.favme').id;
    if (checked == 0) {
        checked = 1;

        document.querySelector('.favme').style.color = "red";

        const data = {
            user: localStorage.getItem('user'),
            product: document.querySelector('.favme').id
        }

        const params = {
            headers: {
                Authorization: `Bearer ${token}`
            },
            method: 'POST',
            body: JSON.stringify(data)
        };

        fetch(Url, params);
    }
    else {
        checked = 0;

        document.querySelector('.favme').style.color = "#CBCDCE";

        const data = {
            user: localStorage.getItem('user'),
            product: document.querySelector('.favme').id
        }

        const params = {
            headers: {
                Authorization: `Bearer ${token}`
            },
            method: 'DELETE',
            body: JSON.stringify(data)
        };

        fetch(Url, params);
    }
});
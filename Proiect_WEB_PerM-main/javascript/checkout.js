
document.querySelector('.btn').addEventListener("click", () => {
    const token = localStorage.getItem('token');
    const params = {
        headers: {
            Authorization: `Bearer ${token}`
        },
        method: 'POST',
        body: JSON.stringify(localStorage.getItem('user'))
    };
    fetch("https://web-perm.herokuapp.com/api/v1/pages/checkout.php", params);
});

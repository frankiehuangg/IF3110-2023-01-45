const register = async (event) => {
    event.preventDefault();

    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirm_password = document.getElementById('confirm-password').value;

    const data = {
        username: username,
        email: email,
        password: password,
        confirm_password: confirm_password
    }

    const lib = new Lib();
    const response = await lib.post('/api/auth/register', data);
    console.log(response);
    const json = JSON.parse(response);

    if (json.success) {
        console.log("Successfully registered and logged in");
        window.location.assign('http://localhost:8008/');
    } else {
        console.log("register failed");
        alert(json.message);
        window.location.reload();
    }
}
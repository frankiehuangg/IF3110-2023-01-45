const login = async (event) => {
    event.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    const data = {
        username: username,
        password: password
    }

    const lib = new Lib();
    const response = await lib.post('/api/auth/login', data);
    console.log(response);
    const json = JSON.parse(response);

    if (json.success) {
        console.log("Successfully logged in");
        window.location.assign('http://localhost:8008/');
    } else {
        console.log("login failed");
        alert(json.message);
        window.location.reload();
    }
}
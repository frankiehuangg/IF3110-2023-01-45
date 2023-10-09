const logout = async (event) => {
    event.preventDefault();

    console.log('haha');

    const lib = new Lib();
    const response = await lib.post('/api/auth/logout');
    console.log(response);
    const json = JSON.parse(response);

    if (json.success) {
        console.log("Successfully logged out");
        window.location.assign('http://localhost:8008/login');
    } else {
        console.log("logout failed");
        alert(json.message);
        // window.location.reload();
    }
}
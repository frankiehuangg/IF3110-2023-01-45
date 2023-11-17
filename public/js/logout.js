const logout = async (event) => {
    event.preventDefault();

    const lib = new Lib();
    const response = await lib.post('/api/auth/logout');
    console.log(response);
    const json = JSON.parse(response);

    if (json.success) {
        console.log("Successfully logged out");
        window.location.assign('/login');
    } else {
        console.log("logout failed");
        alert(json.message);
        // window.location.reload();
    }
}

const login = async(event) => {
    event.preventDefault();

    window.location.assign('/login');
}
const resetPassword = async (event) => {
    event.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirm_password = document.getElementById('confirm-password').value;

    const data = {
        email: email,
        password: password,
        confirm_password: confirm_password
    }

    const lib = new Lib();
    const response = await lib.patch('/api/auth/forget-password', data);
    const json = JSON.parse(response);

    if (json.success) {
        console.log("Successfully reset password");
        window.location.assign('http://localhost:8008/login');
    } else {
        console.log("reset password failed");
        alert(json.message);
        window.location.reload();
    }
}
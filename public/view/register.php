<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/public/styles/auth/login.css">
    <title>Register</title>
</head>
<body>
    <div class="background">
        <div class="centerContainer">
            <img src="https://logos-download.com/wp-content/uploads/2016/02/Twitter_Logo_new.png" width="20%"></img>
            <div class="dataInputContainer">
                <header class="dataInputHeader">
                    <h1>Register</h1>
                </header>
                <form class="loginForm" onsubmit="register(event)">
                    <div class="inputGroup">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username">
                    </div>
                    <div class="inputGroup">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email">
                    </div>
                    <div class="inputGroup">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="inputGroup">
                        <label for="password">Confirm Password</label>
                        <input type="password" name="confirm-password" id="confirm-password">
                    </div>
                    <button type="submit">Register Account</button>
                </form>
            </div>
        </div>
    </div>

    <script defer async src="/public/js/register.js"></script>
    <script defer async src="/public/js/lib.js"></script>
</body>
</html>
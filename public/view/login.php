<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/public/styles/auth/login.css">
    <title>Login</title>
</head>
<body>
    <div class="background">
        <div class="centerContainer">
            <img src="https://logos-download.com/wp-content/uploads/2016/02/Twitter_Logo_new.png" width="20%"></img>
            <div class="dataInputContainer">
                <header class="dataInputHeader">
                    <h1>Login</h1>
                </header>
                <form class="loginForm" onsubmit="login(event)">
                    <div class="inputGroup">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username">
                    </div>
                    <div class="inputGroup">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password">
                        <p>forgot your password? click <a href="/public/view/register.php">here</a></p>
                    </div>
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script defer async src="/public/js/login.js"></script>
    <script defer async src="/public/js/lib.js"></script>
</body>
</html>
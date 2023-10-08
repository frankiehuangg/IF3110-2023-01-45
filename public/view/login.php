<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/public/styles/auth/auth.css">
    <link rel="stylesheet" type="text/css" href="/public/styles/auth/login.css">
    <title>Login</title>
</head>
<body>
    <div class="background">
        <div class="centerContainer">
            <img src="https://news.topusainsights.com/wp-content/uploads/2023/07/twitter-x-logo.jpg" width="20%"></img>
            <div class="dataInputContainer">
                <header class="dataInputHeader">
                    <h1>Login</h1>
                </header>
                <form class="Form" onsubmit="login(event)">
                    <div class="inputGroup">
                        <input type="text" name="username" id="username" placeholder="Username">
                    </div>
                    <div class="inputGroup">
                        <input type="password" name="password" id="password" placeholder="Password">
                        <p class="subtext"><a href="http://localhost:8008/forget-pass">Forgot Password?</a></p>
                    </div>
                    <button type="submit" class="submitButton">Login</button>
                    <div class="inputGroup">
                        <p class="register">Don't have an account? <a href="http://localhost:8008/register">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script defer async src="/public/js/login.js"></script>
    <script defer async src="/public/js/lib.js"></script>
</body>
</html>
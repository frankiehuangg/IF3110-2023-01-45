<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/public/styles/auth/auth.css">
    <link rel="stylesheet" type="text/css" href="/public/styles/auth/forget-password.css">
    <title>Reset Password</title>
</head>
<body>
    <div class="background">
        <div class="centerContainer">
            <img src="https://logos-download.com/wp-content/uploads/2016/02/Twitter_Logo_new.png" width="20%"></img>
            <div class="dataInputContainer">
                <header class="dataInputHeader">
                    <h1>Reset Password</h1>
                </header>
                <form class="Form" onsubmit="resetPassword(event)">
                    <div class="inputGroup">
                        <input type="email" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="inputGroup">
                        <input type="password" name="password" id="password" placeholder="New Password">
                    </div>
                    <div class="inputGroup">
                        <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password">
                    </div>
                    <button type="submit" class="submitButton">Reset</button>
                    <div class="inputGroup">
                        <p class="subtext"><a href="http://localhost:8008/login">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script defer async src="/public/js/reset-password.js"></script>
    <script defer async src="/public/js/lib.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/public/styles/auth/auth.css">
    <link rel="stylesheet" type="text/css" href="/public/styles/auth/register.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Register</title>
</head>
<body>
    <div class="background">
        <div class="centerContainer">
            <i class="fa-brands fa-x-twitter"></i>
            <div class="dataInputContainer">
                <header class="dataInputHeader">
                    <h1>Register</h1>
                </header>
                <form class="Form" onsubmit="register(event)">
                    <div class="inputGroup">
                        <input type="text" name="username" id="username" placeholder="Username">
                    </div>
                    <div class="inputGroup">
                        <input type="email" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="inputGroup">
                        <input type="password" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="inputGroup">
                        <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password">
                    </div>
                    <button type="submit" class="submitButton">Register</button>
                    <div class="inputGroup">
                        <p class="subtext">Already have an account? <a href="/login">login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script defer async src="/public/js/register.js"></script>
    <script defer async src="/public/js/lib.js"></script>
</body>
</html>
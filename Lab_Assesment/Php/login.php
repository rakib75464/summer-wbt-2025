<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css"/>
</head>
<body>
     <div class="container">
        <header>
            <img src="../Image/circle-line-simple-design-logo-600nw-2174926871.webp" alt="">
            <h1>xCompany</h1>
            <nav>
                <a href="../rakib.php">Home</a> | <a href="../login.php">Login</a> | <a href="../reg.php">Registration</a>
            </nav>
        </header>

        <div class="login-form">
            <h2>LOGIN</h2>
            <form action="#" method="post">
                <label for="username">User Name :</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password :</label>
                <input type="password" id="password" name="password" required>

                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember Me</label>
                </div>

                <button type="button" onclick="window.location.href='dashboard.php'">Submit</button>
                <a href="Forget.php">Forgot Password?</a>
            </form>
        </div>

        <footer>
            <p>Copyright © 2017</p>
        </footer>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../css/forget.css"/>
</head>
<body>
    <div class="site-wrapper">
        <header class="site-header">
            <div class="brand">
                <div class="logo">
                    <!-- Simple placeholder for logo -->
                    <svg width="46" height="46" viewBox="0 0 46 46">
                        <rect width="46" height="46" fill="#0a0" opacity="0.2" />
                        <text x="23" y="28" font-family="Georgia" font-size="20" fill="#0a0" text-anchor="middle">X</text>
                    </svg>
                </div>
                <div class="brand-text">Company</div>
            </div>
            <nav class="site-nav">
                <a href="../rakib.php">Home</a><span class="sep">|</span>
                <a href="/login.php">Login</a><span class="sep">|</span>
                <a href="reg.php">Registration</a>
            </nav>
        </header>
        
        <main class="site-main">
            <h1 class="welcome">FORGOT PASSWORD</h1>
            <form class="forgot-form">
                <div class="form-group">
                    <label for="email">Enter Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </main>
        
        <footer class="site-footer">
            Copyright 2017
        </footer>
    </div>
</body>
</html>
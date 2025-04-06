
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Document</title>
    <link rel="stylesheet" href="inscrit.css">
</head>

<body>

    <div class="auth-container">

        <div class="auth-form">
            <form id="login-form" class="form-content active" action="login.php" method="POST">
                <h2>Login</h2>

                <div id="error-message" style="color: red; margin-bottom: 10px;font-family:Arial, Helvetica, sans-serif;"></div>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email Address" required>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-links">
                    <a href="#" id="forgot-link">Forgot your password?</a>
                </div>
                <button type="submit" class="submit-btn">Login</button>
                <div class="form-links">
                    <span>Don't have an account? <a href="#" id="register-link">Sign up</a></span>
                </div>
            </form>

            <form id="register-form" class="form-content" action="register.php" method="POST">
               <h2>Sign Up</h2>
                <div id="register-error-message" style="color: red; margin-left: 7rem; font-family:Arial, Helvetica, sans-serif;"></div> 
                <div class="input-box">
                    <input type="text" id="name" name="name" placeholder="Full Name" required>
                </div>
                <div class="input-box">
                    <input type="email" id="email" name="email" placeholder="Email Address" required>
                </div>
                <div class="input-box">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="submit-btn">Sign Up</button>
                <div class="form-links">
                    <span>Already have an account? <a href="#" id="login-link">Login</a></span>
                </div>
            </form>
            <form id="reset-form" class="form-content" action="reset_password.php" method="POST">
                <h2>Reset Password</h2>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <button type="submit" class="submit-btn">Send Reset Link</button>
                <div class="form-links">
                    <span><a href="#" id="back-to-login">Back to Login</a></span>
                </div>
            </form>
        </div>

        <script src="javascript/inscrit.js " defer></script>
</body>

</html>



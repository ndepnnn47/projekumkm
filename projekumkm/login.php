<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
     body {
    background-color: #1b0b2e; 
    font-family: 'Georgia', serif;
    margin: 0;
    padding: 0;
}

.login-container {
    background: linear-gradient(145deg, #130f40, #1f1c48, #2c285c);
    width: 350px;
    margin: 100px auto;
    padding: 30px;
    border: 2px solid #3f2a8d; 
    border-radius: 15px;
    box-shadow: 0 0 25px rgba(255, 255, 255, 0.1);
}

h2 {
    text-align: center;
    color: #ffe76d; 
    text-shadow: 0 0 5px #ffb347;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    color: #d8cfff; 
    margin-bottom: 5px;
    font-family: 'Georgia', serif;
}

input[type="text"],
input[type="password"],
input[type="email"] {
    width: 94%;
    padding: 10px;
    border: 1px solid #6ad7ff;
    border-radius: 5px;
    background-color: #160e33;
    color: #f0f8ff;
    font-family: 'Georgia', serif;
}

.login-button {
    width: 100%;
    padding: 10px;
    background: linear-gradient(to right, #00c2ff, #22d9a4); 
    color: #ffffff;
    border: none;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
}

.login-button:hover {
    background: linear-gradient(to right, #5effd7, #00f0ff);
}

.error {
    color: #ffed8a;
    background-color: #372050;
    border: 1px solid #ffae42;
    padding: 10px;
    margin-top: 10px;
    border-radius: 5px;
}

a {
    color: #7fe3f3; 
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

p {
    text-align: center;
    color: #e2dbff;
}
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login Form</h2>
        <form action="proses_login.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <input type="submit" value="Login" class="login-button">
            <?php
            if (isset($_GET['error'])) {
                echo '<p class="error">' . $_GET['error'] . '</p>';
            }
            ?>
        </form>
        <p>Belum punya akun? <a href="register.php">Daftar</a></p>
    </div>
</body>
</html>
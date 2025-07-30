<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
      body {
    background-color: #0f0a24; 
    font-family: 'Georgia', serif;
    margin: 0;
    padding: 0;
}

.register-container {
    background: linear-gradient(135deg, #1a1446, #2c1e77, #431b9a);
    width: 350px;
    margin: 100px auto;
    padding: 30px;
    border: 2px solid #5e35b1;
    border-radius: 15px;
    box-shadow: 0 0 25px rgba(153, 102, 255, 0.3);
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
    color: #e0d3ff;
    margin-bottom: 5px;
    font-family: 'Georgia', serif;
}

input[type="text"],
input[type="password"],
input[type="email"] {
    width: 94%;
    padding: 10px;
    border: 1px solid #00e5ff;
    border-radius: 5px;
    background-color: #150c34;
    color: #ffffff;
    font-family: 'Georgia', serif;
}

.register-button {
    width: 100%;
    padding: 10px;
    background: linear-gradient(to right, #00c9ff, #92fe9d);
    color: #ffffffff;
    border: none;
    border-radius: 5px;
    font-weight: bold;
    font-family: 'Georgia', serif;
    cursor: pointer;
}

.register-button:hover {
    background: linear-gradient(to right, #92fe9d, #00c9ff);
}

.link-login {
    text-align: center;
    margin-top: 10px;
    font-family: 'Georgia', serif;
}

a {
    color: #ffe96a;
    text-decoration: none;
    font-family: 'Georgia', serif;
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
    <div class="register-container">
        <h2>Registrasi</h2>
        <form action="proses_register.php" method="post">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <input type="submit" value="Daftar" class="register-button">
        </form>
        <div class="link-login">
            <p>Sudah punya akun? <a href="login.php">Login</a><p>
        </div>
    </div>
</body>
</html>
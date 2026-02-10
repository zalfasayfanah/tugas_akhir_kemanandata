<!DOCTYPE html>
<html>
<head>
    <title>Toko Online - Login</title>
    <style>
        body { font-family: Arial; margin: 50px; background: #f0f0f0; }
        .container { max-width: 400px; margin: auto; background: white; padding: 30px; border-radius: 5px; }
        input { width: 100%; padding: 10px; margin: 10px 0; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { color: red; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login Toko Online</h2>
        <?php
        session_start();
        if (isset($_GET['error'])) {
            echo "<p class='error'>Username atau password salah!</p>";
        }
        ?>
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Test account: admin/admin123 atau user1/pass123</p>
    </div>
</body>
</html>
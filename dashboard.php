<?php
session_start();
include 'config.php';

// VULNERABLE: Broken Access Control
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_GET['id'] ?? $_SESSION['user_id'];

// VULNERABLE: SQL Injection di parameter id
$query = "SELECT * FROM users WHERE id=$user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .header { background: #007bff; color: white; padding: 15px; margin-bottom: 20px; }
        .content { background: white; padding: 20px; border: 1px solid #ddd; }
        .logout { float: right; color: white; text-decoration: none; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Dashboard Toko Online
        <a href="logout.php" class="logout">Logout</a>
        </h2>
    </div>
    
    <div class="content">
        <h3>Selamat datang, <?php echo $user['username']; ?>!</h3>
        <p>Email: <?php echo $user['email']; ?></p>
        <p>Role: <?php echo $user['role']; ?></p>
        
        <!-- VULNERABLE: XSS -->
        <?php if (isset($_GET['search'])): ?>
            <p>Hasil pencarian untuk: <?php echo $_GET['search']; ?></p>
        <?php endif; ?>
        
        <form method="GET">
            <input type="hidden" name="id" value="<?php echo $user_id; ?>">
            <input type="text" name="search" placeholder="Cari produk...">
            <button type="submit">Cari</button>
        </form>
        
        <h3>Daftar Produk</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Deskripsi</th>
            </tr>
            <?php
            $products = mysqli_query($conn, "SELECT * FROM products");
            while ($product = mysqli_fetch_assoc($products)) {
                echo "<tr>";
                echo "<td>{$product['id']}</td>";
                echo "<td>{$product['name']}</td>";
                echo "<td>Rp " . number_format($product['price']) . "</td>";
                echo "<td>{$product['description']}</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
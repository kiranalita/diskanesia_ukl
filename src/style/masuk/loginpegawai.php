<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'config.php';
$username = $password = "";
$username_err = $password_err = $login_err = "";
if (isset($_SESSION["login_err"])) {
    $login_err = $_SESSION["login_err"];
    unset($_SESSION["login_err"]); 
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pegawai Samsat Sidoarjo</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('gambar.jpeg'); 
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 400px;
            margin: 100px auto;
            background: rgba(255, 255, 255, 0.1);
            padding: 50px;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 1px solid rgbaa(255, 255, 255, 0.2);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }       
        h1 {
            text-align: center;
            color: black;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: black;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
            color: black;
        }
        .invalid-feedback {
            color: red;
            font-size: 0.9em;
        }
        .btn-primary {
            width: 100%;
            padding: 12px;
            background-color: #4285f4; 
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #357ae8; 
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
        .footer a {
            color: #4285f4;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .alert {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login Pegawai</h1>
        <?php 
        if (!empty($login_err)) {
            echo '<div class="alert">' . $login_err . '</div>';
        }        
        ?>
        <form action="authenticate.php" method="post">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($username); ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Id</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn-primary" value="Login">
            </div>
        </form>
        <div class="footer">
            <p>Belum punya akun? <a href="petugas.php">Daftar di sini</a>.</p>
        </div>
        <footer class="footer">
            <p>&copy; 2024 E-Tax Sidoarjo.</p>
    </footer>
    </div>
</body>
</html>
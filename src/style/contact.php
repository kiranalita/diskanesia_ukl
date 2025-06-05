<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi - E-TAX Sidoarjo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4285f4;
            --secondary-color: #34a853;
            --text-color: #333;
            --background-color: #f4f7f6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('gambar.jpeg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            line-height: 1.6;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            z-index: 1;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
            z-index: 2;
        }

        .contact-form {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .contact-form h1 {
            text-align: center;
            margin-bottom: 30px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: white;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid rgba(255,255,255,0.2);
            background: rgba(255,255,255,0.1);
            color: white;
            border-radius: 5px;
        }

        .form-group textarea {
            height: 150px;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: var(--secondary-color);
        }

        .social-contact {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 30px;
        }

        .social-contact a {
            color: white;
            font-size: 2rem;
            transition: transform 0.3s ease, color 0.3s ease;
            text-decoration: none;
        }

        .social-contact a:hover {
            transform: scale(1.2);
            color: var(--primary-color);
        }

        .social-info {
            text-align: center;
            margin-top: 20px;
            background: rgba(255,255,255,0.1);
            padding: 15px;
            border-radius: 5px;
        }

        .footer {
            background: rgba(0,0,0,0.7);
            color: white;
            text-align: center;
            padding: 20px;
            position: relative;
            z-index: 2;
            margin-top: 30px;
        }

        .footer-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .footer p {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="container">
        <div class="contact-form">
            <h1>Hubungi</h1>
            <form action="send_message.php" method="post">
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="message">Pesan:</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                
                <button type="submit" class="btn-submit">Kirim Pesan</button>
            </form>

            <div class="social-contact">
                <a href="mailto:heythismyword@gmail.com" target="_blank" title="Email">
                    <i class="fas fa-envelope"></i>
                </a>
                <a href="https://www.instagram.com/nathaviela/" target="_blank" title="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://youtube.com/@nathaviela?si=UYqtMlMroMWCsBPt" target="_blank" title="YouTube">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>

            <div class="social-info">
                <p>Hubungi kami melalui kontak di atas atau gunakan formulir kontak</p>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 E-Tax Sidoarjo.</p>
        </div>
    </footer>
</body>
</html>
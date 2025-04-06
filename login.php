<?php
session_start();

if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    header('Location: index.php');
    exit;
}

$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D-Link Manager | Login</title>
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <style>
        :root {
            --primary-color: #0077b6;
            --background-color: #f4f4f9;
            --text-color: #333;
            --shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            --container-bg: white;
            --input-bg: white;
            --input-border: #ddd;
        }

        :root[data-theme="dark"] {
            --primary-color: #00a8e8;
            --background-color: #1a1a1a;
            --text-color: #ffffff;
            --shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            --container-bg: #2d2d2d;
            --input-bg: #3d3d3d;
            --input-border: #4d4d4d;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: var(--background-color);
            font-family: 'Segoe UI', Arial, sans-serif;
            transition: background-color 0.3s ease;
        }

        .login-container {
            background: var(--container-bg);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 400px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }

        input {
            width: 100%;
            padding: 0.5rem;
            background-color: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 4px;
            margin-bottom: 1rem;
            color: var(--text-color);
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }

        button {
            width: 100%;
            padding: 0.75rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.9;
        }

        .error {
            color: red;
            margin-bottom: 1rem;
        }

        .theme-toggle {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--primary-color);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .theme-toggle:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }

        .theme-toggle svg {
            width: 24px;
            height: 24px;
            fill: white;
            transition: transform 0.5s ease;
        }

        [data-theme="dark"] .theme-toggle svg {
            transform: rotate(360deg);
        }

        h2 {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--text-color);
            transition: color 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 style="text-align: center; margin-bottom: 2rem; color: var(--text-color);">D-Link Manager Login</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="auth.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
    <button class="theme-toggle" onclick="toggleTheme()" aria-label="Toggle theme">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1-8.313-12.454z"/>
        </svg>
    </button>
    <script>
        function toggleTheme() {
            const root = document.documentElement;
            const currentTheme = root.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            root.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            
            // Add bounce effect
            const button = document.querySelector('.theme-toggle');
            button.style.transform = 'scale(0.9)';
            setTimeout(() => {
                button.style.transform = '';
            }, 150);
        }

        // Check for saved theme preference
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            document.documentElement.setAttribute('data-theme', savedTheme);
        }

        // Add transition class after page load to prevent initial animation
        window.addEventListener('load', () => {
            document.body.style.transition = 'background-color 0.3s ease';
        });
    </script>
</body>
</html>
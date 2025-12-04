<?php
// Set 404 header
http_response_code(404);

// Start session for potential redirects
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | WinniCode News Portal</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Custom Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Nunito+Sans:wght@300;400;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: #c72727;
            --hover-color: #a01f1f;
            --dark-color: #2c3e50;
            --ff-monts: 'Montserrat', sans-serif;
            --ff-nunito: 'Nunito Sans', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--ff-nunito);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Animated background particles */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="80" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="10" cy="60" r="1.5" fill="rgba(255,255,255,0.1)"/><circle cx="90" cy="30" r="1" fill="rgba(255,255,255,0.1)"/></svg>');
            animation: particles 20s linear infinite;
            opacity: 0.3;
        }

        @keyframes particles {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-100px);
            }
        }

        .error-container {
            text-align: center;
            padding: 40px 20px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 30px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            width: 90%;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(20px);
        }

        .error-code {
            font-size: 140px;
            font-weight: 800;
            font-family: var(--ff-monts);
            background: linear-gradient(135deg, var(--primary-color), var(--hover-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 20px;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .error-title {
            font-size: 36px;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 15px;
            font-family: var(--ff-monts);
        }

        .error-message {
            font-size: 18px;
            color: #6c757d;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .error-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
            position: relative;
        }

        .error-icon svg {
            width: 100%;
            height: 100%;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-10px) rotate(5deg);
            }
        }

        .btn-group-custom {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-custom {
            padding: 15px 35px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-family: var(--ff-nunito);
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--hover-color));
            color: white;
            box-shadow: 0 10px 30px rgba(199, 39, 39, 0.3);
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(199, 39, 39, 0.4);
            color: white;
            text-decoration: none;
        }

        .btn-secondary-custom {
            background: white;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .btn-secondary-custom:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-3px);
            text-decoration: none;
        }

        .suggestions {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #e9ecef;
        }

        .suggestions h4 {
            font-size: 20px;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 20px;
            font-family: var(--ff-monts);
        }

        .suggestions-list {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .suggestion-link {
            padding: 10px 20px;
            background: #f8f9fa;
            color: var(--dark-color);
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .suggestion-link:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            text-decoration: none;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .error-code {
                font-size: 100px;
            }

            .error-title {
                font-size: 28px;
            }

            .error-message {
                font-size: 16px;
            }

            .btn-group-custom {
                flex-direction: column;
            }

            .btn-custom {
                width: 100%;
            }
        }

        .company-branding {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }

        .company-logo {
            font-size: 24px;
            font-weight: 800;
            color: var(--primary-color);
            font-family: var(--ff-monts);
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-icon">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <circle cx="100" cy="100" r="90" fill="#f8f9fa" stroke="#c72727" stroke-width="4" />
                <path d="M70 70 L130 130 M130 70 L70 130" stroke="#c72727" stroke-width="8" stroke-linecap="round" />
                <circle cx="100" cy="160" r="8" fill="#c72727" />
            </svg>
        </div>

        <h1 class="error-code">404</h1>
        <h2 class="error-title">Oops! Page Not Found</h2>
        <p class="error-message">
            The page you are looking for might have been removed, had its name changed,
            or is temporarily unavailable. Please check the URL and try again.
        </p>

        <div class="btn-group-custom">
            <a href="/" class="btn-custom btn-primary-custom">
                <span class="glyphicon glyphicon-home"></span> Back to Home
            </a>
            <a href="javascript:history.back()" class="btn-custom btn-secondary-custom">
                <span class="glyphicon glyphicon-arrow-left"></span> Go Back
            </a>
        </div>

        <div class="suggestions">
            <h4>Quick Links:</h4>
            <div class="suggestions-list">
                <a href="/articles.php" class="suggestion-link">Articles</a>
                <a href="/categories.php" class="suggestion-link">Categories</a>
                <a href="/search.php" class="suggestion-link">Search</a>
                <a href="/author-login.php" class="suggestion-link">Author Login</a>
                <a href="/admin/login.php" class="suggestion-link">Admin Login</a>
            </div>
        </div>

        <div class="company-branding">
            <p class="company-logo">WinniCode</p>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=KoHo:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">   
    <title>Sign in</title>
</head>
<body>
    <div class="container">
        <div class="flex-row-center-center">
            <img src="public/img/Logotype.svg" alt="logo" class="login-logo">
        </div>
        <div class="flex-row-center-center">
            <h1>Sign in</h1>

            <form class="flex-row-center-center" action="login" method="POST">
                <input name="email" type="email" placeholder="Email" class="btn-gradient">
                <input name="password" type="password" placeholder="Password" class="btn-gradient">
                <?php if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo "<p class='error-message'>$message</p>";
                    }
                } ?>
                <button type="submit">Confirm</button>
            </form>

            <a href="/register" class="sign-up-btn">Sign up</a>
        </div>
    </div>
</body>
</html>
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
        <h1>Sign up</h1>

        <form class="flex-row-center-center" action="register" method="POST">
            <input name="firstname" type="text" placeholder="First Name*" class="btn-gradient" required>
            <input name="surname" type="text" placeholder="Last Name*" class="btn-gradient" required>
            <input name="phone_nb" type="tel" placeholder="Phone Number" class="btn-gradient">
            <input name="email" type="email" placeholder="Email*" class="btn-gradient" required>
            <input name="password" type="password" placeholder="Password*" class="btn-gradient" required>
            <input name="password_conf" type="password" placeholder="Confirm Password*" class="btn-gradient" required>
            <?php if (isset($messages)) {
                foreach ($messages as $message) {
                    echo "<p class='error-message'>$message</p>";
                }
            } ?>
            <button type="submit">Confirm</button>
        </form>

        <a href="/login" class="sign-up-btn">Sign in</a>
    </div>
</div>
</body>
</html>
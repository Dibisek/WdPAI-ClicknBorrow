<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/books.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=KoHo:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz,wght@8..144,100..1000&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1ff2c7e106.js" crossorigin="anonymous"></script>
    <title>Homepage</title>
</head>
<body>
    <div class="base-container">
        <nav>
            <img src="public/img/logo_vert.svg" alt="Vertical Logo">
            <ul>
                <li>
                    <a href="#" class="bar-btn">
                        <i class="fa-solid fa-house"></i>
                    </a>
                </li>
                <li>
                    <a href="#" class="bar-btn">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </a>
                </li>
                <li>
                    <a href="#" class="bar-btn">
                        <i class="fa-solid fa-book-bookmark"></i>
                    </a>
                </li>
                <li>
                    <a href="#" class="bar-btn">
                        <i class="fa-solid fa-clipboard-user"></i>
                    </a>
                </li>
                <li>
                    <a href="/logout" class="bar-btn">
                        <i class="fa-solid fa-door-open"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <main>
            <h1>Newly added</h1>
            <section class="books-container">
                <div id="project-1">
                    <div class="top-box">
                        <img src="public/img/uploads/previmg.jpeg">
                        <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Leo a diam sollicitudin tempor id eu nisl nunc. Faucibus vitae aliquet nec ullamcorper sit amet. Nec ullamcorper sit amet risus. Nisl pretium fusce id velit ut tortor pretium viverra.</p>
                    </div>
                    <h2 class="book-title koho-title">Book Title Book Title Book Title Book Title</h2>
                    <div class="bottom-box">
                        <p class="book-author">Author Author Author Author</p>
                        <a href="#" class="add-bookmark">
                            <i class="fa-regular fa-bookmark"></i>
                        </a>
                        <div class="rating">
                            <i class="fa-regular fa-star"></i>
                            <p class="koho-title">8.5</p>
                        </div>
                        
                        <a href="#">
                            <i class="fa-regular fa-share-from-square"></i>
                        </a>
                    </div>
                </div>
                <div id="project-2">
                    <div class="top-box">
                        <img src="public/img/uploads/previmg.jpeg">
                        <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Leo a diam sollicitudin tempor id eu nisl nunc. Faucibus vitae aliquet nec ullamcorper sit amet. Nec ullamcorper sit amet risus. Nisl pretium fusce id velit ut tortor pretium viverra.</p>
                    </div>
                    <h2 class="book-title koho-title">Book Title</h2>
                    <div class="bottom-box">
                        <p class="book-author">Author Author</p>
                        <a href="#" class="add-bookmark">
                            <i class="fa-regular fa-bookmark"></i>
                        </a>
                        <div class="rating">
                            <i class="fa-regular fa-star"></i>
                            <p class="koho-title">8.5</p>
                        </div>
                        
                        <a href="#">
                            <i class="fa-regular fa-share-from-square"></i>
                        </a>
                    </div>
                </div>
                <div>book3</div>
            </section>
        </main>
    </div>    
</body>
</html>
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
    <title>Search</title>
</head>
<body>
    <div class="base-container">
        <?php include_once __DIR__.'/shared/nav.php'; ?>
        <main>
            <h1>My bookmarks</h1>
            <form class="search-box">
                <input type="text" placeholder="Search" class="btn-gradient">
                <button type="submit">Search</button>
            </form>
            <h1></h1>
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
        </main>
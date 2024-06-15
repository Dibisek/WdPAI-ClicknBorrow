<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/book-details.css">
<!--    <link rel="stylesheet" type="text/css" href="public/css/books.css">-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=KoHo:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz,wght@8..144,100..1000&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1ff2c7e106.js" crossorigin="anonymous"></script>
    <title>Homepage</title>
</head>
<body>
<div class="base-container">
    <?php include_once __DIR__.'/shared/nav.php'; ?>
    <main>
        <section class="book-details">
            <div class="book-details-container">
                <div class="left-section">
                    <img src="public/img/uploads/<?= $book->getPhoto() ?>">
                    <div class="genre-box">
                        <p>Genres</p>
                        <p><?= $book->getCategories() ?></p>
                    </div>
                </div>
                <div class="mid-section">
                    <div class="name-box">
                    <h1 class="book-title"><?= $book->getTitle() ?></h1>
                    <h2 class="book-author"><?= $book->getAuthor() ?></h2>
                    </div>
                    <div class="func-container">
                        <div class="add-bookmark">
                            <p>Add to bookmarks</p>
                            <i class="fa-regular fa-bookmark"></i>
                        </div>
                    </div>
                    <div class="description">
                        <p><?= $book->getDescription() ?></p>
                    </div>
                </div>
                <div class="right-section">
                    <div class="bottom-right-box">
                        <p><?= $book->getPageCount() ?> pages</p>
                        <p>Published: <?= $book->getPublishingDate() ?></p>
                    </div>
                </div>
        </section>
<!--        <section class="reservation">-->
<!--            <div class="reservation-container">-->
<!--            </div>-->
<!--        </section>-->
    </main>
</div>
</body>
</html>
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
    <title>Bookmarks</title>
</head>
<body>
    <div class="base-container">
        <?php include_once __DIR__.'/shared/nav.php'; ?>
        <main>
            <h1>My bookmarks</h1>
            <h1></h1>
            <section class="books-container">
                <?php foreach ($books as $book): ?>
                <?php if (in_array($book->getId(), $bookmarkedBookIds)): ?>
                        <?php
                        $bookmarked = in_array($book->getId(), $bookmarkedBookIds);
                        ?>

                        <div id="project-<?= $book->getId()?>">
                            <div class="top-box">
                                <img src="public/img/uploads/<?= $book->getPhoto()?>">
                                <p class="description"><?= $book->getDescription()?></p>
                            </div>
                            <h2 class="book-title koho-title"><?= $book->getTitle()?></h2>
                            <div class="bottom-box" id="<?= $book->getId()?>">
                                <p class="book-author"><?= $book->getAuthor()?></p>
                                <div class="func-container">
                                    <div class="bookmark-container">
                                        <div class="bookmark">
                                            <i class="<?= $bookmarked ? 'fa-solid' : 'fa-regular'?> fa-bookmark"></i>
                                        </div>
                                    </div>
                                </div>

                                <a href="/bookDetails?id=<?= $book->getId()?>">
                                    <i class="fa-regular fa-share-from-square"></i>
                                </a>
                            </div>
                        </div>
                <?php endif; ?>
                <?php endforeach; ?>
            </section>
        </main>
    </div>
</body>
</html>
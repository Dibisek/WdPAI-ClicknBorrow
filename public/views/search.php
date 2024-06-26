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
    <script src="public/js/searchBooks.js" defer></script>
    <title>Search</title>
</head>
<body>
    <div class="base-container">
        <?php include_once __DIR__.'/shared/nav.php'; ?>
        <main>
            <h1>Search books</h1>
            <form class="search-box" method="POST">
                <input name="title" type="text" placeholder="Search by title" class="btn-gradient">
                <label for="category">Category
                    <select name="category" id="category">
                        <option value="">-</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category->getCategoryName()?>">
                                <?= $category->getCategoryName() ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label for="author">Author
                    <select name="author" id="author">
                        <option value="">-</option>
                        <?php foreach ($authors as $author): ?>
                            <option value="<?= $author->getAuthorName() ?>">
                                <?= $author->getAuthorName() ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </form>
            <h1>Results</h1>
            <template id="book-template">
                <div>
                    <div class="top-box">
                        <img src="">
                        <p class="description"></p>
                    </div>
                    <h2 class="book-title koho-title"></h2>
                    <div class="bottom-box">
                        <p class="book-author"></p>
                        <a href="#" class="add-bookmark">
                            <i class="fa-regular fa-bookmark"></i>
                        </a>

                        <a href="">
                            <i class="fa-regular fa-share-from-square"></i>
                        </a>
                    </div>
                </div>
            </template>
            <section class="books-container">
            </section>
            <div class="paginationWrapper">
            </div>
        </main>
</body>
</html>
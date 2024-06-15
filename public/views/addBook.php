<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <link rel="stylesheet" type="text/css" href="public/css/add-book.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=KoHo:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz,wght@8..144,100..1000&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1ff2c7e106.js" crossorigin="anonymous"></script>
    <title>Add book</title>
</head>
<body>
<div class="base-container">
    <?php include_once __DIR__.'/shared/nav.php'; ?>
    <main>
        <h1>Add new book</h1>
        <section class="book-details">
            <form class="book-details-container" method="POST" action="/addBook" enctype="multipart/form-data">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" required>
                    <label for="author">Author</label>
                    <input type="text" name="author" id="author" list="authors" required>
                    <datalist id="authors">
                        <option value="">-</option>
                        <?php foreach ($authors as $author): ?>
                            <option value="<?= $author->getAuthorName() ?>">
                                <?= $author->getAuthorName() ?>
                            </option>
                        <?php endforeach; ?>
                    </datalist>
                    <label for="description">Description</label>
                    <textarea name="description" id="description" required></textarea>
                    <label for="pageCount">Page count</label>
                    <input type="number" name="pageCount" id="pageCount" required>
                    <label for="publishingDate">Publishing date</label>
                    <input type="date" name="publishingDate" id="publishingDate" required>
                    <label for="category">Category</label>
                    <input type="text" name="category" id="category" list="categories" required>
                    <datalist id="categories">
                        <option value="">-</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category->getCategoryName() ?>">
                                <?= $category->getCategoryName() ?>
                            </option>
                        <?php endforeach; ?>
                    </datalist>
                    <label for="cover">Cover
                    <input name=cover type="file" name="cover" id="cover" required>
                    </label>
                    <button type="submit" class="sign-up-btn">Add book</button>
            </form>
        </section>
    </main>
</div>
</body>
</html>
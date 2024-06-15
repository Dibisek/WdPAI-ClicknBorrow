<script src="public/js/bookmarks.js" defer></script>
<section class="books-container">
    <?php foreach ($books as $book): ?>
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
    <?php endforeach; ?>
</section>
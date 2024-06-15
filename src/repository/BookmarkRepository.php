<?php
    require_once 'Repository.php';
    require_once __DIR__.'/../models/Bookmark.php';
    require_once __DIR__.'/../models/User.php';
    require_once __DIR__.'/../models/Book.php';
class BookmarkRepository extends Repository
{
    public function addBookmark(Bookmark $bookmark): void
    {
        $this->database->connect();
        $query = $this->database->getConnection()->prepare('
            INSERT INTO bookmarks (user_id, book_id)
            VALUES (?, ?)
        ');

        $query->execute([
            $bookmark->getUserId(),
            $bookmark->getBookId()
        ]);
    }

    public function removeBookmark(Bookmark $bookmark): void
    {
        $this->database->connect();
        $query = $this->database->getConnection()->prepare('
            DELETE FROM bookmarks WHERE user_id = ? AND book_id = ?
        ');

        $query->execute([
            $bookmark->getUserId(),
            $bookmark->getBookId()
        ]);
    }

    public function getUserBookmarks(int $userId): array
    {
        $this->database->connect();
        $query = $this->database->getConnection()->prepare('
            SELECT * FROM bookmarks WHERE user_id = :user_id
        ');

        $query->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $query->execute();

        $bookmarkedBooks = $query->fetchAll(PDO::FETCH_ASSOC);

        $results = [];
        foreach ($bookmarkedBooks as $book_id) {

            if (!$book_id['book_id']) {
                $results[] = null;
            }

            $results[] = $book_id['book_id'];
        }
        return $results;
    }

    public function isBookmarked(int $userId, int $bookId): bool
    {
        $this->database->connect();
        $query = $this->database->getConnection()->prepare('
            SELECT * FROM bookmarks WHERE user_id = :user_id AND book_id = :book_id
        ');

        $query->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $query->bindParam(':book_id', $bookId, PDO::PARAM_INT);
        $query->execute();

        $bookmarkedBook = $query->fetch(PDO::FETCH_ASSOC);

        return (bool)$bookmarkedBook;
    }
}
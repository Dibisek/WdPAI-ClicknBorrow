<?php

class Reservation
{
    private $reservation_id;
    private $author_name;
    private $book_title;
    private $photo;
    private $reservation_start;
    private $reservation_end;

    private $user_email;
    private $reservation_status;

    public function __construct(string $book_title, string $author_name, string $photo, string $reservation_start,
                                string $reservation_end, string $user_email, string $reservation_status,
                                int $reservation_id=0)
    {
        $this->reservation_id = $reservation_id;
        $this->book_title = $book_title;
        $this->author_name = $author_name;
        $this->photo = $photo;
        $this->reservation_start = $reservation_start;
        $this->reservation_end = $reservation_end;
        $this->user_email = $user_email;
        $this->reservation_status = $reservation_status;
    }

    public function getReservationId(): int
    {
        return $this->reservation_id;
    }

    public function getAuthorName(): string
    {
        return $this->author_name;
    }

    public function getBookTitle(): string
    {
        return $this->book_title;
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    public function getReservationStart(): string
    {
        return $this->reservation_start;
    }

    public function getReservationEnd(): string
    {
        return $this->reservation_end;
    }

    public function getUserEmail(): string
    {
        return $this->user_email;
    }

    public function getReservationStatus(): string
    {
        return $this->reservation_status;
    }

}
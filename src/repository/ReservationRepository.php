<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Reservation.php';

class ReservationRepository extends Repository
{
    public function getReservationByEmail(string $userEmail, string $status) :array
    {
        $this->database->connect();
        $query = $this->database->getConnection()->prepare("
        SELECT * FROM reservation_view WHERE email = :user_email AND reservation_status = :status
        ");

        $query->bindParam(':user_email', $userEmail, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $this->database->disconnect();

        $reservations = $query->fetchAll(PDO::FETCH_ASSOC);
        $reservationList = [];
        foreach ($reservations as $reservation) {
            $reservationList[] = new Reservation(
                $reservation['book_title'],
                $reservation['author_name'],
                $reservation['photo'],
                $reservation['reservation_start'],
                $reservation['reservation_end'],
                $reservation['email'],
                $reservation['reservation_status'],
                $reservation['reservation_id']
            );
        }
        return $reservationList;
    }


    public function getPendingReservations() :array
    {
        $this->database->connect();
        $query = $this->database->getConnection()->prepare("
        SELECT * FROM reservation_view WHERE reservation_status = 'pending'
        ");
        $query->execute();
        $this->database->disconnect();

        $reservations = $query->fetchAll(PDO::FETCH_ASSOC);
        $reservationList = [];
        foreach ($reservations as $reservation) {
            $reservationList[] = new Reservation(
                $reservation['book_title'],
                $reservation['author_name'],
                $reservation['photo'],
                $reservation['reservation_start'],
                $reservation['reservation_end'],
                $reservation['email'],
                $reservation['reservation_status'],
                $reservation['reservation_id']
            );
        }
        return $reservationList;
    }

    public function updateReservationStatus(string $status, int $reservationId) :void
    {
        $this->database->connect();
        $query = $this->database->getConnection()->prepare("
        UPDATE reservations SET reservation_status = :status WHERE reservation_id = :reservation_id
        ");

        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':reservation_id', $reservationId, PDO::PARAM_INT);
        $query->execute();

        $this->database->disconnect();
    }
}
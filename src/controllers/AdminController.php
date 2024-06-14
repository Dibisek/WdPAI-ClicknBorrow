<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Book.php';
require_once __DIR__.'/../models/Reservation.php';
require_once __DIR__.'/../repository/BookRepository.php';
require_once __DIR__.'/../repository/ReservationRepository.php';
class AdminController extends AppController
{
    private $reservationRepository;

    public function __construct()
    {
        parent::__construct();
        $this->reservationRepository = new ReservationRepository();
    }


    public function reservationsAdmin()
    {
        if (!$this->isGet()) {
            return $this->render('reservationsAdmin');
        }

        $pendingReservations = $this->reservationRepository->getPendingReservations();

        return $this->render('reservationsAdmin', ['reservations' => $pendingReservations]);
    }

    public function reservationHandler()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            header('Content-type: application/json');
            http_response_code(200);

            $reservation_id = $decoded['reservation_id'];
            $status = $decoded['status'];
            var_dump($reservation_id, $status);
            $this->reservationRepository->updateReservationStatus($status, $reservation_id);
            return;
        }
    }
}
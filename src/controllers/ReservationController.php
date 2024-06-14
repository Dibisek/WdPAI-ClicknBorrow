<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Reservation.php';
require_once __DIR__.'/../repository/ReservationRepository.php';
class ReservationController extends AppController
{
    private $reservationRepository;

    public function __construct()
    {
        parent::__construct();
        $this->reservationRepository = new ReservationRepository();
    }

    public function history()
    {
        if (!$this->isGet()) {
            return $this->render('history');
        }

        if (!isset($_SESSION['user'])) {
            return $this->render('login');
        }

        $userEmail = unserialize($_SESSION['user'])->getEmail();
        $confirmedReservations = $this->reservationRepository->getReservationByEmail($userEmail, 'confirmed');
        $pendingReservations = $this->reservationRepository->getReservationByEmail($userEmail, 'pending');

        return $this->render('history', ['confirmedReservations' => $confirmedReservations, 'pendingReservations' => $pendingReservations]);
    }
}
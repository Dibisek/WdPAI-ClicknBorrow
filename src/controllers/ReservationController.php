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
}
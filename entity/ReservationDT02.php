<?php 

class ReservationDTO2 {
    public readonly Reservation $reservation;
    public int $id_copy;

    public function __construct(Reservation $reservation, int $id_copy) {
        $this->reservation = $reservation;
        $this->id_copy = $id_copy;
    }
}
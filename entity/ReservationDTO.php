<?php

class ReservationDTO {
    public readonly Reservation $reservation;
    public string $img_src;

    public function __construct(Reservation $reservation, string $img_src) {
        $this->reservation = $reservation;
        $this->img_src = $img_src;
    }
}
<?php

class ReservationDTE {
    public readonly Reservation $reservation;
    public string $name;

    public function __construct(Reservation $reservation, string $name) {
        $this->reservation = $reservation;
        $this->name = $name;
    }
}
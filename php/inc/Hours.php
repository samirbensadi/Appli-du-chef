<?php

class Hours {
    public $startHour = 00;
    public $startMin = 00;
    public $endHour = 00;
    public $endMin = 00;

    public function __construct($hourMin,$minMin,$hourMax,$minMax) {
        $this->startHour = (int) $hourMin;
        $this->startMin = (int) $minMin;
        $this->endHour = (int) $hourMax;
        $this->endMin = (int) $minMax;
    }
}
<?php

class Day extends Model {
    
    private $time = 0;

    public function fromTime($time) {
        $date = date('d-m-Y', $time);
        $this->time = strtotime($date);
    }

    public function toTime() {
        return $this->time;
    }

    public function isAfter(Day $day) {
        return $this->time > $day->toTime();
    }

    public function isBefore(Day $day) {
        return $this->time < $day->toTime();        
    }

    public function equals(Day $day) {
        return $this->time === $day->toTime();
    }

    public function toString() {
        return date('d-m-Y', $this->time);
    }

    public function fromString($string) {
        $date = date('d-m-Y', strtotime($string));
        $this->time = strtotime($date);
    }

}

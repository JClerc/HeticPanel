<?php

class Date extends Model {
    
    private $time = 0;

    public static function startOfYear($year = null) {
        if (!isset($year)) $year = date('Y');
        $date = new Date;
        $date->fromString('01-09-' . $year);
        return $date;
    }

    public static function endOfYear($year = null) {
        if (!isset($year)) {
            $start = self::startOfYear();

            $date = new Date;
            $date->fromString('30-06-' . date('Y'));

            if ($date->isBefore($start)) $date->fromString('01-06-' . (date('Y') + 1));

            return $date;

        } else {        

            $date = new Date;
            $date->fromString('01-09-' . $year);
            return $date;
        }
    }

    public function fromTime($time) {
        $date = date('d-m-Y', $time);
        $this->time = strtotime($date);
    }

    public function toTime() {
        return $this->time;
    }

    public function isAfter(Date $date) {
        return $this->time > $date->toTime();
    }

    public function isBefore(Date $date) {
        return $this->time < $date->toTime();        
    }

    public function equals(Date $date) {
        return $this->time === $date->toTime();
    }

    public function toString() {
        return date('d-m-Y', $this->time);
    }

    public function getDay() {
        return date('d', $this->time);
    }

    public function getMonth() {
        return date('m', $this->time);
    }

    public function getYear() {
        return date('Y', $this->time);
    }

    public function fromString($string) {
        $date = date('d-m-Y', strtotime($string));
        $this->time = strtotime($date);
    }

}

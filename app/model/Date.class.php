<?php

class Date extends Model {
    
    private $time = 0;

    public function __construct() {
        $this->fromTime(time());
    }

    public function fromTime($time) {
        $date = date('d-m-Y', $time);
        $this->time = strtotime($date);
    }

    public function getTime() {
        return $this->time;
    }

    public function getBefore() {
        $date = new Date;
        $date->fromTime($this->getTime() - 86400);
        return $date;
    }

    public function getAfter() {
        $date = new Date;
        $date->fromTime($this->getTime() + 86400);
        return $date;
    }

    public function getDaysTo(Date $to) {
        $fromdate = new DateTime;
        $fromdate->setTimestamp($this->getTime());
        $todate = new DateTime;
        $todate->setTimestamp($to->getTime());

        $period = new DatePeriod(
            $fromdate,
            new DateInterval('P1D'),
            $todate->modify('+1 day')
        );

        $list = [];
        foreach ($period as $d) {
            $date = new Date; 
            $date->fromTime($d->getTimestamp());
            $list[] = $date;
        }

        return $list;
    }

    public function isAfter(Date $date) {
        return $this->time > $date->getTime();
    }

    public function isBefore(Date $date) {
        return $this->time < $date->getTime();        
    }

    public function equals(Date $date) {
        return $this->time === $date->getTime();
    }

    public function toString() {
        return date('d-m-Y', $this->time);
    }

    public function isDayOfWeek($day) {
        return $this->getDayOfWeek() === intval($day);
    }

    public function getDayOfWeek() {
        return intval(date('N', $this->time));
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

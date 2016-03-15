<?php

class Date extends Model {
    
    const DATE_START = '01-09';
    const DATE_END   = '30-06';

    private $time = 0;

    public function __construct() {
        $this->fromTime(time());
    }

    public static function startOfYear($year = null) {
        $date = new Date;

        if (!isset($year)) {
            $year = date('Y');
            while (strtotime(self::DATE_START . '-' . $year) > time()) {
                $year--;
            }
        }

        $date->fromString(self::DATE_START . '-' . $year);
        return $date;
    }

    public static function endOfYear($year = null) {
        if (!isset($year)) {
            $start = self::startOfYear();

            $date = new Date;
            $date->fromString(self::DATE_END . '-' . date('Y'));

            $i = 1;
            while ($date->isBefore($start)) $date->fromString(self::DATE_END . '-' . (date('Y') + $i++));

            return $date;

        } else {        

            $date = new Date;
            $date->fromString(self::DATE_START . '-' . $year);
            return $date;
        }
    }

    public static function getDaysInYear() {
        $start = self::startOfYear();
        $end = self::endOfYear();
        return $start->getDaysTo($end);
    }

    public function fromTime($time) {
        $date = date('d-m-Y', $time);
        $this->time = strtotime($date);
    }

    public function getTime() {
        return $this->time;
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

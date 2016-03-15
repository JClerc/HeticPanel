<?php

class Calendar extends Model {

    const SCHOOL_YEAR_START = '09';
    const SCHOOL_YEAR_END   = '06';

    public static function startOfYear($year = null) {
        $date = new Date;

        if (!isset($year)) {
            $year = date('Y');
            while (strtotime('01-' . self::SCHOOL_YEAR_START . '-' . $year) > time()) {
                $year--;
            }
        }

        $date->fromString('01-' . self::SCHOOL_YEAR_START . '-' . $year);
        return $date;
    }

    public static function endOfYear($startYear = null) {
        $date = new Date;

        if (!isset($startYear)) {

            $start = self::startOfYear();
            $i = 0;

            do {
                $lastDay = date('t', strtotime('01-' . self::SCHOOL_YEAR_END . '-' . (date('Y') + $i)));
                $date->fromString($lastDay . '-' . self::SCHOOL_YEAR_END . '-' . (date('Y') + $i));
                $i++;
            } while ($date->isBefore($start));

            return $date;

        } else {        

            // $lastDay = date('t', strtotime('01-' . self::SCHOOL_YEAR_END . '-' . $startYear));
            // $date->fromString($lastDay . '-' . self::SCHOOL_YEAR_END . '-' . $startYear);

            $start = self::startOfYear($startYear);
            $i = 0;

            do {
                $lastDay = date('t', strtotime('01-' . self::SCHOOL_YEAR_END . '-' . ($startYear + $i)));
                $date->fromString($lastDay . '-' . self::SCHOOL_YEAR_END . '-' . ($startYear + $i));
                $i++;
            } while ($date->isBefore($start));

            return $date;
        }
    }

    public static function getDaysInYear() {
        $start = self::startOfYear();
        $end = self::endOfYear();
        return $start->getDaysTo($end);
    }

}

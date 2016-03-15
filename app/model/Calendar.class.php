<?php

class Calendar extends Model {

    const SCHOOL_YEAR_START = '09';
    const SCHOOL_YEAR_END   = '06';

    const MONTH_LOCALE_FR = [
        null,
        'Janvier',
        'Février',
        'Mars',
        'Avril',
        'Mai',
        'Juin',
        'Juillet',
        'Août',
        'Septembre',
        'Octobre',
        'Novembre',
        'Décembre'
    ];

    const DAY_LOCALE_FR = [
        null,
        'Lundi', 
        'Mardi', 
        'Mercredi', 
        'Jeudi', 
        'Vendredi', 
        'Samedi', 
        'Dimanche'
    ];

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

    public static function getDaysInYear($year = null) {
        $start = self::startOfYear($year);
        $end = self::endOfYear($year);
        return $start->getDaysTo($end);
    }

    public static function getMonthInYear($year = null) {
        $days = self::getDaysInYear($year);
        $months = [];

        foreach ($days as $day) {
            $months[ $day->getMonth() ][] = $day;
        }

        return $months;
    }

    public static function getMonthName($month) {
        return self::MONTH_LOCALE_FR[intval($month)];
    }

    public static function getDayName($dayOfWeek) {
        return self::DAY_LOCALE_FR[intval($dayOfWeek)];
    }

}

<?php

namespace App\Calendar\Model;

class LeapYear
{
    public function isLeapYear($year = null)
    {
        if (null === $year) {
            $year = date('Y');
        }

        $result = 0 == $year % 400 || (0 == $year % 4 && 0 != $year % 100);

        return $result ? "This is leap year" : "This is not a leap year";
    }

}
<?php


namespace Core;


class Date
{
    private $day;
    private $month;
    private $year;

    public function __construct($string = null)
    {
        if ($string == null) {
            $now = new \DateTime('now');
            $string = $now->format('m_d_Y');
        }
        $parts = explode('_', $string);
        $this->day = $parts[1] * 1;
        $this->month = $parts[0] * 1;
        $this->year = $parts[2] * 1;
    }

    public function getMonthName()
    {
        $months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];
        return $months[$this->month];
    }

    public function toString()
    {
        $m = $this->month;
        $d = $this->day;
        if ($this->month < 10) {
            $m = '0' . $this->month;
        }
        if ($this->day < 10) {
            $d = '0' . $this->day;
        }
        return $m . '_' . $d . '_' . $this->year;
    }

    public function getData()
    {
        return [
            'day' => $this->day,
            'month' => $this->month,
            'year' => $this->year,
            'month_name' => $this->getMonthName(),
            'string' => $this->toString()
        ];
    }
}
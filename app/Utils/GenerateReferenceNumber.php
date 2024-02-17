<?php

namespace App\Utils;

class GenerateReferenceNumber 
{
    protected $unique_code;
    protected $serial_number;
    protected $months = ["I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII"];
    protected $month;
    protected $mode;
    protected $type;
    protected $letter;
    protected $location;
    protected $year;

    public function __construct($serial_number, $unique_code = "", $mode = 1, $letter = "Kppdk", $type = "Ket", $location = "Kel. Sub")
    {
        if($serial_number && ($mode == 1 || $mode == 3 || $mode == 4)) {
            $serial = (int) explode(" ", $serial_number->sk->reference_number)[0] ?? str_pad("0", 2, '0', STR_PAD_LEFT);
        } else if($serial_number && ($mode == 2 || $mode == 5 || $mode == 6)) {
            $serial = (int) explode(" ", $serial_number->sk->reference_number)[2] ?? str_pad("0", 2, '0', STR_PAD_LEFT); 
        } else {
            $serial = str_pad("0", 2, '0', STR_PAD_LEFT); ;
        }
        
        $this->unique_code = $unique_code;
        $this->serial_number = str_pad(++$serial, 2, '0', STR_PAD_LEFT);
        $this->month = $this->months[date("n")-1];
        $this->letter = $letter;
        $this->mode = $mode;
        $this->type = $type;
        $this->location = $location;
        $this->year = date("Y");
    }

    public function generate()
    { 
        
        return match($this->mode) {
            1 => "$this->serial_number / $this->month / $this->letter / $this->location / $this->year",
            2 => "$this->unique_code / $this->serial_number / $this->month / $this->type / $this->letter / $this->year",
            3 => "$this->serial_number / $this->letter / $this->month / $this->year",
            4 => "$this->serial_number / $this->month / $this->type / $this->year",
            5 => "$this->unique_code / $this->serial_number / $this->month / $this->type / $this->location / $this->year",
            6 => "$this->unique_code / $this->serial_number / $this->month / $this->type / $this->year",
        };
    }
}
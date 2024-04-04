<?php

namespace App\Utils;

use App\Models\Sk;
use Carbon\Carbon;

class GenerateReferenceNumber 
{
    protected $unique_code; // kode tetap
    protected $serial_number; // nomor regis
    protected $cover_letter_serial_number; // nomor regis
    protected $months = ["I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII"];
    protected $month; // bulan
    protected $mode;
    protected $type; // tipe surat
    protected $letter; // jenis surat
    protected $location; // lokasi surat
    protected $year; // tahun surat
    protected $environmental_code; // kode kaling

    public function __construct($unique_code = "", $mode = 1, $letter = "Kppdk", $type = "Ket.", $location = "Kel. Sub", $environmental_code = "LJK")
    {
        $sk = Sk::latest()
                ->where("reference_number", "!=", "-")
                ->whereYear('created_at', Carbon::now()->year)
                ->where("mode", $mode)
                ->first();
        $sk_cover_letter = Sk::latest()
                ->where("reference_number", "!=", "-")
                ->first();

        if($sk) {
            if($sk->mode == 1 || $sk->mode == 3 || $sk->mode == 4 || $sk->mode == 8 || $sk->mode == 9) {
                $serial = (int) explode(" ", $sk->reference_number)[0] ?? str_pad("0", 2, '0', STR_PAD_LEFT);
            } else if($sk->mode == 2 || $sk->mode == 5 || $sk->mode == 6 || $sk->mode == 7) {
                $serial = (int) explode(" ", $sk->reference_number)[2] ?? str_pad("0", 2, '0', STR_PAD_LEFT);
            }
        } else {
            $serial = str_pad("0", 2, '0', STR_PAD_LEFT); ;
        }

        if($sk_cover_letter) {
            if($sk_cover_letter->mode == 1 || $sk_cover_letter->mode == 3 || $sk_cover_letter->mode == 4 || $sk_cover_letter->mode == 8 || $sk_cover_letter->mode == 9) {
                $cover_letter_serial = (int) explode(" ", $sk_cover_letter->reference_number)[0] ?? str_pad("0", 2, '0', STR_PAD_LEFT);
            } else if($sk_cover_letter->mode == 2 || $sk_cover_letter->mode == 5 || $sk_cover_letter->mode == 6 || $sk_cover_letter->mode == 7) {
                $cover_letter_serial = (int) explode(" ", $sk_cover_letter->reference_number)[2] ?? str_pad("0", 2, '0', STR_PAD_LEFT);
            }
        } else {
            $cover_letter_serial = str_pad("0", 2, '0', STR_PAD_LEFT); ;
        }

        
        $this->unique_code = $unique_code;
        $this->serial_number = str_pad(++$serial, 2, '0', STR_PAD_LEFT);
        $this->cover_letter_serial_number = str_pad(++$cover_letter_serial, 2, '0', STR_PAD_LEFT);
        $this->month = $this->months[date("n")-1];
        $this->letter = $letter;
        $this->mode = $mode;
        $this->type = $type;
        $this->location = $location;
        $this->year = date("Y");
        $this->environmental_code = $environmental_code;
    }

    public function generate()
    { 
        
        return match($this->mode) {
            // sk lahir - sk meninggal
            1 => "$this->serial_number / $this->month / $this->letter / $this->location / $this->year",
            // sk kawin - sk belum menikah - 
            2 => "$this->unique_code / $this->serial_number / $this->month / $this->type / $this->letter / $this->year",
            // sk duda - sk janda - 
            3 => "$this->unique_code / $this->serial_number / $this->month / $this->type / $this->year",
            // sk cerai - 
            4 => "$this->unique_code / $this->serial_number / $this->type / $this->month / $this->year",
            // sk tempat usaha - sktm bayar cerai - sktm bedah rumah - sktm disabilitas - sktm bpjs - sktm lansia - sktm sekolah
            5 => "$this->unique_code / $this->serial_number / $this->month / $this->type / $this->location / $this->year",
            // sk beda nama -  sk rumah subsidi - sk harga tanah - sk penghasilan ortu - sk izin orang tua - sr pembelian bbm - sk domisili - sk penebangan pohon
            6 => "$this->serial_number / $this->month / $this->type / $this->location / $this->year",
            // semua sk pindah (desa, lingkungan, kecamatan, provinsi)
            7 => "$this->unique_code / $this->serial_number / $this->month / $this->letter / $this->location / $this->year",
            // sk bepergian - sk ahli waris
            8 => "$this->serial_number / $this->month / $this->type / $this->year",
            // sk tempat tinggal
            9 => "$this->serial_number / $this->month / $this->letter / $this->year",
        };
    }

    
    public function generateCoverLetter()
    { 
        
        return "$this->cover_letter_serial_number / $this->environmental_code / $this->month / $this->year";
    }
}
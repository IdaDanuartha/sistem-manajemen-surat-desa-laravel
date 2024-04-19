<?php

namespace App\Enums;

enum SktmType: int
{
	case BAYAR_CERAI = 1;
	case SEKOLAH = 2;
	case BEDAH_RUMAH = 3;
	case DISABILITAS = 4;
	case BPJS = 5;
	case LANSIA = 6;

	public function label()
	{
		return match ($this) {
			self::BAYAR_CERAI => 'Bayar Cerai',			
			self::SEKOLAH => 'Sekolah',			
			self::BEDAH_RUMAH => 'Bedah Rumah',			
			self::DISABILITAS => 'Disabilitas',			
			self::BPJS => 'JKN KIS BPJS',			
			self::LANSIA => 'Lansia',		
		};
	}

	public static function labels(): array
	{
		return [
			'Bayar Cerai',			
			'Sekolah',			
			'Bedah Rumah',			
			'Disabilitas',			
			'BPJS',			
			'Lansia',	
		];
	}
}

<?php

namespace App\Enums;

enum SkMoveType: int
{
	case ANTAR_KECAMATAN = 1;
	case ANTAR_LINGKUNGAN = 2;
	case ANTAR_DESA = 3;
	case ANTAR_PROVINSI = 4;	

	public function label()
	{
		return match ($this) {
			self::ANTAR_KECAMATAN => 'Pindah Antar Kecamatan',			
			self::ANTAR_LINGKUNGAN => 'Pindah Antar Lingkungan',			
			self::ANTAR_DESA => 'Pindah Antar Desa',			
			self::ANTAR_PROVINSI => 'Pindah Antar Provinsi',		
		};
	}

	public static function labels(): array
	{
		return [
			'Pindah Antar Kecamatan',			
			'Pindah Antar Lingkungan',			
			'Pindah Antar Desa',			
			'Pindah Antar Provinsi',	
		];
	}
}

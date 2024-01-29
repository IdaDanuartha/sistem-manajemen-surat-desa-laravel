<?php

namespace App\Enums;

enum MaritalStatus: int
{
	case SINGLE = 1;
	case MARRY = 2;
	case DIVORCE = 3;
	case DEATH_DIVORCE = 4;	

	public function label()
	{
		return match ($this) {
			self::SINGLE => 'Belum Kawin',			
			self::MARRY => 'Kawin',			
			self::DIVORCE => 'Cerai Hidup',			
			self::DEATH_DIVORCE => 'Cerai Mati',		
		};
	}

	public static function labels(): array
	{
		return [
			'Belum Kawin',			
			'Kawin',			
			'Cerai Hidup',			
			'Cerai Mati',	
		];
	}
}

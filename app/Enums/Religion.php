<?php

namespace App\Enums;

enum Religion: int
{
	case ISLAM = 1;
	case PROTESTAN = 2;
	case KATOLIK = 3;
	case HINDU = 4;
	case BUDHA = 5;
	case KONGHUCU = 6;

	public function label()
	{
		return match ($this) {
			self::ISLAM => 'Islam',			
			self::PROTESTAN => 'Kristen Protestan',			
			self::KATOLIK => 'Kristen Katolik',			
			self::HINDU => 'Hindu',			
			self::BUDHA => 'Budha',			
			self::KONGHUCU => 'Konghucu',			
		};
	}

	public static function labels(): array
	{
		return [
			'Islam',			
			'Kristen Protestan',			
			'Kristen Katolik',			
			'Hindu',			
			'Budha',			
			'Konghucu',	
		];
	}
}

<?php

namespace App\Enums;

enum BloodGroup: int
{
	case O = 1;
	case A = 2;
	case B = 3;
	case AB = 4;

	public function label()
	{
		return match ($this) {
			self::O => 'O',
			self::A => 'A',
			self::B => 'B',
			self::AB => 'AB',
		};
	}

	public static function labels(): array
	{
		return [
			'O',
			'A',
			'B',
			'AB',
		];
	}
}

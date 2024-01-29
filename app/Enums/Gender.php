<?php

namespace App\Enums;

enum Gender: int
{
	case MAN = 1;
	case WOMAN = 2;

	public function label()
	{
		return match ($this) {
			self::MAN => 'Laki-Laki',
			self::WOMAN => 'Perempuan',
		};
	}

	public static function labels(): array
	{
		return [
			'Laki-Laki',
			'Perempuan',
		];
	}
}

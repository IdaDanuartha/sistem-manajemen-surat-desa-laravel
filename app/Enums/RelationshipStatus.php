<?php

namespace App\Enums;

enum RelationshipStatus: int
{
	case ORANG_TUA = 1;
	case WALI = 2;
	case SUAMI = 3;
	case ISTRI = 4;

	public function label()
	{
		return match ($this) {
			self::ORANG_TUA => 'Orang Tua',
			self::WALI => 'Wali',
			self::SUAMI => 'Suami',
			self::ISTRI => 'Istri',
		};
	}

	public static function labels(): array
	{
		return [
			'Orang Tua',
			'Wali',
			'Suami',
			'Istri',
		];
	}
}

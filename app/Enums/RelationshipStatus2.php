<?php

namespace App\Enums;

enum RelationshipStatus2: int
{
	case SUAMI = 1;
	case ISTRI = 2;
	case ANAK = 3;

	public function label()
	{
		return match ($this) {
			self::SUAMI => 'Suami',
			self::ISTRI => 'Istri',
			self::ANAK => 'Anak',
		};
	}

	public static function labels(): array
	{
		return [
			'Suami',
			'Istri',
			'Anak',
		];
	}
}

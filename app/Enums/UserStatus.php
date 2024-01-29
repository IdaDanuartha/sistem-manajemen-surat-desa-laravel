<?php

namespace App\Enums;

enum UserStatus: int
{
	case NONACTIVE = 0;
	case ACTIVE = 1;

	public function label()
	{
		return match ($this) {
			self::ACTIVE => 'Active',
			self::NONACTIVE => 'Disabled',
		};
	}

	public static function labels(): array
	{
		return [
			'Active',
			'Disabled',
		];
	}
}

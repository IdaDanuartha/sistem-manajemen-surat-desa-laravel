<?php

namespace App\Enums;

enum Role: int
{
	case SUPER_ADMIN = 0;
	case ADMIN = 1;
	case VILLAGE_HEAD = 2;
	case ENVIRONMENTAL_HEAD = 3;
	case SECTION_HEAD = 4;
	case CITIZENT = 5;

	public function label()
	{
		return match ($this) {
			self::SUPER_ADMIN => 'Super Admin',
			self::ADMIN => 'Admin',
			self::VILLAGE_HEAD => 'Kepala Kelurahan',
			self::ENVIRONMENTAL_HEAD => 'Kepala Lingkungan',
			self::SECTION_HEAD => 'Kepala Seksi',
			self::CITIZENT => 'Warga',
		};
	}

	public static function labels(): array
	{
		return [
			2 => 'Kepala Kelurahan',
			3 => 'Kepala Lingkungan',
			4 => 'Kepala Seksi',
			5 => 'Warga',
		];
	}
}

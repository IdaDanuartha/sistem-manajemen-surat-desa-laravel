<?php

namespace App\Enums;

use App\Models\User;
use Illuminate\Support\Arr;

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
		$user = User::all();
		$roles = [
			2 => 'Kepala Kelurahan',
			3 => 'Kepala Lingkungan',
			4 => 'Kepala Seksi',
			5 => 'Warga',
		];

		if($user->where("role", self::VILLAGE_HEAD)->first()) {
			Arr::pull($roles, 2);
		}

		if($user->where("role", self::ENVIRONMENTAL_HEAD)->first()) {
			Arr::pull($roles, 3);
		}
		
		if($user->where("role", self::SECTION_HEAD)->first()) {
			Arr::pull($roles, 4);
		}

		return $roles;
	}
}
